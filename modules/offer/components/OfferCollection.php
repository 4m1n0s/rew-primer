<?php

namespace app\modules\offer\components;

use app\modules\offer\models\Offer;

class OfferCollection extends \ArrayIterator
{
    public function append(Offer $value)
    {
        parent::append($value);
    }
}