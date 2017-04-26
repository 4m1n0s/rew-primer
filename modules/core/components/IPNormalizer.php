<?php

namespace app\modules\core\components;

/**
 * Class IPNormalizer
 * @package app\modules\core\components
 */
class IPNormalizer
{
    /**
     * @var bool
     */
    public $filterProxy = true;

    /**
     * @var string
     */
    protected $ip;

    /**
     * IPNormalizer constructor.
     * @param null $ip
     */
    public function __construct($ip = null)
    {
        $this->setIP($ip);
    }

    /**
     * @return string
     */
    public function process()
    {
        if (empty($this->ip)) {
            return false;
        }

        if ($this->filterProxy) {
            static::doFilterProxy();
        }

        return $this->ip;
    }

    /**
     * @return string
     */
    protected function doFilterProxy()
    {
        return $this->ip = array_shift(explode(',', $this->ip));
    }

    /**
     * IP Setter
     * @param $ip
     */
    public function setIP($ip)
    {
        $this->ip = $ip;
    }

    /**
     * IP Getter
     * @return mixed
     */
    public function getIP()
    {
        return $this->ip;
    }
}