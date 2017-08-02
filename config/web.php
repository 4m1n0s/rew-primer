<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'app\modules\user\Bootstrap',
    ],
    'name' => 'RewardBucks',
    'components' => [
        'request' => [
            'cookieValidationKey' => '9s0UIbx1oPmzvYl34wuOQj385fjIDOGN',
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache',
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
                    'except' => ['yii\web\HttpException:404'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'categories' => ['yii\web\HttpException:404'],
                    'logFile' => '@runtime/logs/404/errors.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'categories' => ['transaction'],
                    'logVars' => ['_POST', '_GET', '_SERVER'],
                    'logFile' => '@app/runtime/logs/transactions/errors.log',
                    'maxLogFiles' => 50,
                ],
                [
                    'class' => 'app\modules\core\components\log\DbTargetPostback',
                    'levels' => ['error', 'warning', 'info'],
                    'categories' => ['offer_postback'],
                    'logVars' => [],    // Exclude next message with vars
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
        'keyStorage' => [
            'class' => '\app\modules\settings\components\KeyStorage'
        ],
        'geoLocation' => [
            'class' => '\app\modules\core\components\geolocation\GeoLocation',
            'clientClassName' => '\app\modules\core\components\geolocation\clients\MaxMind'
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
        'globalTexts' => [
            'class' => '\app\modules\core\components\GlobalTexts'
        ],
        'offerFactory' => [
            'class' => '\app\modules\offer\components\OfferFactory',
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'products',
        ],
        'transactionCreator' => [
            'class' => '\app\modules\core\components\TransactionCreator',
        ],
        'ipNormalizer' => [
            'class' => '\app\modules\core\components\IPNormalizer',
        ],
        'mailContainer' => [
            'class' => '\app\modules\core\components\mailer\MailContainer',
            'mailerClient' => function() {
                return new \app\modules\core\components\mailer\clients\Mandrill();
            }
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
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'rewardbucks-backend-crud' => '@app/gii-templates/backend/crud/default',
                ]
            ]
        ],
    ];
}

return $config;
