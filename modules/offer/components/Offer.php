<?php

namespace app\modules\offer\components;

use app\modules\core\models\GeoCountry;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class Offer
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
     * @var
     */
    public $id;

    /**
     * @var array
     */
    public $targetingCountryList = [];

    /**
     * Offer constructor.
     * @param $offerID
     */
    public function __construct($offerID)
    {
        $this->id = $offerID;
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
        if (!static::isExist($offerID)) {
            throw new InvalidConfigException('Unexpected offer ID: ' . $offerID);
        }

        return static::STORAGE_KEY_COUNTRY_PREFIX . $offerID;
    }

    /**
     * @param $offerID
     * @return array
     * @throws InvalidConfigException
     */
    public static function getSelectedTargetingCountryList($offerID)
    {
        if (!static::isExist($offerID)) {
            throw new InvalidConfigException('Unexpected offer ID: ' . $offerID);
        }

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

    /**
     * @param $offerID
     * @return bool
     */
    public static function isExist($offerID)
    {
        // TODO: Not implemented;

        return true;
    }
}
