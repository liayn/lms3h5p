<?php

return [
    'ctrl' => [
        'title' => 'LMS3 H5P Library',
        'label' => 'title',
        'iconfile' => 'EXT:lms3h5p/Resources/Public/Icons/Extension.svg',
        'rootLevel' => -1
    ],
    'types' => [
        '1' => [
            'showitem' => '
                name, title, major_version, minor_version, patch_version, runnable, restricted, fullscreen, embed_types
            '
        ]
    ],
    'columns' => [
        'name' => [
            'label' => 'Name',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim'
            ]
        ],
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim'
            ]
        ],
        'major_version' => [
            'label' => 'Major Version',
            'config' => [
                'type' => 'input'
            ]
        ],
        'minor_version' => [
            'label' => 'Minor Version',
            'config' => [
                'type' => 'input'
            ]
        ],
        'patch_version' => [
            'label' => 'Patch Version',
            'config' => [
                'type' => 'input',
            ]
        ],
        'runnable' => [
            'label' => 'Runnable',
            'config' => [
                'type' => 'input',
            ]
        ],
        'restricted' => [
            'label' => 'Restricted',
            'config' => [
                'type' => 'input',
            ]
        ],
        'fullscreen' => [
            'label' => 'Fullscreen',
            'config' => [
                'type' => 'input',
            ]
        ],
        'embed_types' => [
            'label' => 'Embed Types',
            'config' => [
                'type' => 'text',
            ]
        ],
        'preloaded_js' => [
            'label' => 'Preloaded JS',
            'config' => [
                'type' => 'text',
            ]
        ],
        'preloaded_css' => [
            'label' => 'Preloaded CSS',
            'config' => [
                'type' => 'input',
            ]
        ],
        'drop_library_css' => [
            'label' => 'Drop Library CSS',
            'config' => [
                'type' => 'input',
            ]
        ],
        'semantics' => [
            'label' => 'Semantics',
            'config' => [
                'type' => 'input',
            ]
        ],
        'tutorial_url' => [
            'label' => 'Tutorial URL?',
            'config' => [
                'type' => 'input',
            ]
        ],
        'has_icon' => [
            'label' => 'Has icon',
            'config' => [
                'type' => 'input',
            ]
        ],
        'meta_data_settings' => [
            'label' => 'Meta data settings',
            'config' => [
                'type' => 'input',
            ]
        ],
        'add_to' => [
            'label' => 'Add to',
            'config' => [
                'type' => 'input',
            ]
        ],
        'created_at' => [
            'label' => 'Created At',
            'config' => [
                'type' => 'input',
            ]
        ],
        'updated_at' => [
            'label' => 'Updated At',
            'config' => [
                'type' => 'input',
            ]
        ]
    ]
];
