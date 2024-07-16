<?php

return [
    'ctrl' => [
        'title' => 'LMS3 H5P Cache Asset',
        'label' => 'library',
        'iconfile' => 'EXT:lms3h5p/Resources/Public/Icons/h5p.svg'
    ],
    'types' => [
        '1' => [
            'showitem' => '
                library, hash_key, type
            '
        ]
    ],
    'columns' => [
        'library' => [
            'label' => 'Library',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required'
            ]
        ],
        'hash_key' => [
            'label' => 'Hash key',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required'
            ]
        ],
        'type' => [
            'label' => 'Type',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required'
            ]
        ]
    ]
];