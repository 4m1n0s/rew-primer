<?php

namespace app\modules\offer\controllers\postbacks;

use yii\base\Action;

/**
 * Class OfferToro
 * @package app\modules\offer\controllers\actions
 */
class OfferToro extends Action
{
    public $accessHash = '59hvrr';

    public function run($access_hash)
    {
        \Yii::info('OfferToro POSTBACK', 'offer_postback');
    }
}