<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%email_template}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 *
 * @property EmailQueue[] $emailQueues
 */
class EmailTemplate extends \yii\db\ActiveRecord
{
    const TEMPLATE_INVITATION_REQUEST_RECEIVED = 1;
    const TEMPLATE_INVITATION_REQUEST_APPROVED = 2;

    const TEMPLATE_SIGN_UP_CONFIRMATION = 3;
    const TEMPLATE_SIGN_UP_SUCCESS = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%email_template}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'content' => 'Content',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailQueues()
    {
        return $this->hasMany(EmailQueue::className(), ['template_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\EmailTemplateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\EmailTemplateQuery(get_called_class());
    }
}
