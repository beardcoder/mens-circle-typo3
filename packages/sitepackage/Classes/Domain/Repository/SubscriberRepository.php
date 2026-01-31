<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Domain\Repository;

use MensCircle\Sitepackage\Domain\Model\Subscriber;
use TYPO3\CMS\Extbase\Persistence\Repository;

class SubscriberRepository extends Repository
{
    public function findByEmail(string $email): ?Subscriber
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('email', $email)
        );
        
        return $query->execute()->getFirst();
    }
    
    public function findByConfirmationToken(string $token): ?Subscriber
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('confirmationToken', $token)
        );
        
        return $query->execute()->getFirst();
    }
    
    public function findConfirmedByEmail(string $email): ?Subscriber
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('email', $email),
                $query->equals('confirmed', true)
            )
        );
        
        return $query->execute()->getFirst();
    }
}
