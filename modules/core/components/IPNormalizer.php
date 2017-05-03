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
     * IP Getter
     * @return mixed
     */
    public function getIP()
    {
        if ($this->filterProxy) {
            static::doFilterProxy();
        }

        return $this->ip;
    }
}