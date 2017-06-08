<?php

namespace app\modules\core;

use yii\console\Application as ConsoleApplication;

/**
 * Class Module 
 * 
 * @author Stableflow
 * 
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\core\controllers';

    public function init() {
        parent::init();

        if (\Yii::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'app\modules\core\commands';
        }
    }

}
