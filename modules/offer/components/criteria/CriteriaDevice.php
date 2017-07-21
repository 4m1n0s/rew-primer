<?php

namespace app\modules\offer\components\criteria;

use app\modules\offer\components\OfferCollection;
use app\modules\offer\models\Offer;
use app\modules\offer\models\OfferDeviceOs;
use app\modules\offer\models\OfferDeviceType;
use yii\helpers\ArrayHelper;

class CriteriaDevice implements CriteriaInterface
{
    /**
     * @var \Mobile_Detect
     */
    protected $detect;

    /**
     * @param OfferCollection $collection
     * @return OfferCollection
     */
    public function match(OfferCollection $collection)
    {
        $this->detect = new \Mobile_Detect();
        $iter = $collection->getIterator();

        /* @var Offer $offer */
        foreach ($iter as $offer) {
            $targetingDeviceTypeList = ArrayHelper::getColumn($offer->deviceTypes, 'type');
            $targetingDeviceOsList   = ArrayHelper::getColumn($offer->deviceOs, 'os');

            if (!in_array(OfferDeviceType::DEVICE_TYPE_DESKTOP, $targetingDeviceTypeList) &&
                $this->getCurrentDeviceType() == OfferDeviceType::DEVICE_TYPE_DESKTOP) {
                $collection->offsetUnset($iter->key());
                continue;
            }
            if ((!in_array(OfferDeviceType::DEVICE_TYPE_MOBILE, $targetingDeviceTypeList) &&
                    $this->getCurrentDeviceType() == OfferDeviceType::DEVICE_TYPE_MOBILE) &&
                (!in_array($this->getCurrentOS(), $targetingDeviceOsList))
            ) {
                $collection->offsetUnset($iter->key());
            }
        }

        return $collection;
    }

    protected function getCurrentDeviceType()
    {
        $detect = $this->detect;
        
        return $detect->isMobile()
            ? OfferDeviceType::DEVICE_TYPE_MOBILE
            : OfferDeviceType::DEVICE_TYPE_DESKTOP;
    }

    protected function getCurrentOS()
    {
        $detect = $this->detect;

        if ($detect->isiOS()) {
            return OfferDeviceOs::OS_IOS;
        } elseif ($detect->isAndroidOS()) {
            return OfferDeviceOs::OS_ANDROID;
        } elseif ($detect->isWindowsPhoneOS()) {
            return OfferDeviceOs::OS_WINDOWS;
        } elseif ($detect->isBlackBerryOS()) {
            return OfferDeviceOs::OS_BLACKBERRY;
        } else {
            return OfferDeviceOs::OS_OTHER;
        }
    }
}
