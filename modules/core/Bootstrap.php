<?php

namespace app\modules\core;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        \Yii::$container->set('yii\widgets\Pjax', ['timeout' => '5000', 'enablePushState' => false]);
    }
}
