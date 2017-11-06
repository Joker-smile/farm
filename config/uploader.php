<?php

return [
    'strategies' => [
        /**
         * default strategy.
         */
        'default' => [
            'input_name' => 'file',
            'mimes' => ['image/jpeg', 'image/png', 'image/bmp', 'image/gif'],
            'disk' => env('FILE_DISK', 'public'),
            'directory' => '{Y}/{m}/{d}', // directory,
            'max_file_size' => '2m',
        ],

        // avatar extends default
        'avatar' => [
            'directory' => 'avatars/{Y}/{m}/{d}',
        ],
    ],
];

// @uploader('file', ['strategy' => 'avatar', 'data' => [$product->images]])
