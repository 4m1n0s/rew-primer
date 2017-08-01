<?php

namespace app\modules\core\components;
use yii\base\Object;

/**
 * Class IPNormalizer
 * @package app\modules\core\components
 */
class IPNormalizer extends Object
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
     * @var bool
     */
    public $debug;

    /**
     * @var string
     */
    protected $ip;

    /**
     * IPNormalizer constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->debug = YII_DEBUG;
        $this->ip = $this->debug ? \Yii::$app->params['localIP'] : \Yii::$app->request->getUserIP();

        parent::__construct($config);
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
        if ($this->debug) {
            return $this->ip;
        }

        if ($this->filterProxy) {
            static::doFilterProxy();
        }
        if ($this->expand) {
            static::doExpand();
        }

        return $this->ip;
    }
}