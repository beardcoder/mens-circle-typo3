<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'Event Registration',
        'label' => 'name',
        'label_alt' => 'email',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'hideTable' => false,
        'searchFields' => 'name,email,phone',
        'iconfile' => 'EXT:sitepackage/Resources/Public/Icons/registration.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;Registration Details,
                    event, name, email, phone, message,
                --div--;Confirmation,
                    confirmed, confirmation_token, confirmed_at
            ',
        ],
    ],
    'columns' => [
        'event' => [
            'label' => 'Event',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_sitepackage_domain_model_event',
                'foreign_table_where' => 'ORDER BY tx_sitepackage_domain_model_event.title',
                'required' => true,
            ],
        ],
        'name' => [
            'label' => 'Name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'trim,required',
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
        'phone' => [
            'label' => 'Phone',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 50,
                'eval' => 'trim',
            ],
        ],
        'message' => [
            'label' => 'Message',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'cols' => 50,
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
        'confirmed' => [
            'label' => 'Confirmed',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'confirmed_at' => [
            'label' => 'Confirmed At',
            'config' => [
                'type' => 'datetime',
                'readOnly' => true,
            ],
        ],
    ],
];
