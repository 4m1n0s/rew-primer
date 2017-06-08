<?php

namespace app\modules\offer\components\criteria;

use app\modules\offer\components\OfferCollection;

class CriteriaGeoLocation implements CriteriaInterface
{
    /**
     * @param OfferCollection $offers
     * @return OfferCollection
     */
    public function match(OfferCollection $offers)
    {
        // TODO: Implement meetCriteria() method.

        return $offers;
    }
}