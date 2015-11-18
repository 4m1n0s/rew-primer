<?php

namespace app\modules\user;

use app\modules\user\events\UserEvents;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'app\modules\user\controllers';
    public $loginSuccess = '/';
    public $logoutSuccess = '/';
    
    public function init() {
        \Yii::$app->get('i18n')->translations['user*'] = [
            'class' => \yii\i18n\PhpMessageSource::className(),
            'basePath' => __DIR__ . '/messages',
        ];
        
        \Yii::$app->setComponents([
            'userManager' => [
                'class' => '\app\modules\user\components\UserManager'
            ]
        ]);
        
        \Yii::$app->setComponents([
            'authenticationManager' => [
                'class' => '\app\modules\user\components\AuthenticationManager'
            ]
        ]);
        
        if (\Yii::$app->has('eventManager')) {
            \Yii::$app->get('eventManager')->events = \yii\helpers\ArrayHelper::merge(\Yii::$app->get('eventManager')->events, [
                UserEvents::AFTER_LOGOUT                => ['app\modules\user\listeners\UserListener', 'onAfterLogout'],
                UserEvents::BEFORE_LOGOUT               => ['app\modules\user\listeners\UserListener', 'onBeforeLogout'],
                
                UserEvents::AFTER_LOGIN                 => ['app\modules\user\listeners\UserListener', 'onAfterLogin'],
                UserEvents::BEFORE_LOGIN                => ['app\modules\user\listeners\UserListener', 'onBeforeLogin'],
                UserEvents::SUCCESS_LOGIN               => ['app\modules\user\listeners\UserListener', 'onSuccessLogin'],
                UserEvents::FAILURE_LOGIN               => ['app\modules\user\listeners\UserListener', 'onFailureLogin'],
                
                UserEvents::SUCCESS_ACTIVATE_ACCOUNT    => ['app\modules\user\listeners\UserListener', 'onSuccessActivateAccount'],
                UserEvents::FAILURE_ACTIVATE_ACCOUNT    => ['app\modules\user\listeners\UserListener', 'onFailureActivateAccount'],
                
                UserEvents::SUCCESS_EMAIL_CONFIRM       => ['app\modules\user\listeners\UserListener', 'onSuccessEmailConfirm'],
                UserEvents::FAILURE_EMAIL_CONFIRM       => ['app\modules\user\listeners\UserListener', 'onFailureEmailConfirm'],
                
                UserEvents::BEFORE_PASSWORD_RECOVERY    => ['app\modules\user\listeners\UserListener', 'onBeforePasswordRecovery'],
                UserEvents::SUCCESS_PASSWORD_RECOVERY   => ['app\modules\user\listeners\UserListener', 'onSuccessPasswordRecovery'],
                UserEvents::FAILURE_PASSWORD_RECOVERY   => ['app\modules\user\listeners\UserListener', 'onFailurePasswordRecovery'],
                
                UserEvents::BEFORE_PASSWORD_RESET       => ['app\modules\user\listeners\UserListener', 'onBeforePasswordRecoveryReset'],
                UserEvents::SUCCESS_PASSWORD_RESET      => ['app\modules\user\listeners\UserListener', 'onSuccessPasswordRecoveryReset'],
                UserEvents::FAILURE_PASSWORD_RESET      => ['app\modules\user\listeners\UserListener', 'onFailurePasswordRecoveryReset'],
                
                UserEvents::SUCCESS_REGISTRATION        => ['app\modules\user\listeners\UserListener', 'onSuccessRegistration'],
                UserEvents::FAILURE_REGISTRATION        => ['app\modules\user\listeners\UserListener', 'onFailureRegistration'],
            ]);
        }

        return parent::init();
    }

}
