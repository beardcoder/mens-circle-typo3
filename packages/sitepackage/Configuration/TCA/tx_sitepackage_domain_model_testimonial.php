<?php

declare(strict_types=1);

/*
 * TCA configuration for Testimonial model
 */

return [
    'ctrl' => [
        'title' => 'Testimonial',
        'label' => 'author_name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'searchFields' => 'author_name,content',
        'iconfile' => 'EXT:sitepackage/Resources/Public/Icons/testimonial.svg',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '
                author_name, content, approved, submitted_at,
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
        'author_name' => [
            'label' => 'Author Name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'required' => true,
            ],
        ],
        'content' => [
            'label' => 'Testimonial Content',
            'config' => [
                'type' => 'text',
                'rows' => 10,
                'required' => true,
            ],
        ],
        'approved' => [
            'label' => 'Approved',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'submitted_at' => [
            'label' => 'Submitted At',
            'config' => [
                'type' => 'datetime',
                'readOnly' => true,
            ],
        ],
    ],
];
