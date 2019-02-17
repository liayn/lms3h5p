<?php

return [
    'ctrl' => [
        'title' => 'LMS3 H5P Setting',
        'label' => 'title',
        'iconfile' => 'EXT:lms3h5p/Resources/Public/Icons/h5p.svg'
    ],
    'interface' => [
        'showRecordFieldList' => 'config_key, config_value',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                config_key, config_value
            '
        ]
    ],
    'columns' => [
        'config_key' => [
            'label' => 'Config Key',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required'
            ]
        ],
        'config_value' => [
            'label' => 'Config Value',
            'config' => [
                'type' => 'text',
                'eval' => 'trim,required'
            ]
        ],
    ]
];