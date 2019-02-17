<?php

return [
    'ctrl' => [
        'title' => 'LMS3 H5P Cache Asset',
        'label' => 'title',
        'iconfile' => 'EXT:lms3h5p/Resources/Public/Icons/h5p.svg'
    ],
    'interface' => [
        'showRecordFieldList' => 'library, hash_key, type',
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