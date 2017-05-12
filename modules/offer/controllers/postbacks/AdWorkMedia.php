<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\Exception;

/**
 * Class AdWorkMedia
 * @package app\modules\offer\controllers\actions
 */
class AdWorkMedia extends Action
{
    public $accessHash = 'e5c5xn';

    public function run($access_hash)
    {
        try {
            $allowed_ips = [
                '67.227.230.75',
                '67.227.230.76',
            ];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new Exception('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $campaign_id        = \Yii::$app->request->get('campaign_id');
            $campaign_name      = \Yii::$app->request->get('campaign_id');
            $sid                = \Yii::$app->request->get('sid');
            $status             = \Yii::$app->request->get('status');
            $commission         = \Yii::$app->request->get('commission');
            $ip                 = \Yii::$app->request->get('ip');
            $reversal_reason    = \Yii::$app->request->get('reversal_reason');
            $test               = \Yii::$app->request->get('test');
            $vc_value           = \Yii::$app->request->get('vc_value');
            $leadID             = \Yii::$app->request->get('leadID');
            $country            = \Yii::$app->request->get('country');

            if (!($user = User::findOne(['username' => $sid]))) {
                throw new Exception('Unknown user: ' . $sid);
            }

            Transaction::initTransaction(
                Transaction::TYPE_OFFER_INCOME,
                $status == 1 ? Transaction::STATUS_COMPLETE : Transaction::STATUS_REVERSED,
                $vc_value,
                $user->id,
                $ip,
                Transaction::OBJECT_TYPE_ADWORKMEDIA_OFFER,
                $campaign_id,
                $leadID,
                $campaign_name
            );

        } catch (\Exception $e) {
            \Yii::error('AdWorkMedia POSTBACK exception' . PHP_EOL . $e->getMessage(), 'offer_postback');
        }
    }
}