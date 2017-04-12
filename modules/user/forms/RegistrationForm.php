<?php

namespace app\modules\user\forms;

use Yii;
use yii\base\Model;
use app\modules\user\models\User;
use app\modules\user\helpers\Password;
use app\modules\invitation\models\Invitation;
use yii\helpers\ArrayHelper;

/**
 * RegisterForm is the model behind the register form.
 */
class RegistrationForm extends Model {

    const SIGNUP_SCENARIO = 'signup';
    const INVITATION_SCENARIO = 'inviteOnly';
    const INVITATION_REQUEST_SCENARIO = 'invitationRequest';

    public $username;
    public $email;
    public $password;
    public $confirmPassword;
    public $invitationCode;
    public $referralCode;

    public $first_name;
    public $last_name;
    public $birthday;
    public $gender;
    public $reCaptcha;

    protected $referralUser;

    public function scenarios() {
        return [
            static::SIGNUP_SCENARIO => ['username', 'gender', 'birthday', 'email', 'password', 'confirmPassword', 'first_name', 'last_name', 'reCaptcha'],
            static::INVITATION_SCENARIO => ['username', 'gender', 'birthday', 'email', 'password', 'confirmPassword', 'invitationCode', 'first_name', 'last_name', 'reCaptcha'],
            static::INVITATION_REQUEST_SCENARIO => ['email']
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [

            [['gender', 'first_name', 'last_name'], 'required'],

            // username rules
            ['username', 'required'],
            ['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_\.@]+$/'],
            ['username', 'string', 'min' => 3, 'max' => 60],
            ['username', 'unique', 'targetClass' => User::className()],
            ['username', 'trim'],
            // email rules
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => User::className()],
            ['email', 'unique', 'targetClass' => Invitation::className(), 'on' => self::INVITATION_REQUEST_SCENARIO],
            ['email', 'trim'],
            // password rules
            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 60],
            // confirm password rules
            ['confirmPassword', 'required'],
            ['confirmPassword', 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],
            //invite code rules
//            ['invitationCode', 'required', 'when' => function($model) {
//                if ((null !== $data = \app\modules\setting\helpers\SettingHelper::getOption('app-signup')) && isset($data['invite_only']) && (bool) $data['invite_only'] === true) {
//                    return true;
//                }
//                return false;
//            }],
            ['invitationCode', 'required'],
            ['email', 'validateInvitationCode', 'on' => self::INVITATION_SCENARIO],
            //referral code rules
            ['referralCode', 'validateReferralCode', 'skipOnEmpty' => true],
            // captcha
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => Yii::$app->params['reCaptchaSecretKey'], 'uncheckedMessage' => 'Please confirm that you are not a bot.']
        ];
    }

    public function attributeLabels() {
        return [
            'username' => Yii::t('user', 'Username'),
            'email' => Yii::t('user', 'Email'),
            'password' => Yii::t('user', 'Password'),
            'confirmPassword' => Yii::t('user', 'Confirm Password'),
            'invitationCode' => Yii::t('user', 'Invitation Code'),
            'referralCode' => Yii::t('user', 'Referral Code'),
        ];
    }

    /**
     * Referral code validation
     */
    public function validateReferralCode($attribute, $params) {
        if (null === $this->referralUser = User::getUserByReferralCode($this->{$attribute})) {
            $this->addError($attribute, Yii::t('app', 'Incorrect referral code'));
        }
    }

    /**
     * Invite code validation
     */
    public function validateInvitationCode($attribute, $params) {
        if (false === Invitation::checkInvite($this->{$attribute}, $this->invitationCode)) {
            $this->addError($attribute, Yii::t('app', 'Incorrect email for specified code'));
        }
    }

    public function getGender () {
        return User::getGender();
    }

}
