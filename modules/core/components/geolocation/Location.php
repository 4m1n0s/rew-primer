<?php

namespace app\modules\core\components\geolocation;

use yii\base\Object;

/**
 * Class Location
 * @package app\modules\core\components
 */
class Location extends Object
{
    /**
     * @var LocationClientInterface
     */
    protected $client;

    /**
     * @string
     */
    public $clientClassName;

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
        return $this->client;
    }

    /**
     * @param $client
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