<?php

namespace app\modules\offer\components;

use app\modules\offer\models\Offer as OfferModel;

/**
 * Class OfferFactory
 * @package app\modules\offer\components
 */
class OfferFactory
{
    /**
     * @param integer $offerID
     * @param bool $initTargeting
     * @return OfferModel
     */
    public function create($offerID, $initTargeting = false)
    {
        $offer = OfferModel::find()->id($offerID);

        if ($initTargeting) {
            $offer->joinWith([
                'geoCountries',
                'deviceTypes',
                'deviceOs'
            ]);
        }

        return $offer->one();
    }

    /**
     * @param bool $initTargeting
     * @return OfferCollection
     */
    public function createAll($initTargeting = false)
    {
        $collection = new OfferCollection();
        $offerModelsAQ = OfferModel::find()->active();

        if($initTargeting) {
            $offerModelsAQ->joinWith([
                'geoCountries',
                'deviceTypes',
                'deviceOs'
            ]);
        }

        foreach ($offerModelsAQ->all() as $offer) {
            $collection[] = $offer;
        }

        return $collection;
    }
}