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
     * @param bool $init
     * @return Offer
     */
    public function create($offerID, $init = true)
    {
        return new Offer($offerID);
    }

    /**
     * @return OfferCollection
     */
    public function createAll()
    {
        $collection = new OfferCollection();

        $collection->add($this->create(Offer::ADWORKMEDIA));
        $collection->add($this->create(Offer::KIWIWALL));
        $collection->add($this->create(Offer::OFFERTORO));
        $collection->add($this->create(Offer::OFFERDADDY));
        $collection->add($this->create(Offer::CLIXWALL));
        $collection->add($this->create(Offer::PTCWALL));
        $collection->add($this->create(Offer::SUPERREWARDS));
        $collection->add($this->create(Offer::MINUTESTAFF));
        $collection->add($this->create(Offer::CPALEAD));
        $collection->add($this->create(Offer::PERSONA));
        $collection->add($this->create(Offer::FYBER));
        $collection->add($this->create(Offer::POLLFISH));
        $collection->add($this->create(Offer::PAYMENTWALL));

        return $collection;
    }
}