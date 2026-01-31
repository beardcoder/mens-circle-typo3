<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_journeystep',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'sortby' => 'sorting',
        'hideTable' => true,
        'searchFields' => 'title,description',
        'iconfile' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-text.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => 'title, step_number, description',
        ],
    ],
    'columns' => [
        'title' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_journeystep.title',
            'config' => [
                'type' => 'input',
                'size' => 60,
                'max' => 255,
                'eval' => 'trim,required',
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_journeystep.description',
            'config' => [
                'type' => 'text',
                'rows' => 10,
                'required' => true,
            ],
        ],
        'step_number' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_journeystep.step_number',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'int',
            ],
        ],
        'parent_uid' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
