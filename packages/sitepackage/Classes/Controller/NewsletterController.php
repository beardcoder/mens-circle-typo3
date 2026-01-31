<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Controller;

use MensCircle\Sitepackage\Domain\Model\Subscriber;
use MensCircle\Sitepackage\Domain\Repository\SubscriberRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;

final class NewsletterController extends ActionController
{
    public function __construct(
        private readonly SubscriberRepository $subscriberRepository,
        private readonly PersistenceManagerInterface $persistenceManager,
    ) {}

    public function subscribeAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    #[Validate(['param' => 'subscriber', 'validator' => 'GenericObject'])]
    public function createAction(Subscriber $subscriber): ResponseInterface
    {
        try {
            $existingSubscriber = $this->subscriberRepository->findByEmail($subscriber->getEmail());
            
            if ($existingSubscriber?->isConfirmed()) {
                $this->addFlashMessage(
                    'This email is already subscribed to our newsletter.',
                    'Already Subscribed',
                    ContextualFeedbackSeverity::INFO
                );
                
                return $this->redirect('success', null, null, ['type' => 'subscribe']);
            }
            
            if ($existingSubscriber && !$existingSubscriber->isConfirmed()) {
                $token = bin2hex(random_bytes(32));
                $existingSubscriber->setConfirmationToken($token);
                $this->subscriberRepository->update($existingSubscriber);
                $this->persistenceManager->persistAll();
                
                $this->sendConfirmationEmail($existingSubscriber, $token);
                
                $this->addFlashMessage(
                    'A new confirmation email has been sent. Please check your inbox.',
                    'Confirmation Resent',
                    ContextualFeedbackSeverity::INFO
                );
                
                return $this->redirect('success', null, null, ['type' => 'subscribe']);
            }
            
            $token = bin2hex(random_bytes(32));
            $subscriber->setConfirmationToken($token);
            $subscriber->setConfirmed(false);
            $subscriber->setSubscribedAt(new \DateTime());
            
            $this->subscriberRepository->add($subscriber);
            $this->persistenceManager->persistAll();
            
            $this->sendConfirmationEmail($subscriber, $token);
            
            $this->addFlashMessage(
                'Please check your email to confirm your subscription.',
                'Subscription Pending',
                ContextualFeedbackSeverity::INFO
            );
            
            return $this->redirect('success', null, null, ['type' => 'subscribe']);
        } catch (\Exception $e) {
            $this->addFlashMessage(
                'An error occurred during subscription. Please try again.',
                'Subscription Failed',
                ContextualFeedbackSeverity::ERROR
            );
            
            return $this->redirect('subscribe');
        }
    }

    public function confirmAction(string $token): ResponseInterface
    {
        try {
            $subscriber = $this->subscriberRepository->findByConfirmationToken($token);
            
            if (!$subscriber) {
                $this->addFlashMessage(
                    'Invalid or expired confirmation link.',
                    'Confirmation Failed',
                    ContextualFeedbackSeverity::ERROR
                );
                
                return $this->redirect('subscribe');
            }
            
            if ($subscriber->isConfirmed()) {
                $this->addFlashMessage(
                    'Your subscription has already been confirmed.',
                    'Already Confirmed',
                    ContextualFeedbackSeverity::INFO
                );
                
                return $this->redirect('success', null, null, ['type' => 'subscribe']);
            }
            
            $subscriber->setConfirmed(true);
            $subscriber->setConfirmedAt(new \DateTime());
            $subscriber->setConfirmationToken('');
            
            $this->subscriberRepository->update($subscriber);
            $this->persistenceManager->persistAll();
            
            $this->addFlashMessage(
                'Your subscription has been confirmed successfully!',
                'Subscription Confirmed',
                ContextualFeedbackSeverity::OK
            );
            
            return $this->redirect('success', null, null, ['type' => 'subscribe']);
        } catch (\Exception $e) {
            $this->addFlashMessage(
                'An error occurred during confirmation. Please try again.',
                'Confirmation Error',
                ContextualFeedbackSeverity::ERROR
            );
            
            return $this->redirect('subscribe');
        }
    }

    public function unsubscribeAction(string $email = ''): ResponseInterface
    {
        $this->view->assign('email', $email);
        
        return $this->htmlResponse();
    }

    public function removeAction(string $email, string $token): ResponseInterface
    {
        try {
            $subscriber = $this->subscriberRepository->findConfirmedByEmail($email);
            
            if (!$subscriber) {
                $this->addFlashMessage(
                    'No active subscription found for this email address.',
                    'Unsubscribe Failed',
                    ContextualFeedbackSeverity::ERROR
                );
                
                return $this->redirect('unsubscribe');
            }
            
            if ($subscriber->getConfirmationToken() !== $token) {
                $token = bin2hex(random_bytes(32));
                $subscriber->setConfirmationToken($token);
                $this->subscriberRepository->update($subscriber);
                $this->persistenceManager->persistAll();
                
                $this->sendUnsubscribeEmail($subscriber, $token);
                
                $this->addFlashMessage(
                    'We sent you an email with an unsubscribe link. Please check your inbox.',
                    'Unsubscribe Link Sent',
                    ContextualFeedbackSeverity::INFO
                );
                
                return $this->redirect('unsubscribe', null, null, ['email' => $email]);
            }
            
            $this->subscriberRepository->remove($subscriber);
            $this->persistenceManager->persistAll();
            
            $this->addFlashMessage(
                'You have been successfully unsubscribed from our newsletter.',
                'Unsubscribed',
                ContextualFeedbackSeverity::OK
            );
            
            return $this->redirect('success', null, null, ['type' => 'unsubscribe']);
        } catch (\Exception $e) {
            $this->addFlashMessage(
                'An error occurred while unsubscribing. Please try again.',
                'Unsubscribe Error',
                ContextualFeedbackSeverity::ERROR
            );
            
            return $this->redirect('unsubscribe', null, null, ['email' => $email]);
        }
    }

    public function successAction(string $type = 'subscribe'): ResponseInterface
    {
        $this->view->assign('type', $type);
        
        return $this->htmlResponse();
    }

    private function sendConfirmationEmail(Subscriber $subscriber, string $token): void
    {
        $confirmationUri = $this->uriBuilder
            ->reset()
            ->setCreateAbsoluteUri(true)
            ->uriFor('confirm', ['token' => $token]);
        
        $subject = 'Confirm your newsletter subscription';
        $body = sprintf(
            "Hello %s,\n\nThank you for subscribing to our newsletter!\n\nPlease confirm your subscription by clicking this link:\n%s\n\nIf you didn't request this subscription, please ignore this email.\n\nBest regards",
            $subscriber->getName(),
            $confirmationUri
        );
        
        $message = MailMessage::create()
            ->to($subscriber->getEmail())
            ->subject($subject)
            ->text($body);
        
        $message->send();
    }

    private function sendUnsubscribeEmail(Subscriber $subscriber, string $token): void
    {
        $unsubscribeUri = $this->uriBuilder
            ->reset()
            ->setCreateAbsoluteUri(true)
            ->uriFor('remove', ['email' => $subscriber->getEmail(), 'token' => $token]);
        
        $subject = 'Unsubscribe from newsletter';
        $body = sprintf(
            "Hello %s,\n\nTo unsubscribe from our newsletter, please click this link:\n%s\n\nBest regards",
            $subscriber->getName(),
            $unsubscribeUri
        );
        
        $message = MailMessage::create()
            ->to($subscriber->getEmail())
            ->subject($subject)
            ->text($body);
        
        $message->send();
    }
}
