<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_faqitem',
        'label' => 'question',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'sortby' => 'sorting',
        'hideTable' => true,
        'searchFields' => 'question,answer',
        'iconfile' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-text.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => 'question, answer',
        ],
    ],
    'columns' => [
        'question' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_faqitem.question',
            'config' => [
                'type' => 'input',
                'size' => 60,
                'max' => 255,
                'eval' => 'trim,required',
            ],
        ],
        'answer' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_faqitem.answer',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'rows' => 10,
                'required' => true,
            ],
        ],
        'parent_uid' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
