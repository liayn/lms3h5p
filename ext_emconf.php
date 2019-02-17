<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'LMS3 H5P',
    'description' => 'H5P Platform Integration Plugin for TYPO3 CMS.',
    'category' => 'misc',
    'author' => 'Sagar Desai',
    'author_email' => 'sagar.desai@lms3.de',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-9.5.99',
        ],
    ],
];
