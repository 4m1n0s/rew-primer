<?php

namespace app\modules\user\forms;

use app\modules\user\models\Token;
use app\modules\user\models\UserMeta;
use Yii;
use app\modules\user\models\User;
use yii\base\Security;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sf_users".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property integer $role
 * @property string $password
 * @property string $referral_code
 * @property string $create_date
 * @property integer $status
 * @property string $update_date
 * @property string $first_name
 * @property string $last_name
 * @property string $confirmPassword
 * @property string $newPassword
 *
 * @property Token[] $tokens
 * @property UserMeta[] $userMetas
 */
class BackUsersForm extends User
{
    const SIGNUP_SCENARIO = 'signup';
    const SIGNUP_AFFILIATE_SCENARIO = 'signup_affiliate';
    const EDIT_SCENARIO = 'edit';
    const EDIT_AFFILIATE_SCENARIO = 'edit_affiliate';

    public $confirmPassword;

    public $referral_percents;
    public $referral_register_value;

    public function scenarios()
    {
        return [
            self::SIGNUP_SCENARIO => ['username', 'email', 'role', 'status', 'last_name', 'first_name', 'password', 'confirmPassword'],
            self::EDIT_SCENARIO => ['username', 'email', 'role', 'status', 'last_name', 'first_name'],
            self::SIGNUP_AFFILIATE_SCENARIO => ['username', 'email', 'status', 'referral_code', 'referral_percents',
                'referral_register_value', 'password', 'confirmPassword'],
            self::EDIT_AFFILIATE_SCENARIO => ['username', 'email', 'status', 'referral_code', 'referral_percents',
                'referral_register_value'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_date','update_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_date',
                ],
                'value' => function ($event) {
                    return gmdate('Y-m-d H:i:s', time());
                },
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'status'], 'required'],
            [['role', 'status'], 'integer'],

            [['create_date', 'update_date'], 'safe'],

            ['username', 'required'],
            ['username', 'unique'],
            ['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_\.@]+$/'],
            ['username', 'string', 'min' => 3, 'max' => 60],
            ['username', 'trim'],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            ['email', 'unique'],
            ['email', 'trim'],

            /*[['password'], 'string', 'max' => 64, 'min' => 3],
            [['newPassword'], 'validateNewPassword'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword'],*/

            [['password', 'newPassword', 'confirmPassword'], 'required'],
            [['password', 'newPassword', 'confirmPassword'], 'string', 'min' => 6, 'max' => 64],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],

            [['referral_code'], 'string', 'max' => 12],
            [['referral_code'], 'unique'],
            [['referral_code'], 'required', 'on' => [self::SIGNUP_AFFILIATE_SCENARIO, self::EDIT_AFFILIATE_SCENARIO]],

            [['first_name', 'last_name'], 'string', 'max' => 255],

            [['referral_register_value', 'referral_percents'], 'required'],
            [['referral_register_value', 'referral_percents'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'role' => 'Role',
            'password' => 'Password',
            'referral_code' => 'Referral Code',
            'create_date' => 'Create Date',
            'status' => 'Status',
            'update_date' => 'Update Date',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'virtual_currency' => 'Balance',
            'referral_percents' => Yii::t('app', 'Referral Percents'),
            'referral_register_value' => Yii::t('app', 'Referral Sign up Payout'),
        ];
    }

    /**
     * Update user meta
     */
    public function updateMetaData()
    {
        if ($this->getScenario() == self::SIGNUP_AFFILIATE_SCENARIO || $this->getScenario() == self::EDIT_AFFILIATE_SCENARIO) {
            UserMeta::updateUserMeta($this->id, 'referral_percents', $this->referral_percents);
            UserMeta::updateUserMeta($this->id, 'referral_register_value', $this->referral_register_value);
            return true;
        }
    }
}
