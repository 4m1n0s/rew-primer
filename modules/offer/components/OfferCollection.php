<?php

namespace app\modules\offer\components;

use app\modules\offer\models\Offer;
use yii\base\InvalidConfigException;

class OfferCollection implements \IteratorAggregate, \ArrayAccess, \Countable
{
    /**
     * @var Offer[] offers in this collection
     */
    private $offers = [];

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
        if (!$value instanceof Offer) {
            throw new InvalidConfigException(__METHOD__ . ' method must accept ' . Offer::class . ' object only');
        }

        $offset = $offset ?: ($this->offers ? max(array_keys($this->offers)) + 1 : 0);
        $this->offers[$offset] = $value;
    }

    public function count()
    {
        return count($this->offers);
    }
}