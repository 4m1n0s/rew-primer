<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name' => 'RewardBucks',
    'components' => [
        'request' => [
            'cookieValidationKey' => '9s0UIbx1oPmzvYl34wuOQj385fjIDOGN',
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/polo',
                'baseUrl' => '@web/themes/polo',
                'pathMap' => [
                    '@app/views' => '@app/themes/polo',
                    '@app/modules' => '@app/themes/polo/modules',
                ],
            ],
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => $params['reCaptchaSiteKey'],
            'secret' => $params['reCaptchaSecretKey'],
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => $params['baseUrl'] . '/dashboard/login',
            'identityCookie' => [
                'name' => '_identity_http_', 
                'httpOnly' => true
            ]
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['admin', 'USER'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/routes.php'),
        ],
        'i18n' => require(__DIR__ . '/i18n.php'),
        'eventManager' => [
            'class' => 'app\modules\core\components\EventManager'
        ],
        'export' => [
            'class' => 'app\modules\core\components\Export',
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'linkAssets' => true,
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ]
                ]
            ],
        ],
    ],
    'params' => $params,
    'modules' => require(__DIR__ . '/modules.php'),
];

if (YII_ENV_DEV) {
    
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
