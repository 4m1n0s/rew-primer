<?php

namespace app\modules\dashboard;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'app\modules\dashboard\controllers';

    public function init() {
        parent::init();

        \Yii::$app->user->loginUrl = '/dashboard/login';
    }
}
