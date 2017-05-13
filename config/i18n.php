<?php

return [
    'translations' => [
        'admin' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'fileMap' => [
                'admin*' => 'admin.php',
            ],
        ],
        'user' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => __DIR__ . '/modules/user/messages',
            'fileMap' => [
                'user*' => 'user.php',
            ],
        ]
    ],
];
