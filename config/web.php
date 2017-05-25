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
            /*'theme' => [
                'basePath' => '@app/themes/polo',
                'baseUrl' => '@web/themes/polo',
                'pathMap' => [
                    '@app/views' => '@app/themes/polo',
                    '@app/modules' => '@app/themes/polo/modules',
                ],
            ],*/
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
            'loginUrl' => $params['baseUrl'] . '/sign-in',
            'identityCookie' => [
                'name' => '_identity_http_', 
                'httpOnly' => true
            ],
            'on afterLogin' => ['app\modules\user\listeners\UserListener', 'onSuccessAutoLogin']
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
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'categories' => ['offer_postback'],
                    'logVars' => ['_POST', '_GET', '_SERVER'],
                    'logFile' => '@app/runtime/logs/offers/errors.log',
                    'maxLogFiles' => 50,
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'categories' => ['transaction'],
                    'logVars' => ['_POST', '_GET', '_SERVER'],
                    'logFile' => '@app/runtime/logs/transactions/errors.log',
                    'maxLogFiles' => 50,
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
            'class' => 'app\modules\core\components\EventManager',
            'events' => [
                'user.after.logout'                 => ['app\modules\user\listeners\UserListener', 'onAfterLogout'],
                'user.before.logout'                => ['app\modules\user\listeners\UserListener', 'onBeforeLogout'],

                'user.after.login'                  => ['app\modules\user\listeners\UserListener', 'onAfterLogin'],
                'user.before.login'                 => ['app\modules\user\listeners\UserListener', 'onBeforeLogin'],
                'user.success.login'                => ['app\modules\user\listeners\UserListener', 'onSuccessLogin'],
                'user.failure.login'                => ['app\modules\user\listeners\UserListener', 'onFailureLogin'],

                'user.success.activate'             => ['app\modules\user\listeners\UserListener', 'onSuccessActivateAccount'],
                'user.failure.activate'             => ['app\modules\user\listeners\UserListener', 'onFailureActivateAccount'],

                'user.success.email.confirm'        => ['app\modules\user\listeners\UserListener', 'onSuccessEmailConfirm'],
                'user.failure.email.confirm'        => ['app\modules\user\listeners\UserListener', 'onFailureEmailConfirm'],

                'user.before.password.recovery'     => ['app\modules\user\listeners\UserListener', 'onBeforePasswordRecovery'],
                'user.success.password.recovery'    => ['app\modules\user\listeners\UserListener', 'onSuccessPasswordRecovery'],
                'user.failure.password.recovery'    => ['app\modules\user\listeners\UserListener', 'onFailurePasswordRecovery'],

                'user.before.password.reset'        => ['app\modules\user\listeners\UserListener', 'onBeforePasswordRecoveryReset'],
                'user.success.password.reset'       => ['app\modules\user\listeners\UserListener', 'onSuccessPasswordRecoveryReset'],
                'user.failure.password.reset'       => ['app\modules\user\listeners\UserListener', 'onFailurePasswordRecoveryReset'],

                'user.success.registration'         => ['app\modules\user\listeners\UserListener', 'onSuccessRegistration'],
                'user.failure.registration'         => ['app\modules\user\listeners\UserListener', 'onFailureRegistration'],
            ]
        ],
        'export' => [
            'class' => 'app\modules\core\components\Export',
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'linkAssets' => false,
            'forceCopy' => true,
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
        'mandrillMailer' => [
            'class' => 'app\components\MandrillMailer'
        ],
        'keyStorage' => [
            'class' => '\app\modules\settings\components\KeyStorage'
        ],
        'geoLocation' => [
            'class' => '\app\modules\core\components\geolocation\Location',
            'clientClassName' => '\app\modules\core\components\geolocation\ClientIPInfo'
        ],
        'userManager' => [
            'class' => '\app\modules\user\components\UserManager'
        ],
        'authenticationManager' => [
            'class' => '\app\modules\user\components\AuthenticationManager'
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => require(__DIR__ . '/auth-clients.php'),
        ],
        'virtualCurrency' => [
            'class' => '\app\modules\core\components\VirtualCurrency'
        ]
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
