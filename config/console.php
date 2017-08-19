<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii', 'queue'],
    'controllerNamespace' => 'app\commands',
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'generatorTemplateFiles' => [
                'create_table' => '@app/modules/core/views/templates/migration-create-mysql.php',
                'drop_table' => '@yii/views/dropTableMigration.php',
                'add_column' => '@yii/views/addColumnMigration.php',
                'drop_column' => '@yii/views/dropColumnMigration.php',
                'create_junction' => '@yii/views/createTableMigration.php',
            ],
            'migrationNamespaces' => [
                'yii\queue\db\migrations',
            ],
        ],
    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
        'core' => [
            'class' => 'app\modules\core\Module',
        ],
        'catalog' => [
            'class' => 'app\modules\catalog\Module',
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
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'categories' => ['ip_log'],
                    'logVars' => [],
                    'logFile' => '@app/runtime/logs/ip_log/errors.log',
                    'maxLogFiles' => 50,
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
        'mailContainer' => [
            'class' => '\app\modules\core\components\mailer\MailContainer',
            'mailerClient' => function() {
                return new \app\modules\core\components\mailer\clients\Mandrill();
            }
        ],
        'queue' => [
            'class' => \yii\queue\db\Queue::class,
            'db' => 'db', // DB connection component or its config
            'tableName' => '{{%queue}}', // Table name
            'channel' => 'default', // Queue channel key
            'mutex' => \yii\mutex\MysqlMutex::class, // Mutex that used to sync queries
        ],
    ],
    'params' => $params,
];
