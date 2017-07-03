<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use yii\base\Exception;

/**
 * Class Dryverlessads
 * @package app\modules\offer\controllers\actions
 */
class Dryverlessads extends Action
{
    public $accessHash = 'rvdkcz';

    public function run($access_hash)
    {
        try {
            $allowed_ips = [
                '40.118.255.137',
                '40.118.255.231',
                '40.118.250.218',
                '40.118.252.35',
            ];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new Exception('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $apiKey = 'b9b8239e6f5045ac905f2f9b65b65b27';

            $payout         = \Yii::$app->request->get('payout');     // Custom currency
            $country        = \Yii::$app->request->get('country');     // Country code
            $leadID         = \Yii::$app->request->get('tid');
            $campaignID     = \Yii::$app->request->get('id');
            $campaignName   = \Yii::$app->request->get('name');
            $status         = \Yii::$app->request->get('status');
            $cs             = \Yii::$app->request->get('hash');

        } catch (\Exception $e) {
            \Yii::error('Dryverlessads POSTBACK exception' . PHP_EOL . $e->getMessage(), 'offer_postback');
        }

        \Yii::info('Dryverlessads info', 'offer_postback');
    }
}