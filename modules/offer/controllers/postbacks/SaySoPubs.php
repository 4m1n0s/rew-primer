<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\helpers\Json;

/**
 * Class SaySoPubs
 * @package app\modules\offer\controllers\postbacks
 */
class SaySoPubs extends Action
{
    public $accessHash = 'jac4gw';

    public function run($access_hash)
    {
        \Yii::info('SaySoPubs POSTBACK', 'offer_postback');
        return 'ok';
    }
}