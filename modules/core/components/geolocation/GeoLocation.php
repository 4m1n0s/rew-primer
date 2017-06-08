<?php

namespace app\modules\core\components\geolocation;

use yii\base\Object;

/**
 * GeoLocation contains geo info from an IP address.
 * You can configure it as an application component in [[\yii\base\Application]]
 * Example:
 *
 * 'components' => [
 *     // ...
 *     'geoLocation' => [
 *         'class' => '\app\modules\core\components\geolocation\GeoLocation',
 *         'clientClassName' => '\app\modules\core\components\geolocation\clients\IPInfo'
 *      ],
 * ]
 *
 * Base usage example:
 *
 * $client = \Yii::$app->geoLocation->process($ip);
 * $client->getCountry();
 *
 * @package app\modules\core\components
 */
class GeoLocation extends Object
{
    /**
     * @var LocationClientInterface
     */
    protected $client;

    /**
     * @string
     */
    public $clientClassName;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $client = \Yii::createObject($this->clientClassName);
        $this->setClient($client);
    }

    /**
     * @param $ip
     * @return LocationClientInterface
     */
    public function process($ip)
    {
        $this->client->getResult($ip);
        return $this->getClient();
    }

    /**
     * @param LocationClientInterface $client
     */
    public function setClient(LocationClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return LocationClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }
}