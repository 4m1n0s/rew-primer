<?php

namespace app\modules\user\listeners;

use app\components\MandrillMailer;
use app\models\EmailTemplate;
use app\modules\invitation\models\search\Invitation;
use app\modules\user\models\User;
use Yii;
use yii\helpers\Html;
use \yii\helpers\Url;
use app\modules\user\events\UserRegistrationEvent;

/**
 * Class UserListener
 *
 * @author Stableflow
 */
class UserListener {

    /**
     * After logout event handler
     * @param \app\modules\user\events\UserLogoutEvent $event Description
     */
    public static function onAfterLogout(\app\modules\user\events\UserLogoutEvent $event) {
        
    }

    /**
     * Before logout event handler
     * @param \app\modules\user\events\UserLogoutEvent $event Description
     */
    public static function onBeforeLogout(\app\modules\user\events\UserLogoutEvent $event) {
        
    }

    /**
     * Before login event handler
     * @param \app\modules\user\events\UserLoginEvent $event Description
     */
    public static function onBeforeLogin(\app\modules\user\events\UserLoginEvent $event) {
        
    }

    /**
     * Success login event handler
     * @param \app\modules\user\events\UserLoginEvent $event Description
     */
    public static function onSuccessLogin(\app\modules\user\events\UserLoginEvent $event) {
        
    }
    
    public static function onSuccessAutoLogin(\yii\web\UserEvent $event) {
        
    }

    /**
     * Failure login event handler
     * @param \app\modules\user\events\UserLoginEvent $event Description
     */
    public static function onFailureLogin(\app\modules\user\events\UserLoginEvent $event) {
        
    }

    public static function onBeforePasswordRecovery(\app\modules\user\events\UserPasswordRecoveryEvent $event) {
        
    }

    public static function onSuccessPasswordRecovery(\app\modules\user\events\UserPasswordRecoveryEvent $event) {
        
    }

    public static function onFailurePasswordRecovery(\app\modules\user\events\UserLogoutEvent $event) {
        
    }

    public static function onBeforePasswordRecoveryReset(\app\modules\user\events\UserPasswordRecoveryResetEvent $event) {
        
    }

    public static function onSuccessPasswordRecoveryReset(\app\modules\user\events\UserPasswordRecoveryResetEvent $event) {

    }

    public static function onFailurePasswordRecoveryReset(\app\modules\user\events\UserPasswordRecoveryResetEvent $event) {
        
    }

    /**
     * Success registration event handler
     *
     * @param UserRegistrationEvent $event
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public static function onSuccessRegistration(UserRegistrationEvent $event) {
        $user = $event->getUser();
        $token = $event->getToken();
        $mandrillMailer = \Yii::$app->get('mandrillMailer');
        /* @var MandrillMailer $mandrillMailer */

        if ($user->status !== User::STATUS_PENDING) {
            return false;
        }

        $mandrillMailer->addToQueue(
            $user->email,
            EmailTemplate::TEMPLATE_SIGN_UP_CONFIRMATION, [
            'username' => $user->username,
            'confirmation_link' => Html::a('Confirmation link', Url::toRoute(['/user/account/activate', 'token' => $token->code], true), [
                'target' => '_blank',
                'style' => 'word-wrap: break-word;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2A9AE7;font-weight: bold;text-decoration: none;',
            ]),
        ]);
    }

    /**
     * Failure registration event handler
     * @param \app\modules\user\events\UserRegistrationEvent $event Description
     */
    public static function onFailureRegistration(\app\modules\user\events\UserRegistrationEvent $event) {
        
    }

    /**
     * Success activate event handler
     * @param \app\modules\user\events\UserRegistrationEvent $event Description
     */
    public static function onSuccessActivateAccount(\app\modules\user\events\UserActivateEvent $event) {
        $token = $event->getToken();
        $user = $event->getUser();

        if ($inv = Invitation::find()->email($user->email)->status(Invitation::STATUS_APPROVED)->one()) {
            $inv->delete();
        }

//        $token->delete();
    }

    /**
     * Failure activate event handler
     * @param \app\modules\user\events\UserRegistrationEvent $event Description
     */
    public static function onFailureActivateAccount(\app\modules\user\events\UserActivateEvent $event) {
        
    }
    
}
