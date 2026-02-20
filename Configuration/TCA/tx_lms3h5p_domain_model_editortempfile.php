<?php

return [
    'ctrl' => [
        'title' => 'LMS3 H5P Editor Temp File',
        'label' => 'path',
        'iconfile' => 'EXT:lms3h5p/Resources/Public/Icons/h5p.svg'
    ],
    'types' => [
        '1' => [
            'showitem' => '
                path, created_at
            '
        ]
    ],
    'columns' => [
        'path' => [
            'label' => 'Path',
            'config' => [
                'type' => 'input'
            ]
        ],
        'created_at' => [
            'label' => 'Created At',
            'config' => [
                'type' => 'text'
            ]
        ]
    ]
];