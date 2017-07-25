<?php

namespace app\modules\invitation\models;

use app\helpers\DateHelper;
use app\modules\core\models\EmailTemplate;
use app\modules\user\models\User;
use Yii;
use yii\base\Security;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "invitations".
 *
 * @property integer $id
 * @property string $email
 * @property string $code
 * @property integer $status
 * @property string $create_date
 * @property string $update_date
 */
class Invitation extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_APPROVED = 2;
    const STATUS_DENIED = 3;

    const INVITATION_REQUEST_SCENARIO = 'invitation_request_scenario';
    const UPDATE_SCENARIO = 'update_scenario';
    const STATUS_SCENARIO = 'status_scenario';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%invitations}}';
    }

    /**
     * @return array
     */
    public function scenarios() {
        return [
            static::INVITATION_REQUEST_SCENARIO => ['email'],
            static::UPDATE_SCENARIO => ['status', 'code'],
            static::STATUS_SCENARIO => ['status'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'status', 'create_date'], 'required'],
            [['status'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['email'], 'string', 'max' => 100],
            [['email'], 'checkEmailExist', 'on' => self::INVITATION_REQUEST_SCENARIO],
            [['code'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'code' => 'Code',
            'status' => 'Status',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }

    /**
     * Get status list
     * @return array
     */
    public static function getStatusList() {
        return [
            static::STATUS_NEW          => Yii::t('app', 'New'),
            static::STATUS_APPROVED     => Yii::t('app', 'Approved'),
            static::STATUS_DENIED       => Yii::t('app', 'Denclined'),
        ];
    }

    /**
     * Get status
     * @param boolean $html
     * @return string
     */
    public function getStatus($html = false) {
        $data = $this->getStatusList();

        if (isset($data[$this->status])) {
            if (false !== $html) {
                switch ($this->status) {
                    case static::STATUS_APPROVED :
                        $status = 'success';
                        break;
                    case static::STATUS_DENIED:
                        $status = 'danger';
                        break;
                    case static::STATUS_NEW:
                        $status = 'info';
                        break;
                }

                return "<span class=\"label label-sm label-$status\">{$data[$this->status]}</span>";
            }

            return $data[$this->status];
        }

        return 'unknown';
    }

    /**
     * Approve request
     * @return boolean
     */
    public function approve() {
        if ($this->status == static::STATUS_APPROVED) {
            return false;
        }

        $security = new Security();
        $this->scenario = Invitation::STATUS_SCENARIO;
        $this->status = static::STATUS_APPROVED;
        $this->code = $security->generateRandomString(rand(8, 12));
        return $this->save();
    }

    /**
     * Deny request
     * @return boolean
     */
    public function deny() {
        $this->scenario = Invitation::STATUS_SCENARIO;
        $this->status = static::STATUS_DENIED;
        $this->code = null;
        return $this->save();
    }

    /**
     * @inheritdoc
     * @return \app\modules\invitation\models\queries\InvitationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\invitation\models\queries\InvitationsQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {
        if ($insert) {
            $this->create_date = DateHelper::getCurrentDateTime();
        } else {
            $this->update_date = DateHelper::getCurrentDateTime();

            if ($this->status === static::STATUS_APPROVED) {
                $mailContainer = Yii::$app->mailContainer;
                $mailContainer->addToQueue(
                    $this->email,
                    EmailTemplate::TEMPLATE_INVITATION_REQUEST_APPROVED, [
                        'invitation_code'   => $this->code,
                        'sign_up_url'       => Html::a('Sign Up', Url::to(['/user/account/sign-up', 'code' => $this->code], true), [
                            'target' => '_blank',
                            'style' => 'word-wrap: break-word;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2A9AE7;font-weight: bold;text-decoration: none;',
                        ])
                    ]
                );
            }
        }

        return parent::beforeSave($insert);
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function checkEmailExist($attribute, $params) {
        if (!$this->hasErrors()) {
            if (User::find()->where('email = :email', [':email' => $this->{$attribute}])->exists()) {
                $this->addError($attribute, Yii::t('app', 'User has already registered.'));
            }
        }
    }

    /**
     * Check Invite code
     * @param string $email Description
     * @param string $code Description
     * @return boolean
     */
    public static function checkInvite($email, $code) {
        return static::find()->where('email = :email AND code = :code AND status = :status', [
            ':email' => $email,
            ':code' => $code,
            ':status' => static::STATUS_APPROVED
        ])->exists();
    }
}
