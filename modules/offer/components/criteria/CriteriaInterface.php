<?php

namespace app\modules\offer\components\criteria;

use app\modules\offer\components\OfferCollection;

interface CriteriaInterface
{
    /**
     * @param OfferCollection $offers
     * @return OfferCollection
     */
    public function match(OfferCollection $offers);
}