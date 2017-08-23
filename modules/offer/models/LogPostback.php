<?php

namespace app\modules\offer\models;

use Yii;

/**
 * This is the model class for table "{{%log_postback}}".
 *
 * @property integer $id
 * @property integer $level
 * @property string $category
 * @property integer $offer_id
 * @property string $prefix
 * @property string $message
 * @property string $log_vars
 * @property double $log_time
 *
 * @property Offer $offer
 */
class LogPostback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log_postback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'level', 'offer_id'], 'integer'],
            [['prefix', 'message', 'log_vars'], 'string'],
            [['log_time'], 'number'],
            [['category'], 'string', 'max' => 255],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['offer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'level' => Yii::t('app', 'Level'),
            'category' => Yii::t('app', 'Category'),
            'offer_id' => Yii::t('app', 'Offer ID'),
            'prefix' => Yii::t('app', 'Prefix'),
            'message' => Yii::t('app', 'Message'),
            'log_vars' => Yii::t('app', 'Log Vars'),
            'log_time' => Yii::t('app', 'Log Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offer::className(), ['id' => 'offer_id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\queries\LogPostbackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\offer\models\queries\LogPostbackQuery(get_called_class());
    }
}
