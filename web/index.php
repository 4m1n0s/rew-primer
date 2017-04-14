<?php

if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '178.150.106.58', '::1'])) {
    defined('YII_ENV') or define('YII_ENV', 'live');
    defined('YII_DEBUG') or define('YII_DEBUG', false);
}else{
    defined('YII_ENV') or define('YII_ENV', 'dev');
    defined('YII_DEBUG') or define('YII_DEBUG', true);
}

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
