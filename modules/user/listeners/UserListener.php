<?php

namespace app\modules\user\listeners;

use Yii;
use \yii\helpers\Url;

use \app\helpers\MandrillEmailHelper;
use \app\modules\user\models\User;
use \app\modules\setting\helpers\SettingHelper;
use app\modules\user\models\UserGroups;
use app\modules\user\models\UserGroupRelations;
use app\modules\user\models\UserIpLog;
use app\modules\user\models\UserMeta;

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
        if(strlen($event->identity->auth_key) == 0 && ($userModel = User::findOne($event->identity->id)) !== null){
            $userModel->auth_key = Yii::$app->security->generateRandomString();
            $userModel->save();
        }
    }

    /**
     * Success login event handler
     * @param \app\modules\user\events\UserLoginEvent $event Description
     */
    public static function onSuccessLogin(\app\modules\user\events\UserLoginEvent $event) {
        static::setGeoData(Yii::$app->user->identity);
        static::setCookies(Yii::$app->user->identity);
    }
    
    public static function onSuccessAutoLogin(\yii\web\UserEvent $event) {
        
        static::setGeoData(Yii::$app->user->identity);
        
        if(null === $ipLog = UserIpLog::find()->where(['user_id' => Yii::$app->user->id, 'ip' => Yii::$app->request->getUserIp()])->one()){
            $ipLog = new UserIpLog([
                'user_id'   => Yii::$app->user->id,
                'ip'        => Yii::$app->request->getUserIp()
            ]);
            
            $ipLog->save();
        }
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
        MandrillEmailHelper::init()->sendTemplate([ $event->email ], \Yii::$app->params['emailTemplates']['ForgotReqest'], [
            'link' => \yii\helpers\Html::a('Link', Url::toRoute([
                $event->getUser()->role == User::ROLE_ADMIN ? '/user/account/back-recovery-reset' : '/user/account/recovery-reset', 
                'code' => $event->getToken()->code
                ], true), [
                'target' => '_blank',
                'style' => 'word-wrap: break-word;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2A9AE7;font-weight: bold;text-decoration: none;',
            ]),
            'username' => $event->getUser()->username
        ]);
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
        
        static::setGeoData($event->getUser());
        
        if ($event->getUser()->status === User::STATUS_PENDING) {
            MandrillEmailHelper::init()->sendTemplate([ $event->getUser()->email], \Yii::$app->params['emailTemplates']['Confirmation'], [
                'username'          => $event->getUser()->username,
                'confirmation_link' => \yii\helpers\Html::a('Confirmation link', Url::toRoute(['/user/account/activate', 'token' => $event->getToken()->code], true), [
                    'target' => '_blank',
                    'style' => 'word-wrap: break-word;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2A9AE7;font-weight: bold;text-decoration: none;',
                ]),
            ]);
        } else {
            if(!empty($event->getForm()->referralCode) && ($user = User::getUserByReferralCode($event->getForm()->referralCode)) !== null){
                $settings = SettingHelper::getOption(SettingHelper::APP_SYSTEM_SETTING);
                if(isset($settings['referral_commission']) && (int)$settings['referral_commission'] > 0){
                    MandrillEmailHelper::init()->sendTemplate([ $user->email], \Yii::$app->params['emailTemplates']['NewReferralSignedUp'], [
                        'source_username' => $user->username,
                        'target_username' => $event->getUser()->username,
                        'referral_percents' => $settings['referral_commission']
                    ]);
                }
            }
            
            MandrillEmailHelper::init()->sendTemplate([ $event->getUser()->email], \Yii::$app->params['emailTemplates']['invitationSignupSuccess'], [
                'username' => $event->getUser()->username,
            ]);
            \Yii::$app->user->login($event->getUser());
        }
        
        if(null !== $group = UserGroups::findOne(-1)){
            $relationModel = Yii::createObject([
                    'class' => UserGroupRelations::className(),
                    'group_id' => $group->id,
                    'user_id' => $event->getUser()->id,
                    'description' => 'New user',
            ]);

            $relationModel->link('group', $group);
        }
        
        static::setGeoData($event->getUser());
        static::setCookies($event->getUser());
        
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
        
        $refferal = \app\modules\user\models\Referral::find()->where(['referral_id' => $event->getUser()->id])->one();
        if($refferal !== null && ($user = User::findOne($refferal->user_id)) !== null){
            $settings = SettingHelper::getOption(SettingHelper::APP_SYSTEM_SETTING);
            if(isset($settings['referral_commission']) && (int)$settings['referral_commission'] > 0){
                MandrillEmailHelper::init()->sendTemplate([ $user->email], \Yii::$app->params['emailTemplates']['NewReferralSignedUp'], [
                    'source_username' => $user->username,
                    'target_username' => $event->getUser()->username,
                    'referral_percents' => $settings['referral_commission']
                ]);
            }
        }
        
        MandrillEmailHelper::init()->sendTemplate([ $event->getUser()->email], \Yii::$app->params['emailTemplates']['ConfirmationSuccess'], [
            'username' => $event->getUser()->username,
        ]);
    }

    /**
     * Failure activate event handler
     * @param \app\modules\user\events\UserRegistrationEvent $event Description
     */
    public static function onFailureActivateAccount(\app\modules\user\events\UserActivateEvent $event) {
        
    }
    
    protected static function setGeoData($user) {
        try {
            $geoDetails = Yii::$app->geoip->getLocation();
            if(!isset($user->metaData->ip) || $user->metaData->ip != $geoDetails['ip_address']){
                
                UserMeta::deleteAll([
                    'user_id' => $user->id,
                    'meta_key' => [
                        'geoCity',
                        'geoRegion',
                        'geoState',
                        'geoCountry',
                    ]
                ]);
                
                UserMeta::updateUserMeta($user->id, 'ip', $geoDetails['ip_address']);
                UserMeta::updateUserMeta($user->id, 'geoCity', $geoDetails['city']);
                UserMeta::updateUserMeta($user->id, 'geoRegion', $geoDetails['metro_code']);
                
                if(null !== $state = \app\models\State::find()->where('name = :name', [':name' => $geoDetails['state_name']])->one()){
                    UserMeta::updateUserMeta($user->id, 'geoState', $state->id);
                }
                
                if(null !== $country = \app\models\Country::find()->where('iso = :name OR nicename =:name', [':name' => $geoDetails['country_name']])->one()){
                    UserMeta::updateUserMeta($user->id, 'geoCountry', $country->id);
                }
                
            }
            
        } catch (\Exception $e) {
            echo $e->getMessage();
            die('sss');
        }
        
    }
    
    protected static function setCookies($user) {
        
        if(isset(Yii::$app->params['additionalDomain']) && $user->role !== User::ROLE_MOBILE_USER){
            $expired = strtotime('+ 1 year', time()) - time();
            $cookies = "[".$user->id.",\"".$user->auth_key."\", $expired]";
            
            if(isset(Yii::$app->params['additionalDomain2']) && is_array(Yii::$app->params['additionalDomain2'])){
                $domain = array_shift(Yii::$app->params['additionalDomain2']);
                Yii::$app->controller->redirect('http://'.$domain.'/site/set-cookie?'
                        . 'cookie='.$cookies.'&'
                        . 'domain='.$domain.'&'
                        . 'callback='.\yii\helpers\BaseUrl::base(true))->send();
            } else{
                Yii::$app->controller->redirect('http://'.Yii::$app->params['additionalDomain'].'/site/set-cookie?'
                        . 'cookie='.$cookies.'&'
                        . 'callback='.\yii\helpers\BaseUrl::base(true)
                )->send();
            }
        }
        
    }

}
