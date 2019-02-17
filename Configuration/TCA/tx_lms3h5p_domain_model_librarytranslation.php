<?php

return [
    'ctrl' => [
        'title' => 'LMS3 H5P Library Translation',
        'label' => 'title',
        'iconfile' => 'EXT:lms3h5p/Resources/Public/Icons/h5p.svg'
    ],
    'interface' => [
        'showRecordFieldList' => 'library, language_code, translation',
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
                'eval' => 'trim,required'
            ]
        ],
        'language_code' => [
            'label' => 'Language Code',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required'
            ]
        ],
        'translation' => [
            'label' => 'Translation',
            'config' => [
                'type' => 'text',
                'eval' => 'trim,required'
            ]
        ]
    ]
];