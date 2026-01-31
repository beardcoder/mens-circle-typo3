<?php

declare(strict_types=1);

/*
 * Register Newsletter Form content element
 */

// Add CType
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = [
    'label' => 'Newsletter Form',
    'value' => 'sitepackage_newsletter',
    'icon' => 'content-form',
    'group' => 'forms',
    'description' => 'Newsletter subscription form with double opt-in',
];

// Configure the CType
$GLOBALS['TCA']['tt_content']['types']['sitepackage_newsletter'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            header;Newsletter Form Title,
            bodytext;Form Description,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
    ',
];
