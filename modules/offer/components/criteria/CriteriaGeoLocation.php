<?php

namespace app\modules\offer\components\criteria;

use app\modules\core\components\IPNormalizer;
use app\modules\core\models\GeoCountry;
use app\modules\offer\components\OfferCollection;
use app\modules\offer\models\Offer;
use yii\helpers\ArrayHelper;

class CriteriaGeoLocation implements CriteriaInterface
{
    /**
     * @param OfferCollection $collection
     * @return OfferCollection
     */
    public function match(OfferCollection $collection)
    {
        $ip = YII_DEBUG ? \Yii::$app->params['localIP'] : (new IPNormalizer())->getIP();
        $client = \Yii::$app->geoLocation->process($ip);
        $ISOa2 = $client->getCountryISO();
        $country = GeoCountry::find()->select(['id'])->ISOa2($ISOa2)->asArray()->one();
        $iter = $collection->getIterator();

        /* @var Offer $offer */
        foreach ($iter as $offer) {
            if (!in_array($country['id'], ArrayHelper::getColumn($offer->geoCountries, 'id'))) {
                $collection->offsetUnset($iter->key());
            }
        }

        return $collection;
    }
}
