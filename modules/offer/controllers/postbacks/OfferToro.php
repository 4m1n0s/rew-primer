<?php

namespace app\modules\offer\controllers\postbacks;

use yii\base\Action;

class OfferToro extends Action
{
    public function run()
    {
        \Yii::info('OfferToro POSTBACK', 'offer_postback');
    }
}