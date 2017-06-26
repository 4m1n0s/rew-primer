<?php

namespace app\modules\offer\components\criteria;

use app\modules\offer\components\OfferCollection;
use app\modules\offer\models\Offer;

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
        $filteredCollection = new OfferCollection();

        /* @var Offer $offer */
        foreach ($iter as $offer) {
            if (in_array(Offer::DEVICE_TYPE_DESKTOP, $offer->targetingDeviceTypeList) &&
                $this->getCurrentDeviceType() == Offer::DEVICE_TYPE_DESKTOP) {
                $filteredCollection[] = $offer;
                continue;
            }

            if ((in_array(Offer::DEVICE_TYPE_MOBILE, $offer->targetingDeviceTypeList) &&
                    $this->getCurrentDeviceType() == Offer::DEVICE_TYPE_MOBILE) &&
                (in_array($this->getCurrentOS(), $offer->targetingDeviceMobileOSList))
            ) {
                $filteredCollection[] = $offer;
                continue;
            }

            if ((in_array(Offer::DEVICE_TYPE_TABLET, $offer->targetingDeviceTypeList) &&
                    $this->getCurrentDeviceType() == Offer::DEVICE_TYPE_TABLET) &&
                (in_array($this->getCurrentOS(), $offer->targetingDeviceTabletOSList))
            ) {
                $filteredCollection[] = $offer;
                continue;
            }
        }

        return $filteredCollection;
    }

    protected function getCurrentDeviceType()
    {
        $detect = $this->detect;
        
        if ($detect->isMobile() && !$detect->isTablet()) {
            return Offer::DEVICE_TYPE_MOBILE;
        } elseif ($detect->isTablet()) {
            return Offer::DEVICE_TYPE_TABLET;
        } else {
            return Offer::DEVICE_TYPE_DESKTOP;
        }
    }

    protected function getCurrentOS()
    {
        $detect = $this->detect;

        if ($detect->isiOS()) {
            return Offer::OS_IOS;
        } elseif ($detect->isAndroidOS()) {
            return Offer::OS_ANDROID;
        } elseif ($detect->isWindowsPhoneOS()) {
            return Offer::OS_WINDOWS;
        } elseif ($detect->isBlackBerryOS()) {
            return Offer::OS_BLACKBERRY;
        } else {
            return Offer::OS_OTHER;
        }
    }
}
