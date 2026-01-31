<?php

declare(strict_types=1);

(static function (): void {
    $GLOBALS['TCA']['tt_content']['columns']['tx_sitepackage_journey_steps'] = [
        'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang.xlf:journey.tab',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_sitepackage_domain_model_journeystep',
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

    $GLOBALS['TCA']['tt_content']['types']['mc_journey'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
                subheader;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:subheader_formlabel,
                bodytext;LLL:EXT:sitepackage/Resources/Private/Language/locallang.xlf:journey.description,
            --div--;LLL:EXT:sitepackage/Resources/Private/Language/locallang.xlf:journey.tab,
                tx_sitepackage_journey_steps,
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
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => false,
                ],
            ],
        ],
    ];

    $GLOBALS['TCA']['tt_content']['types']['mc_journey']['previewRenderer'] = \MensCircle\Sitepackage\Preview\JourneyPreviewRenderer::class;

    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['mc_journey'] = 'content-timeline';
})();
