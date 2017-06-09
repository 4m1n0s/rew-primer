<?php

namespace app\modules\offer\components;

class OfferCollection extends \ArrayIterator
{
    public function append(Offer $value)
    {
        parent::append($value);
    }
}