<?php

namespace app\modules\offer\controllers\postbacks;

use yii\base\Action;

/**
 * Class OfferDaddy
 * @package app\modules\offer\controllers\actions
 */
class OfferDaddy extends Action
{
    public $accessHash = 'wtq7if';

    public function run($access_hash)
    {
        \Yii::info('OfferDaddy POSTBACK', 'offer_postback');
    }
}