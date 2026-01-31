<?php

declare(strict_types=1);

/*
 * Register Testimonials List content element
 */

// Add CType
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = [
    'label' => 'Testimonials List',
    'value' => 'sitepackage_testimonials',
    'icon' => 'content-text',
    'group' => 'default',
    'description' => 'Display approved testimonials from community members',
];

// Configure the CType
$GLOBALS['TCA']['tt_content']['types']['sitepackage_testimonials'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            header;Testimonials Section Title,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
    ',
];
