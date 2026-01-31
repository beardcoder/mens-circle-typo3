<?php

declare(strict_types=1);

/*
 * TCA configuration for Event model
 */

return [
    'ctrl' => [
        'title' => 'Event',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'sortby' => 'sorting',
        'searchFields' => 'title,description,location',
        'iconfile' => 'EXT:sitepackage/Resources/Public/Icons/event.svg',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    title, slug, description,
                --div--;Date & Location,
                    start_date, end_date, location,
                --div--;Capacity,
                    max_participants, current_participants,
                --div--;Access,
                    hidden, starttime, endtime
            ',
        ],
    ],
    'columns' => [
        'hidden' => [
            'label' => 'Hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    ['label' => 'Hide event', 'value' => 1],
                ],
            ],
        ],
        'starttime' => [
            'label' => 'Publish Date',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'label' => 'Unpublish Date',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
        ],
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'trim,required',
            ],
        ],
        'slug' => [
            'label' => 'URL Slug',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['title'],
                    'replacements' => [
                        '/' => '-',
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
            ],
        ],
        'description' => [
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'rows' => 10,
            ],
        ],
        'start_date' => [
            'label' => 'Start Date',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'required' => true,
            ],
        ],
        'end_date' => [
            'label' => 'End Date',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
            ],
        ],
        'location' => [
            'label' => 'Location',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'max_participants' => [
            'label' => 'Maximum Participants',
            'config' => [
                'type' => 'number',
                'size' => 5,
                'default' => 0,
            ],
        ],
        'current_participants' => [
            'label' => 'Current Participants',
            'config' => [
                'type' => 'number',
                'size' => 5,
                'default' => 0,
                'readOnly' => true,
            ],
        ],
    ],
];
