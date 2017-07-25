<?php

namespace app\modules\core\models;

use Yii;
use app\modules\core\models\queries\EmailQueueQuery;

/**
 * This is the model class for table "{{%email_queue}}".
 *
 * @property integer $id
 * @property integer $template_id
 * @property string $sender
 * @property string $recipient
 * @property string $create_date
 * @property string $send_date
 * @property integer $status
 * @property string $params
 *
 * @property EmailTemplate $template
 */
class EmailQueue extends \yii\db\ActiveRecord
{
    const STATUS_PROCESSING = 0;
    const STATUS_SENT       = 1;
    const STATUS_REJECTED   = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%email_queue}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_id', 'status'], 'integer'],
            [['sender', 'recipient', 'create_date'], 'required'],
            [['create_date', 'send_date'], 'safe'],
            [['params'], 'string'],
            [['sender', 'recipient'], 'string', 'max' => 150],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmailTemplate::className(), 'targetAttribute' => ['template_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'template_id' => 'Template ID',
            'sender' => 'Sender',
            'recipient' => 'Recipient',
            'create_date' => 'Create Date',
            'send_date' => 'Send Date',
            'status' => 'Status',
            'params' => 'Params',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(EmailTemplate::className(), ['id' => 'template_id']);
    }

    /**
     * @inheritdoc
     * @return EmailQueueQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmailQueueQuery(get_called_class());
    }
}
