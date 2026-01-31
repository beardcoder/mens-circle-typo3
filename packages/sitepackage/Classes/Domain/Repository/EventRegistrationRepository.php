<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Domain\Repository;

use MensCircle\Sitepackage\Domain\Model\Event;
use MensCircle\Sitepackage\Domain\Model\EventRegistration;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class EventRegistrationRepository extends Repository
{
    public function findByConfirmationToken(string $token): ?EventRegistration
    {
        $query = $this->createQuery();
        $query->matching($query->equals('confirmationToken', $token));
        
        return $query->execute()->getFirst();
    }

    public function findConfirmedByEvent(Event $event): array
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('event', $event),
                $query->equals('confirmed', true)
            )
        );
        $query->setOrderings(['confirmedAt' => QueryInterface::ORDER_DESCENDING]);
        
        return $query->execute()->toArray();
    }

    public function countConfirmedByEvent(Event $event): int
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('event', $event),
                $query->equals('confirmed', true)
            )
        );
        
        return $query->execute()->count();
    }
}
