<?php

declare(strict_types=1);

/*
 * Event Domain Model
 */

namespace MensCircle\Sitepackage\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation as Extbase;

/**
 * Event model representing a men's circle event
 */
class Event extends AbstractEntity
{
    protected string $title = '';
    
    protected string $description = '';
    
    protected ?\DateTime $startDate = null;
    
    protected ?\DateTime $endDate = null;
    
    protected string $location = '';
    
    protected int $maxParticipants = 0;
    
    protected int $currentParticipants = 0;
    
    protected string $slug = '';
    
    #[Extbase\Validate(['validator' => 'StringLength', 'options' => ['minimum' => 3, 'maximum' => 255]])]
    public function getTitle(): string
    {
        return $this->title;
    }
    
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    
    public function getDescription(): string
    {
        return $this->description;
    }
    
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    
    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }
    
    public function setStartDate(?\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }
    
    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }
    
    public function setEndDate(?\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }
    
    public function getLocation(): string
    {
        return $this->location;
    }
    
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }
    
    public function getMaxParticipants(): int
    {
        return $this->maxParticipants;
    }
    
    public function setMaxParticipants(int $maxParticipants): void
    {
        $this->maxParticipants = $maxParticipants;
    }
    
    public function getCurrentParticipants(): int
    {
        return $this->currentParticipants;
    }
    
    public function setCurrentParticipants(int $currentParticipants): void
    {
        $this->currentParticipants = $currentParticipants;
    }
    
    public function getSlug(): string
    {
        return $this->slug;
    }
    
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
    
    public function isFull(): bool
    {
        return $this->currentParticipants >= $this->maxParticipants;
    }
    
    public function isUpcoming(): bool
    {
        if ($this->startDate === null) {
            return false;
        }
        
        return $this->startDate > new \DateTime();
    }
}
