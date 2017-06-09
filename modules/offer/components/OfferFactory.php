<?php

namespace app\modules\offer\components;

/**
 * Class OfferFactory
 * @package app\modules\offer\components
 */
class OfferFactory
{
    /**
     * @param integer $offerID
     * @param bool $initTargeting
     * @return Offer
     */
    public function create($offerID, $initTargeting = false)
    {
        $offer = new Offer($offerID);

        if ($initTargeting) {
            $offer->initTargeting();
        }

        return $offer;
    }

    /**
     * @param bool $initTargeting
     * @return OfferCollection
     */
    public function createAll($initTargeting = false)
    {
        $collection = new OfferCollection();

        $collection->append($this->create(Offer::ADWORKMEDIA, $initTargeting));
        $collection->append($this->create(Offer::KIWIWALL, $initTargeting));
        $collection->append($this->create(Offer::OFFERTORO, $initTargeting));
        $collection->append($this->create(Offer::OFFERDADDY, $initTargeting));
        $collection->append($this->create(Offer::CLIXWALL, $initTargeting));
        $collection->append($this->create(Offer::PTCWALL, $initTargeting));
        $collection->append($this->create(Offer::SUPERREWARDS, $initTargeting));
        $collection->append($this->create(Offer::MINUTESTAFF, $initTargeting));
        $collection->append($this->create(Offer::CPALEAD, $initTargeting));
        $collection->append($this->create(Offer::PERSONA, $initTargeting));
        $collection->append($this->create(Offer::FYBER, $initTargeting));
        $collection->append($this->create(Offer::POLLFISH, $initTargeting));
        $collection->append($this->create(Offer::PAYMENTWALL, $initTargeting));

        return $collection;
    }
}