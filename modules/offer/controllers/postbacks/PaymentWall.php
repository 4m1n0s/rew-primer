<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use yii\base\Exception;

/**
 * Class PaymentWall
 * @package app\modules\offer\controllers\postbacks
 */
class PaymentWall extends Action
{
    public $accessHash = 'vxbowb';

    public function run()
    {
        \Yii::info('info', 'offer_postback');
        echo 'OK';
    }
}