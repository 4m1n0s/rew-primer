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
     * @var bool
     */
    public $expand = true;

    /**
     * @var string
     */
    protected $ip;

    /**
     * IPNormalizer constructor.
     */
    public function __construct()
    {
        $this->ip = \Yii::$app->request->getUserIP();
    }
    
    /**
     * @return null|string
     */
    protected function doFilterProxy()
    {
        $keyList = [    // List where ip could be found. Note that order matters.
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];

        foreach ($keyList as $key) {
            if (false === array_key_exists($key, $_SERVER)) {
                continue;
            }

            foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
                if (false !== filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $this->ip = $ip;
                }
            }
        }

        return $this->ip = null;
    }

    /**
     * Expand IPv6 address
     *
     * @return bool|string
     */
    public function doExpand()
    {
        if (!filter_var($this->ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return false;
        }
        $hex = unpack("H*hex", inet_pton($this->ip));
        return $this->ip = substr(preg_replace("/([A-f0-9]{4})/", "$1:", $hex['hex']), 0, -1);
    }

    /**
     * IP Getter
     * @return mixed
     */
    public function getIP()
    {
        if ($this->filterProxy) {
            static::doFilterProxy();
        }
        if ($this->expand) {
            static::doExpand();
        }

        return $this->ip;
    }
}