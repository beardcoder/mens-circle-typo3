<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(static function (): void {
    ExtensionManagementUtility::addTcaSelectItemGroup(
        'tt_content',
        'CType',
        'menscircle',
        'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:content.group.menscircle',
        'after:common'
    );

    $columns = [
        'tx_sitepackage_button_text' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tt_content.tx_sitepackage_button_text',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'tx_sitepackage_button_link' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tt_content.tx_sitepackage_button_link',
            'config' => [
                'type' => 'link',
                'allowedTypes' => ['page', 'url', 'record', 'file', 'folder', 'email', 'telephone'],
            ],
        ],
        'tx_sitepackage_quote' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tt_content.tx_sitepackage_quote',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'eval' => 'trim',
            ],
        ],
    ];

    ExtensionManagementUtility::addTCAcolumns('tt_content', $columns);
})();
