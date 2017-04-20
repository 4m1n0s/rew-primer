<?php

namespace app\modules\profile\forms;

use Yii;
use yii\base\Model;
use app\modules\user\models\User;
use app\modules\user\helpers\Password;

/**
 * LoginForm is the model behind the login form.
 */
class ProfileForm extends Model {

    const SCENARIO_CHANGE_PERSONAL_INFO = 'scenario_change_personal_info';
    const SCENARIO_CHANGE_PASSWORD = 'scenario_change_password';
    const SCENARIO_CHANGE_LOGIN = 'scenario_change_login';

    public $username;
    public $email;

    public $first_name;
    public $last_name;
    public $birthday;
    public $gender;

    public $currentPassword;
    public $newPassword;
    public $confirmPassword;
    
    /** @inheritdoc */
    public function scenarios() {
        return [
            static::SCENARIO_CHANGE_PERSONAL_INFO => ['first_name', 'last_name', 'birthday', 'gender'],
            static::SCENARIO_CHANGE_PASSWORD => ['currentPassword', 'newPassword', 'confirmPassword'],
            static::SCENARIO_CHANGE_LOGIN => ['username', 'email'],
        ];
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['first_name', 'last_name', 'gender'], 'required'],
            [['first_name', 'last_name'], 'trim'],

            // Email
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'when' => function ($model) {
                return $model->email != Yii::$app->user->identity->email;
            }],

            // Username
            ['username', 'required'],
            ['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_\.@]+$/'],
            ['username', 'string', 'min' => 3, 'max' => 60],
            ['username', 'unique', 'targetClass' => User::className(), 'when' => function ($model) {
                return $model->username != Yii::$app->user->identity->username;
            }],
            ['username', 'trim'],

            // Password
            ['newPassword', 'required'],
            ['newPassword', 'string', 'min' => 6, 'max' => 64],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword'],
            [['currentPassword'], 'validateCurrentPassword'],
            [['newPassword'], 'validateNewPassword'],

            // Birthday
            ['birthday', 'date', 'format' => 'php:Y-m-d', 'message' => 'Invalid date format']
        ];
    }

    public function attributeLabels() {
        return[
            'username'          => Yii::t('app', 'Username'),
            'first_name'         => Yii::t('app', 'First name'),
            'last_name'          => Yii::t('app', 'Last name'),
            'currentPassword'   => Yii::t('app', 'Current Password'),
            'newPassword'       => Yii::t('app', 'New Password'),
            'confirmPassword'   => Yii::t('app', 'Confirm Password'),
            
        ];
    }
    
    public function validateCurrentPassword($attribute, $params){
        if (!$this->hasErrors()) {
            if(!Password::validate($this->$attribute, Yii::$app->user->identity->password)){
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }
    
    public function validateNewPassword($attribute, $params){
        if (!$this->hasErrors()) {
            if(empty($this->currentPassword)){
                $this->addError('currentPassword', "Current Password cannot be blank.");
            }
        }
    }
}
