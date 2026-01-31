<?php

declare(strict_types=1);

use MensCircle\Sitepackage\Controller\EventRegistrationController;
use MensCircle\Sitepackage\Controller\NewsletterController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

(static function (): void {
    // Register Event Registration plugin
    ExtensionUtility::configurePlugin(
        'Sitepackage',
        'EventRegistration',
        [
            EventRegistrationController::class => 'new, create, confirm, success',
        ],
        [
            EventRegistrationController::class => 'create, confirm',
        ]
    );

    // Register Newsletter plugin
    ExtensionUtility::configurePlugin(
        'Sitepackage',
        'Newsletter',
        [
            NewsletterController::class => 'subscribe, create, confirm, unsubscribe, remove, success',
        ],
        [
            NewsletterController::class => 'create, confirm, remove',
        ]
    );
})();
