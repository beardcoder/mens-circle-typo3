<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(static function (): void {
    ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tt_content.mc_intro',
            'description' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tt_content.mc_intro.description',
            'value' => 'mc_intro',
            'icon' => 'content-text',
            'group' => 'menscircle',
        ]
    );

    $GLOBALS['TCA']['tt_content']['columns']['tx_sitepackage_intro_values'] = [
        'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tabs.settings',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_sitepackage_domain_model_introvalue',
            'foreign_field' => 'parent_uid',
            'foreign_sortby' => 'sorting',
            'maxitems' => 20,
            'appearance' => [
                'collapseAll' => true,
                'expandSingle' => true,
                'levelLinksPosition' => 'bottom',
                'useSortable' => true,
                'showPossibleLocalizationRecords' => true,
                'showAllLocalizationLink' => true,
                'showSynchronizationLink' => true,
            ],
        ],
    ];

    $GLOBALS['TCA']['tt_content']['types']['mc_intro'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,
                subheader;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:subheader_formlabel,
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
                bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
                tx_sitepackage_quote,
            --div--;LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tabs.settings,
                tx_sitepackage_intro_values,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:appearance,
                --palette--;;frames,
                --palette--;;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
    ];
})();
