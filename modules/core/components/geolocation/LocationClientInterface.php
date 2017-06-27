<?php

namespace app\modules\core\components\geolocation;

/**
 * Interface LocationServiceInterface
 * @package app\modules\core\components\geolocation
 */
interface LocationClientInterface
{
    /**
     * Invoked by @see GeoLocation::process() method. Place there should implemented most logic.
     *
     * @param $ip
     * @return mixed
     */
    public function getResult($ip);

    /**
     * @return string
     */
    public function getCityName();

    /**
     * @return string
     */
    public function getRegionName();

    /**
     * @return string
     */
    public function getCountryName();

    /**
     * @return string
     */
    public function getCountryISO();

    /**
     * @return string
     */
    public function getTimezone();
}