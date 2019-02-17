<?php

return [
    'ctrl' => [
        'title' => 'LMS3 H5P Library Dependency',
        'label' => 'title',
        'iconfile' => 'EXT:lms3h5p/Resources/Public/Icons/h5p.svg'
    ],
    'interface' => [
        'showRecordFieldList' => 'library, required_library, dependency_type',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                library, required_library, dependency_type
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
        'required_library' => [
            'label' => 'Required Library',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required'
            ]
        ],
        'dependency_type' => [
            'label' => 'Dependency Type',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required'
            ]
        ]
    ]
];