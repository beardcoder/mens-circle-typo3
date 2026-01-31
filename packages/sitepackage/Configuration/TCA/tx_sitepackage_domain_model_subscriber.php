<?php

declare(strict_types=1);

/*
 * TCA configuration for Subscriber model
 */

return [
    'ctrl' => [
        'title' => 'Newsletter Subscriber',
        'label' => 'email',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'searchFields' => 'email,name',
        'iconfile' => 'EXT:sitepackage/Resources/Public/Icons/subscriber.svg',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '
                email, name, confirmed, confirmation_token,
                confirmed_at, subscribed_at,
                --div--;Access, hidden
            ',
        ],
    ],
    'columns' => [
        'hidden' => [
            'label' => 'Hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'email' => [
            'label' => 'Email',
            'config' => [
                'type' => 'email',
                'size' => 30,
                'required' => true,
            ],
        ],
        'name' => [
            'label' => 'Name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'confirmed' => [
            'label' => 'Confirmed',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'confirmation_token' => [
            'label' => 'Confirmation Token',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'readOnly' => true,
            ],
        ],
        'confirmed_at' => [
            'label' => 'Confirmed At',
            'config' => [
                'type' => 'datetime',
                'readOnly' => true,
            ],
        ],
        'subscribed_at' => [
            'label' => 'Subscribed At',
            'config' => [
                'type' => 'datetime',
                'readOnly' => true,
            ],
        ],
    ],
];
