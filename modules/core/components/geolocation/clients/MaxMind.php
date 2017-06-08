<?php

namespace app\modules\core\components\geolocation\clients;

use app\modules\core\components\geolocation\LocationClientInterface;
use MaxMind\Db\Reader;
use yii\helpers\ArrayHelper;

/**
 * Class MaxMind
 * @package app\modules\core\components\geolocation\clients
 */
class MaxMind implements LocationClientInterface
{
    /**
     * @var \stdClass
     */
    protected $data;

    /**
     * @param $ip
     * @return $this|bool
     */
    public function getResult($ip)
    {
        $databaseFile = \Yii::getAlias('@app') . '/modules/core/components/geolocation/source-maxmind/GeoLite2-City.mmdb';
        $reader = new Reader($databaseFile);
        $this->data = $reader->get($ip);
    }

    /**
     * @return string
     */
    public function getCountryName()
    {
        return ArrayHelper::getValue($this->data, 'country.names.en');
    }

    /**
     * @return string
     */
    public function getCityName()
    {
        return ArrayHelper::getValue($this->data, 'city.names.en');
    }

    /**
     * @return string
     */
    public function getRegionName()
    {
        return ArrayHelper::getValue($this->data, 'subdivisions.0.names.en');
    }

    /**
     * @return string
     */
    public function getCountryISO()
    {
        return ArrayHelper::getValue($this->data, 'country.iso_code');
    }
}
