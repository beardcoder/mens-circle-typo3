<?php

declare(strict_types=1);

/*
 * Event Repository
 */

namespace MensCircle\Sitepackage\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for Event model
 */
class EventRepository extends Repository
{
    /**
     * Find all upcoming events ordered by start date
     */
    public function findUpcoming(): array
    {
        $query = $this->createQuery();
        $query->matching(
            $query->greaterThan('startDate', time())
        );
        $query->setOrderings(['startDate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING]);
        
        return $query->execute()->toArray();
    }
    
    /**
     * Find event by slug
     */
    public function findBySlug(string $slug): ?object
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('slug', $slug)
        );
        
        return $query->execute()->getFirst();
    }
}
