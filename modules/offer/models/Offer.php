<?php

namespace app\modules\offer\models;

use app\modules\core\models\GeoCountry;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%offer}}".
 *
 * @property integer $id
 * @property integer $active
 * @property string $name
 * @property string $img
 */
class Offer extends \yii\db\ActiveRecord
{
    const ADWORKMEDIA       = 10;
    const KIWIWALL          = 11;
    const OFFERTORO         = 12;
    const OFFERDADDY        = 13;
    const CLIXWALL          = 14;
    const PTCWALL           = 15;
    const SUPERREWARDS      = 16;
    const MINUTESTAFF       = 17;
    const CPALEAD           = 18;
    const PERSONA           = 19;
    const FYBER             = 20;
    const POLLFISH          = 21;
    const PAYMENTWALL       = 22;
    
    const STORAGE_KEY_COUNTRY_PREFIX = 'offer.targeting.country.';

    /**
     * @var array
     */
    public $targetingCountryList = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%offer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'img'], 'required'],
            [['id', 'active'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'active' => Yii::t('app', 'Active'),
            'name' => Yii::t('app', 'Name'),
            'img' => Yii::t('app', 'Img'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\queries\OfferQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\offer\models\queries\OfferQuery(get_called_class());
    }

    /**
     * @throws InvalidConfigException
     */
    public function initTargeting()
    {
        $decoded = Json::decode(\Yii::$app->keyStorage->get(static::getStorageKeyTargetingCountry($this->id)));
        $this->targetingCountryList = $decoded ? $decoded : [];
    }

    /**
     * @param $offerID
     * @return string
     * @throws InvalidConfigException
     */
    public static function getStorageKeyTargetingCountry($offerID)
    {
        return static::STORAGE_KEY_COUNTRY_PREFIX . $offerID;
    }

    /**
     * @param $offerID
     * @return array
     * @throws InvalidConfigException
     */
    public static function getSelectedTargetingCountryList($offerID)
    {
        $value = \Yii::$app->keyStorage->get(static::STORAGE_KEY_COUNTRY_PREFIX . $offerID);

        if (empty($value)) {
            return [];
        }

        $formattedValue = Json::decode($value);     // TODO: Format

        return $arr = ArrayHelper::map(
            GeoCountry::find()->where(['in', 'id', $formattedValue])->asArray()->all(),
            'id',
            'country_name'
        );
    }
}
