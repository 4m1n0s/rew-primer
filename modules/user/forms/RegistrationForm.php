<?php

namespace app\modules\user\forms;

use app\modules\user\helpers\Password;
use app\modules\user\models\Referral;
use Yii;
use yii\base\Model;
use app\modules\user\models\User;
use app\modules\invitation\models\Invitation;

/**
 * RegisterForm is the model behind the register form.
 */
class RegistrationForm extends Model
{
    const SCENARIO_SIGNUP = 'signup';
    const SCENARIO_UPDATE_PERSONAL_INFO = 'scenario_update_personal_info';
    const SCENARIO_UPDATE_PASSWORD = 'scenario_update_password';
    const SCENARIO_UPDATE_LOGIN = 'scenario_update_login';
    const SCENARIO_INVITATION = 'inviteOnly';
    const SCENARIO_INVITATION_REQUEST = 'invitationRequest';
    const SCENARIO_OAUTH = 'oauth';

    public $username;
    public $email;

    public $invitationCode;
    public $referralCode;

    public $password;
    public $confirmPassword;
    public $currentPassword;

    public $first_name;
    public $last_name;
    public $birthday;
    public $gender;

    public $reCaptcha;
    public $terms;

    // Oauth
    public $externalID;
    public $clientID;
    public $tempUserID;

    public $isWidget;

    protected $referralUser;

    public function scenarios()
    {
        return [
            static::SCENARIO_SIGNUP                 => ['username', 'gender', 'birthday', 'email', 'password',
                                                        'confirmPassword', 'first_name', 'last_name', 'referralCode',
                                                        'isWidget', 'terms', 'reCaptcha'],
            static::SCENARIO_UPDATE_PERSONAL_INFO   => ['first_name', 'last_name', 'birthday', 'gender'],
            static::SCENARIO_UPDATE_PASSWORD        => ['password', 'currentPassword', 'confirmPassword'],
            static::SCENARIO_UPDATE_LOGIN           => ['username', 'email'],
            static::SCENARIO_INVITATION             => ['username', 'gender', 'birthday', 'email', 'password',
                                                        'confirmPassword', 'first_name', 'last_name', 'reCaptcha',
                                                        'referralCode', 'invitationCode'],
            static::SCENARIO_INVITATION_REQUEST     => ['email', 'isWidget', 'reCaptcha'],
            static::SCENARIO_OAUTH                  => ['email', 'username', 'reCaptcha'],
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            // Username
            ['username', 'required'],
            ['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_\.@]+$/'],
            ['username', 'string', 'min' => 3, 'max' => 60],
            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => User::className(), 'when' => function ($model) {
                if (!Yii::$app->user->isGuest) {
                    return $model->username != Yii::$app->user->identity->username;
                }
                return true;
            }],

            // Email
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => Invitation::className(), 'on' => static::SCENARIO_INVITATION_REQUEST],
            ['email', 'trim'],
            ['email', 'unique', 'targetClass' => User::class, 'when' => function ($model) {
                if (!Yii::$app->user->isGuest) {
                    return $model->email != Yii::$app->user->identity->email;
                }
                return true;
            }],

            // Password
            [['password', 'newPassword', 'confirmPassword'], 'required'],
            [['password', 'newPassword', 'confirmPassword'], 'string', 'min' => 6, 'max' => 64],
            [['currentPassword'], 'validateCurrentPassword', 'on' => static::SCENARIO_UPDATE_PASSWORD],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],

            // Meta
            [['first_name', 'last_name'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'trim'],
            [['gender'], 'in', 'range' => [User::MALE, User::FEMALE], 'skipOnEmpty' => true],
            ['birthday', 'date', 'format' => 'php:Y-m-d', 'skipOnEmpty' => true],

            // Invite code
            ['invitationCode', 'required'],
            ['email', 'validateInvitationCode', 'on' => self::SCENARIO_INVITATION],

            // Referral code
            ['referralCode', 'validateReferralCode', 'skipOnEmpty' => true],

            // Captcha
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => Yii::$app->params['reCaptchaSecretKey'], 'uncheckedMessage' => 'Please confirm that you are not a bot.'],

            // Terms
            ['terms', 'required', 'requiredValue' => 1, 'message' => 'Terms are required'],
        ];
    }

    public function attributeLabels()
    {
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
    public function validateReferralCode($attribute, $params)
    {
        if (null === $this->referralUser = User::getUserByReferralCode($this->{$attribute})) {
            $this->addError($attribute, Yii::t('app', 'Incorrect referral code'));
        }
    }

    /**
     * Invite code validation
     */
    public function validateInvitationCode($attribute, $params)
    {
        if (false === Invitation::checkInvite($this->{$attribute}, $this->invitationCode)) {
            $this->addError($attribute, Yii::t('app', 'Incorrect email for specified code'));
        }
    }

    public function getGender()
    {
        return User::getGender();
    }

    /**
     * After the referral link App stores referral code in cookie and then could auto put code in form
     *
     * @return mixed
     */
    public function getDefaultReferralCode()
    {
        $cookies = Yii::$app->request->cookies;
        return $this->referralCode = $cookies->getValue(Referral::COOKIES_REQUEST_ID, null);
    }

    public function validateCurrentPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!Password::validate($this->$attribute, Yii::$app->user->identity->password)) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }
}
