<?php

namespace app\modules\offer\components;

use app\modules\offer\models\Offer;

class OfferMapper
{
    /* @var Offer[] */
    protected $offers = [];
    protected $temp;

    public function setOffers(OfferCollection $offers)
    {
        $this->offers = $offers;
    }

    public function getLabel($id)
    {
        if (empty($this->temp)) {
            foreach ($this->offers as $offer) {
                $this->temp[$offer->id] = $offer->label;
            }
        }

        return (!empty($this->temp[$id])) ? $this->temp[$id] : 'unknown';
    }
}