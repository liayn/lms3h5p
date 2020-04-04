<?php

return [
    'ctrl' => [
        'title' => 'LMS3 H5P Content Dependency',
        'label' => 'title',
        'iconfile' => 'EXT:lms3h5p/Resources/Public/Icons/h5p.svg'
    ],
    'types' => [
        '1' => [
            'showitem' => '
                content, library, dependency_type, weight, drop_css
            '
        ]
    ],
    'columns' => [
        'content' => [
            'label' => 'Content',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required'
            ]
        ],
        'library' => [
            'label' => 'Library',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required'
            ]
        ],
        'dependency_type' => [
            'label' => 'Dependency Type',
            'config' => [
                'type' => 'input'
            ]
        ],
        'weight' => [
            'label' => 'Type',
            'config' => [
                'type' => 'input'
            ]
        ],
        'drop_css' => [
            'label' => 'Drop Css',
            'config' => [
                'type' => 'input',
            ]
        ]
    ]
];