<?php

namespace app\modules\offer\models;

use Yii;
use yii\base\InvalidConfigException;

/**
 * This is the model class for table "{{%offer_device_os}}".
 *
 * @property integer $offer_id
 * @property integer $os
 *
 * @property Offer $offer
 */
class OfferDeviceOs extends \yii\db\ActiveRecord
{

    const OS_OTHER = 1;
    const OS_IOS = 2;
    const OS_ANDROID = 3;
    const OS_WINDOWS = 4;
    const OS_BLACKBERRY = 5;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%offer_device_os}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offer_id', 'os'], 'required'],
            [['offer_id', 'os'], 'integer'],
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
            'os' => 'Os',
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
    public static function getOSList()
    {
        return [
            static::OS_OTHER => 'Other',
            static::OS_IOS => 'IOS',
            static::OS_ANDROID => 'Android',
            static::OS_WINDOWS => 'Windows',
            static::OS_BLACKBERRY => 'BlackBerry',
        ];
    }

    public static function getOSName($osID)
    {
        $list = static::getOSList();
        if (!in_array($osID, $list)) {
            throw new InvalidConfigException('Invalid targeting OS ID (' . $osID . ')');
        }

        return $list[$osID];
    }
}
