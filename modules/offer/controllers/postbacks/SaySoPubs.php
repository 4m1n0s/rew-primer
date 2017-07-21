<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Offer;
use app\modules\core\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use yii\helpers\Json;
use Yii;

/**
 * Class SaySoPubs
 * @package app\modules\offer\controllers\postbacks
 */
class SaySoPubs extends Action
{
    public $accessHash = 'jac4gw';

    public function run($access_hash)
    {
        \Yii::info([
            'message' => 'SAYSOPUBS info',
            'offer_id' => Offer::SAYSOPUBS
        ], 'offer_postback');
        return 'ok';
    }
}