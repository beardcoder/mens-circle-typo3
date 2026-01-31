<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_introvalue',
        'label' => 'label',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'sortby' => 'sorting',
        'hideTable' => true,
        'searchFields' => 'label,value',
        'iconfile' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-text.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => 'label, value',
        ],
    ],
    'columns' => [
        'label' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_introvalue.label',
            'config' => [
                'type' => 'input',
                'size' => 60,
                'max' => 255,
                'eval' => 'trim,required',
            ],
        ],
        'value' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_introvalue.value',
            'config' => [
                'type' => 'input',
                'size' => 60,
                'max' => 255,
                'eval' => 'trim,required',
            ],
        ],
        'parent_uid' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
