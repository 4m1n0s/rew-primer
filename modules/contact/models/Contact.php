<?php

namespace app\modules\contact\models;

use app\helpers\DateHelper;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property integer $id
 * @property integer $status
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property string $create_date
 * @property string $update_date
 */
class Contact extends \yii\db\ActiveRecord
{
    const SCENARIO_STATUS = 'scenario_status';
    const SCENARIO_MAIN = 'scenario_main';

    const STATUS_NEW = 1;
    const STATUS_READ = 2;
    const STATUS_ANSWERED = 3;

    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'create_date',
                'updatedAtAttribute' => 'update_date',
                'value' => DateHelper::getCurrentDateTime()
            ]
        ];
    }

    /**
     * Returns a list of scenarios and the corresponding active attributes.
     *
     * @return array
     */
    public function scenarios()
    {
        return [
            static::SCENARIO_STATUS => ['status'],
            static::SCENARIO_MAIN => ['name', 'email', 'subject', 'message', 'reCaptcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'in', 'range' => [static::STATUS_NEW, static::STATUS_READ, static::STATUS_ANSWERED]],
            [['name', 'subject'], 'match', 'pattern' => '/^[-a-zA-Z0-9_\.,!?]+$/'],
            [['name', 'email', 'subject', 'message'], 'required'],
            [['email'], 'email'],
            [['message'], 'string'],
            [['create_date', 'update_date'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['email'], 'string', 'max' => 100],
            [['subject'], 'string', 'max' => 255],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => Yii::$app->params['reCaptchaSecretKey'], 'uncheckedMessage' => 'Please confirm that you are not a bot.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'name' => 'Name',
            'email' => 'Email',
            'subject' => 'Your Subject',
            'message' => 'Message',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\modules\contact\models\queries\ContactQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\contact\models\queries\ContactQuery(get_called_class());
    }

    /**
     * Get status list
     * @return array
     */
    public static function getStatusList() {
        return [
            static::STATUS_NEW => Yii::t('app', 'New'),
            static::STATUS_READ => Yii::t('app', 'Read'),
            static::STATUS_ANSWERED => Yii::t('app', 'Answered'),
        ];
    }

    /**
     * Get status
     * @param boolean $html
     * @return string
     */
    public function getStatus($html = false) {
        $statusList = $this->getStatusList();

        switch ($this->status) {
            case static::STATUS_NEW :
                $label = 'info';
                $status = $statusList[static::STATUS_NEW];
                break;
            case static::STATUS_READ:
                $label = 'success';
                $status = $statusList[static::STATUS_READ];
                break;
            case static::STATUS_ANSWERED:
                $label = 'default';
                $status = $statusList[static::STATUS_ANSWERED];
                break;
            default:
                $label = 'danger';
                $status = 'unknown';
        }

        if ($html) {
            return "<span class=\"label label-sm label-$label\">$status</span>";
        }

        return $status;
    }

    /**
     * Set status
     * @param $status
     * @return bool
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this->save();
    }
}
