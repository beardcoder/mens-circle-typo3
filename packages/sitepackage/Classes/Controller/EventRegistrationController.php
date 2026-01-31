<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Controller;

use MensCircle\Sitepackage\Domain\Model\Event;
use MensCircle\Sitepackage\Domain\Model\EventRegistration;
use MensCircle\Sitepackage\Domain\Repository\EventRegistrationRepository;
use MensCircle\Sitepackage\Domain\Repository\EventRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;

final class EventRegistrationController extends ActionController
{
    public function __construct(
        private readonly EventRegistrationRepository $registrationRepository,
        private readonly EventRepository $eventRepository,
    ) {}

    public function newAction(Event $event): ResponseInterface
    {
        $this->view->assign('event', $event);
        
        return $this->htmlResponse();
    }

    #[Validate(['param' => 'registration', 'validator' => 'GenericObject'])]
    public function createAction(EventRegistration $registration, Event $event): ResponseInterface
    {
        try {
            $token = bin2hex(random_bytes(32));
            $registration->setConfirmationToken($token);
            $registration->setEvent($event);
            $registration->setConfirmed(false);
            $registration->setCreatedAt(new \DateTime());
            
            $this->registrationRepository->add($registration);
            $this->persistenceManager->persistAll();
            
            $this->sendConfirmationEmail($registration, $token);
            
            $this->addFlashMessage(
                'Please check your email to confirm your registration.',
                'Registration Pending',
                ContextualFeedbackSeverity::INFO
            );
            
            return $this->redirect('list', 'Event');
        } catch (\Exception $e) {
            $this->addFlashMessage(
                'An error occurred during registration. Please try again.',
                'Registration Failed',
                ContextualFeedbackSeverity::ERROR
            );
            
            return $this->redirect('new', null, null, ['event' => $event]);
        }
    }

    public function confirmAction(string $token): ResponseInterface
    {
        try {
            $registration = $this->registrationRepository->findByConfirmationToken($token);
            
            if (!$registration) {
                $this->addFlashMessage(
                    'Invalid or expired confirmation link.',
                    'Confirmation Failed',
                    ContextualFeedbackSeverity::ERROR
                );
                
                return $this->redirect('list', 'Event');
            }
            
            if ($registration->isConfirmed()) {
                $this->addFlashMessage(
                    'This registration has already been confirmed.',
                    'Already Confirmed',
                    ContextualFeedbackSeverity::INFO
                );
                
                return $this->redirect('success');
            }
            
            $registration->setConfirmed(true);
            $registration->setConfirmedAt(new \DateTime());
            $registration->setConfirmationToken(null);
            
            $this->registrationRepository->update($registration);
            $this->persistenceManager->persistAll();
            
            return $this->redirect('success');
        } catch (\Exception $e) {
            $this->addFlashMessage(
                'An error occurred during confirmation. Please try again.',
                'Confirmation Error',
                ContextualFeedbackSeverity::ERROR
            );
            
            return $this->redirect('list', 'Event');
        }
    }

    public function successAction(): ResponseInterface
    {
        $this->addFlashMessage(
            'Your registration has been confirmed successfully!',
            'Registration Confirmed',
            ContextualFeedbackSeverity::OK
        );
        
        return $this->htmlResponse();
    }

    private function sendConfirmationEmail(EventRegistration $registration, string $token): void
    {
        $confirmationUri = $this->uriBuilder
            ->reset()
            ->setCreateAbsoluteUri(true)
            ->uriFor('confirm', ['token' => $token]);
        
        $event = $registration->getEvent();
        $email = $registration->getEmail();
        
        $subject = sprintf('Confirm your registration for %s', $event->getTitle());
        $body = sprintf(
            "Hello %s,\n\nPlease confirm your registration by clicking this link:\n%s\n\nEvent: %s\nDate: %s\n\nBest regards",
            $registration->getName(),
            $confirmationUri,
            $event->getTitle(),
            $event->getStartDate()?->format('Y-m-d H:i') ?? 'TBD'
        );
        
        $message = \TYPO3\CMS\Core\Mail\MailMessage::create()
            ->to($email)
            ->subject($subject)
            ->text($body);
        
        $message->send();
    }
}
