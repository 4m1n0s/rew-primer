<?php

namespace app\modules\user;

use app\modules\user\events\UserEvents;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        \Yii::$app->eventManager->attachEvent(UserEvents::BEFORE_LOGIN, ['app\modules\user\listeners\UserListener', 'onBeforeLogin']);
        \Yii::$app->eventManager->attachEvent(UserEvents::AFTER_LOGIN, ['app\modules\user\listeners\UserListener', 'onAfterLogin']);
        \Yii::$app->eventManager->attachEvent(UserEvents::SUCCESS_LOGIN, ['app\modules\user\listeners\UserListener', 'onSuccessLogin']);
        \Yii::$app->eventManager->attachEvent(UserEvents::FAILURE_LOGIN, ['app\modules\user\listeners\UserListener', 'onFailureLogin']);

        \Yii::$app->eventManager->attachEvent(UserEvents::BEFORE_LOGOUT, ['app\modules\user\listeners\UserListener', 'onBeforeLogout']);
        \Yii::$app->eventManager->attachEvent(UserEvents::AFTER_LOGOUT, ['app\modules\user\listeners\UserListener', 'onAfterLogout']);

        \Yii::$app->eventManager->attachEvent(UserEvents::SUCCESS_ACTIVATE_ACCOUNT, ['app\modules\user\listeners\UserListener', 'onSuccessActivateAccount']);
        \Yii::$app->eventManager->attachEvent(UserEvents::FAILURE_ACTIVATE_ACCOUNT, ['app\modules\user\listeners\UserListener', 'onFailureActivateAccount']);

        \Yii::$app->eventManager->attachEvent(UserEvents::SUCCESS_EMAIL_CONFIRM, ['app\modules\user\listeners\UserListener', 'onSuccessEmailConfirm']);
        \Yii::$app->eventManager->attachEvent(UserEvents::FAILURE_EMAIL_CONFIRM, ['app\modules\user\listeners\UserListener', 'onFailureEmailConfirm']);

        \Yii::$app->eventManager->attachEvent(UserEvents::BEFORE_PASSWORD_RECOVERY, ['app\modules\user\listeners\UserListener', 'onBeforePasswordRecovery']);
        \Yii::$app->eventManager->attachEvent(UserEvents::SUCCESS_PASSWORD_RECOVERY, ['app\modules\user\listeners\UserListener', 'onSuccessPasswordRecovery']);
        \Yii::$app->eventManager->attachEvent(UserEvents::FAILURE_PASSWORD_RECOVERY, ['app\modules\user\listeners\UserListener', 'onFailurePasswordRecovery']);


        \Yii::$app->eventManager->attachEvent(UserEvents::BEFORE_PASSWORD_RESET, ['app\modules\user\listeners\UserListener', 'onBeforePasswordRecoveryReset']);
        \Yii::$app->eventManager->attachEvent(UserEvents::SUCCESS_PASSWORD_RESET, ['app\modules\user\listeners\UserListener', 'onSuccessPasswordRecoveryReset']);
        \Yii::$app->eventManager->attachEvent(UserEvents::FAILURE_PASSWORD_RESET, ['app\modules\user\listeners\UserListener', 'onFailurePasswordRecoveryReset']);

        \Yii::$app->eventManager->attachEvent(UserEvents::SUCCESS_REGISTRATION, ['app\modules\user\listeners\UserListener', 'onSuccessRegistration']);
        \Yii::$app->eventManager->attachEvent(UserEvents::FAILURE_REGISTRATION, ['app\modules\user\listeners\UserListener', 'onFailureRegistration']);
    }
}
