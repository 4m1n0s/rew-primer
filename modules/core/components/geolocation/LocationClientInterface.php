<?php

namespace app\modules\core\components\geolocation;

/**
 * Interface LocationServiceInterface
 * @package app\modules\core\components\geolocation
 */
interface LocationClientInterface
{
    public function getResult($ip);
    public function getCity();
    public function getRegion();
    public function getCountry();
}