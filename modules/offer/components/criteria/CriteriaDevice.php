<?php

namespace app\modules\offer\components\criteria;

use app\modules\offer\components\OfferCollection;
use app\modules\offer\models\Offer;
use Detection\MobileDetect;

class CriteriaDevice implements CriteriaInterface
{
    /**
     * @var \Mobile_Detect
     */
    protected $detect;

    /**
     * @param OfferCollection $offers
     * @return OfferCollection
     */
    public function match(OfferCollection $offers)
    {
        $this->detect = new \Mobile_Detect();
        $filteredCollection = new OfferCollection();

        /** @var Offer $offer */
        foreach ($offers as $idx => $offer) {
            if (in_array(Offer::DEVICE_TYPE_DESKTOP, $offer->targetingDeviceTypeList) &&
                $this->getCurrentDeviceType() == Offer::DEVICE_TYPE_DESKTOP) {
                $filteredCollection->append($offer);
                continue;
            }

            if ((in_array(Offer::DEVICE_TYPE_MOBILE, $offer->targetingDeviceTypeList) &&
                    $this->getCurrentDeviceType() == Offer::DEVICE_TYPE_MOBILE) &&
                (in_array($this->getCurrentOS(), $offer->targetingDeviceMobileOSList))
            ) {
                $filteredCollection->append($offer);
                continue;
            }

            if ((in_array(Offer::DEVICE_TYPE_TABLET, $offer->targetingDeviceTypeList) &&
                    $this->getCurrentDeviceType() == Offer::DEVICE_TYPE_TABLET) &&
                (in_array($this->getCurrentOS(), $offer->targetingDeviceTabletOSList))
            ) {
                $filteredCollection->append($offer);
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
        } elseif ($detect->isMobile()) {
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
