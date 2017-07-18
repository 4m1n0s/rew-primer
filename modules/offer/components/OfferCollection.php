<?php

namespace app\modules\offer\components;

use app\modules\offer\models\Offer;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\Inflector;

class OfferCollection implements \IteratorAggregate, \ArrayAccess, \Countable
{
    /**
     * @var Offer[] offers in this collection
     */
    private $offers = [];

    public function __construct(array $offers = [])
    {
        foreach ($offers as $offer) {
            if (!Instance::ensure($offer, Offer::class)) {
                throw new \InvalidArgumentException('All items should be of Offer model.');
            }
        }
        $this->offers = $offers;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->offers);
    }

    public function offsetGet($offset)
    {
        return isset($this->offers[$offset]) ? $this->offers[$offset] : null;
    }

    public function offsetUnset($offset)
    {
        unset($this->offers[$offset]);
    }

    public function offsetExists($offset)
    {
        return isset($this->offers[$offset]);
    }

    public function offsetSet($offset, $value)
    {
        if (!Instance::ensure($value, Offer::class)) {
            throw new InvalidConfigException(__METHOD__ . ' method must accept ' . Offer::class . ' object only');
        }

        $offset = $offset ?: ($this->offers ? max(array_keys($this->offers)) + 1 : 0);
        $this->offers[$offset] = $value;
    }

    public function count()
    {
        return count($this->offers);
    }

    public function getOfferById()
    {
        
    }
}