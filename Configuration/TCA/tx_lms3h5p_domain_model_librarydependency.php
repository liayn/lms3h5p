<?php

return [
    'ctrl' => [
        'title' => 'LMS3 H5P Library Dependency',
        'label' => 'title',
        'iconfile' => 'EXT:lms3h5p/Resources/Public/Icons/Extension.svg'
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
                'required' => true,
                'eval' => 'trim'
            ]
        ],
        'required_library' => [
            'label' => 'Required Library',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim'
            ]
        ],
        'dependency_type' => [
            'label' => 'Dependency Type',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim'
            ]
        ]
    ]
];
