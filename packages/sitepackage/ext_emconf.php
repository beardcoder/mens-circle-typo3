<?php

declare(strict_types=1);

/*
 * Extension configuration for Mens Circle Sitepackage
 */

return [
    'title' => 'Mens Circle Sitepackage',
    'description' => 'Main sitepackage for Mens Circle Niederbayern website',
    'category' => 'templates',
    'author' => 'Markus Sommer',
    'author_email' => 'markus@beardcoder.de',
    'state' => 'stable',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '14.1.0-14.99.99',
        ],
    ],
];
