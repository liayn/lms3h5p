<?php

return [
    'ctrl' => [
        'title' => 'LMS3 H5P Cache Asset',
        'label' => 'title',
        'iconfile' => 'EXT:lms3h5p/Resources/Public/Icons/Extension.svg'
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
                'required' => true,
                'eval' => 'trim'
            ]
        ],
        'hash_key' => [
            'label' => 'Hash key',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim'
            ]
        ],
        'type' => [
            'label' => 'Type',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim'
            ]
        ]
    ]
];
