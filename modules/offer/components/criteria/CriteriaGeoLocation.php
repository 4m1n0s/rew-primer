<?php

namespace app\modules\offer\components\criteria;

use app\modules\core\components\IPNormalizer;
use app\modules\core\models\GeoCountry;
use app\modules\offer\components\Offer;
use app\modules\offer\components\OfferCollection;

class CriteriaGeoLocation implements CriteriaInterface
{
    /**
     * @param OfferCollection $offers
     * @return OfferCollection
     */
    public function match(OfferCollection $offers)
    {
        $ip = YII_DEBUG ? '45.78.27.15' : (new IPNormalizer())->getIP();
        $client = \Yii::$app->geoLocation->process($ip);
        $ISOa2 = $client->getCountryISO();
        $country = GeoCountry::find()->select(['id'])->ISOa2($ISOa2)->asArray()->one();

        foreach ($offers as $idx => $offer) {
            /* @var Offer $offer */
            if (!in_array($country['id'], $offer->targetingCountryList)) {
                unset($offers[$idx]);
            }
        }

        return $offers;
    }
}