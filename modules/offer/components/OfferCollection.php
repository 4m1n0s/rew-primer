<?php

namespace app\modules\offer\components;

use app\modules\offer\models\Offer;
use yii\base\InvalidConfigException;

class OfferCollection extends \ArrayIterator
{
    public function append($value)
    {
        if (!$value instanceof Offer) {
            throw new InvalidConfigException(__METHOD__ . ' method must accept ' . Offer::class . ' object only');
        }

        parent::append($value);
    }
}