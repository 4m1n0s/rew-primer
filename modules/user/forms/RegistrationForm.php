<?php

namespace app\modules\user\forms;

use Yii;
use yii\base\Model;
use app\modules\user\models\User;
use app\modules\user\helpers\Password;
use app\modules\invitation\models\Invitation;

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
    protected $referralUser;

    public function scenarios() {
        return [
            'signup' => ['username', 'email', 'password', 'confirmPassword', 'invitationCode', 'referralCode'],
            'inviteOnly' => ['invitationCode'],
            'invitationRequest' => ['email']
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
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
            ['email', 'trim'],
            // password rules
            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 60],
            // confirm password rules
            ['confirmPassword', 'required'],
            ['confirmPassword', 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],
            //invite code rules
            ['invitationCode', 'required', 'when' => function($model) {
            if ((null !== $data = \app\modules\setting\helpers\SettingHelper::getOption('app-signup')) && isset($data['invite_only']) && (bool) $data['invite_only'] === true) {
                return true;
            }
            return false;
        }],
            ['invitationCode', 'validateInvitationCode'],
            //referral code rules
            ['referralCode', 'validateReferralCode', 'skipOnEmpty' => true],
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
            $this->addError($attribute, Yii::t('app', 'Incorect referral code'));
        }
    }

    /**
     * Invite code validation
     */
    public function validateInvitationCode($attribute, $params) {
        if (!$this->hasErrors('email')) {
            if (!empty($this->email)) {
                if (false === Invitation::checkInvite($this->email, $this->{$attribute})) {
                    $this->addError($attribute, Yii::t('app', 'Incorrect invitation code'));
                }
            } else {
                if (false === Invitation::find()->where('code = :code', [':code' => $this->{$attribute}])->exists()) {
                    $this->addError($attribute, Yii::t('app', 'Incorrect invitation code'));
                }
            }
        }
    }

}
