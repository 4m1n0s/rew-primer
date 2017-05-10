<?php

namespace app\modules\offer\controllers\postbacks;

use yii\base\Action;

class OfferDaddy extends Action
{
    public function run()
    {
        \Yii::info('OfferDaddy POSTBACK', 'offer_postback');
    }
}