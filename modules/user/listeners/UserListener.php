<?php

namespace app\modules\user\listeners;

use Yii;
use \yii\helpers\Url;

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
     * @param \app\modules\user\events\UserRegistrationEvent $event Description
     */
    public static function onSuccessRegistration(\app\modules\user\events\UserRegistrationEvent $event) {
        
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
        
    }

    /**
     * Failure activate event handler
     * @param \app\modules\user\events\UserRegistrationEvent $event Description
     */
    public static function onFailureActivateAccount(\app\modules\user\events\UserActivateEvent $event) {
        
    }
    
}
