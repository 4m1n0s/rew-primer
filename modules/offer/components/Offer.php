<?php

namespace app\modules\offer\components;

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
}
