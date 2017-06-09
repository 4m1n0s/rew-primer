<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
        'core' => [
            'class' => 'app\modules\core\Module',
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/routes.php'),
            'baseUrl' => '/',
            'hostInfo' => $params['baseUrl']
        ],
        'db' => $db,
        'mandrillMailer' => [
            'class' => 'app\components\MandrillMailer'
        ],
        'keyStorage' => [
            'class' => '\app\modules\settings\components\KeyStorage'
        ],
        'geoLocation' => [
            'class' => '\app\modules\core\components\geolocation\GeoLocation',
            'clientClassName' => '\app\modules\core\components\geolocation\clients\MaxMind'
        ],
        'offerFactory' => [
            'class' => '\app\modules\offer\components\OfferFactory',
        ],
    ],
    'params' => $params,
];
