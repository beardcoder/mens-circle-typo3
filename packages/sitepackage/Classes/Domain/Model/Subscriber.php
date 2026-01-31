<?php

declare(strict_types=1);

/*
 * Newsletter Subscriber Model
 */

namespace MensCircle\Sitepackage\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Newsletter subscriber model
 */
class Subscriber extends AbstractEntity
{
    protected string $email = '';
    
    protected string $name = '';
    
    protected bool $confirmed = false;
    
    protected string $confirmationToken = '';
    
    protected ?\DateTime $confirmedAt = null;
    
    protected ?\DateTime $subscribedAt = null;
    
    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }
    
    public function setConfirmed(bool $confirmed): void
    {
        $this->confirmed = $confirmed;
    }
    
    public function getConfirmationToken(): string
    {
        return $this->confirmationToken;
    }
    
    public function setConfirmationToken(string $confirmationToken): void
    {
        $this->confirmationToken = $confirmationToken;
    }
    
    public function getConfirmedAt(): ?\DateTime
    {
        return $this->confirmedAt;
    }
    
    public function setConfirmedAt(?\DateTime $confirmedAt): void
    {
        $this->confirmedAt = $confirmedAt;
    }
    
    public function getSubscribedAt(): ?\DateTime
    {
        return $this->subscribedAt;
    }
    
    public function setSubscribedAt(?\DateTime $subscribedAt): void
    {
        $this->subscribedAt = $subscribedAt;
    }
}
