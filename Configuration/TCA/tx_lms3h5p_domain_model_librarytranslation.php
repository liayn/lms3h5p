<?php

return [
    'ctrl' => [
        'title' => 'LMS3 H5P Library Translation',
        'label' => 'title',
        'iconfile' => 'EXT:lms3h5p/Resources/Public/Icons/h5p.svg'
    ],
    'types' => [
        '1' => [
            'showitem' => '
                library, language_code, translation
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
        'language_code' => [
            'label' => 'Language Code',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim'
            ]
        ],
        'translation' => [
            'label' => 'Translation',
            'config' => [
                'type' => 'text',
                'required' => true,
                'eval' => 'trim'
            ]
        ]
    ]
];