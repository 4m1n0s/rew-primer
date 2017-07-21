<?php

namespace app\modules\offer\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%offer_device_type}}".
 *
 * @property integer $offer_id
 * @property integer $type
 *
 * @property Offer $offer
 */
class OfferDeviceType extends \yii\db\ActiveRecord
{

    const DEVICE_TYPE_DESKTOP = 1;
    const DEVICE_TYPE_MOBILE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%offer_device_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offer_id', 'type'], 'required'],
            [['offer_id', 'type'], 'integer'],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['offer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'offer_id' => 'Offer ID',
            'type' => 'Type',
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
     * @return array
     */
    public static function getDeviceTypeList()
    {
        return [
            static::DEVICE_TYPE_DESKTOP => 'Desktop',
            static::DEVICE_TYPE_MOBILE => 'Mobile',
        ];
    }

}
