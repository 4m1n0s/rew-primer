<?php

namespace app\modules\offer\components;

use yii\base\InvalidConfigException;

class Offer
{
    const ADWORKMEDIA       = 10;
    const KIWIWALL          = 11;
    const OFFERTORO         = 12;
    const OFFERDADDY        = 13;
    const CLIXWALL          = 14;
    const PTCWALL           = 15;
    const SUPERREWARDS      = 16;
    const MINUTESTAFF       = 17;
    const CPALEAD           = 18;
    const PERSONA           = 19;
    const FYBER             = 20;
    const POLLFISH          = 21;
    const PAYMENTWALL       = 22;

    public $id;
    
    public function __construct($offerID)
    {
        $this->id = $offerID;
    }

    public static function getStorageKeyCountry($offerID)
    {
        if (!static::isExist($offerID)) {
            throw new InvalidConfigException('Unexpected offer ID: ' . $offerID);
        }

        return 'offer.targeting.country.' . $offerID;
    }

    /**
     * @param $offerID
     * @return bool
     */
    public static function isExist($offerID)
    {
        // TODO: Not implemented;

        return true;
    }
}
