<?php

declare(strict_types=1);

/*
 * Register custom content element: Event List
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Add CType
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = [
    'label' => 'Event List',
    'value' => 'sitepackage_eventlist',
    'icon' => 'content-text',
    'group' => 'default',
    'description' => 'Display a list of upcoming events',
];

// Configure the CType
$GLOBALS['TCA']['tt_content']['types']['sitepackage_eventlist'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            header;Event List Title,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
    ',
];
