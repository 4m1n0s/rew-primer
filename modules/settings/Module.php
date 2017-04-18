<?php

namespace app\modules\settings;
use app\modules\settings\components\KeyStorage;
/**
 * settings module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\settings\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here

        \Yii::$app->setComponents([
            'keyStorage' => [
                'class' => KeyStorage::class
            ],
        ]);
    }
}
