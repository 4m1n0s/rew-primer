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
        $offer = OfferModel::find()->id($offerID)->one();

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
        $offerModels = OfferModel::find()->active()->all();

        foreach ($offerModels as $idx => $offerModel) {
            if ($initTargeting) {
                $offerModel->initTargeting();
            }
            $collection[] = $offerModel;
        }

        return $collection;
    }
}