<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Offer;
use yii\base\Action;

/**
 * Class MobileAvenue
 * @package app\modules\offer\controllers\postbacks
 */
class MobileAvenue extends Action
{
    public $accessHash = 'yj6e5k';

    public function run($access_hash)
    {
        \Yii::info([
            'message' => 'SAYSOPUBS info',
            'offer_id' => Offer::MOBILEAVENUE
        ], 'offer_postback');
        return 'ok';
    }
}