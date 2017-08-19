<?php

namespace app\modules\catalog;

use yii\console\Application as ConsoleApplication;

/**
 * catalog module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\catalog\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (\Yii::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'app\modules\catalog\commands';
        }
    }
}
