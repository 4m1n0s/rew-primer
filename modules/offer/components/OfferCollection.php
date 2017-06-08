<?php

namespace app\modules\offer\components;

class OfferCollection
{
    /**
     * @var
     */
    protected $offers = [];

    /**
     * @param Offer $offer
     */
    public function add(Offer $offer)
    {
        array_push($this->offers, $offer);
    }
}