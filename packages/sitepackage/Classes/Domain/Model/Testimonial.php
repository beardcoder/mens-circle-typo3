<?php

declare(strict_types=1);

/*
 * Testimonial Domain Model
 */

namespace MensCircle\Sitepackage\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Testimonial model for community member experiences
 */
class Testimonial extends AbstractEntity
{
    protected string $authorName = '';
    
    protected string $content = '';
    
    protected ?\DateTime $submittedAt = null;
    
    protected bool $approved = false;
    
    public function getAuthorName(): string
    {
        return $this->authorName;
    }
    
    public function setAuthorName(string $authorName): void
    {
        $this->authorName = $authorName;
    }
    
    public function getContent(): string
    {
        return $this->content;
    }
    
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    
    public function getSubmittedAt(): ?\DateTime
    {
        return $this->submittedAt;
    }
    
    public function setSubmittedAt(?\DateTime $submittedAt): void
    {
        $this->submittedAt = $submittedAt;
    }
    
    public function isApproved(): bool
    {
        return $this->approved;
    }
    
    public function setApproved(bool $approved): void
    {
        $this->approved = $approved;
    }
}
