<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_valueitem',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'sortby' => 'sorting',
        'hideTable' => true,
        'searchFields' => 'title,description,icon',
        'iconfile' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-text.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => 'title, description, icon',
        ],
    ],
    'columns' => [
        'title' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_valueitem.title',
            'config' => [
                'type' => 'input',
                'size' => 60,
                'max' => 255,
                'eval' => 'trim,required',
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_valueitem.description',
            'config' => [
                'type' => 'text',
                'rows' => 10,
                'required' => true,
            ],
        ],
        'icon' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_valueitem.icon',
            'config' => [
                'type' => 'input',
                'size' => 60,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'parent_uid' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
