<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\Exception;

/**
 * Class CpaLead
 * @package app\modules\offer\controllers\actions
 */
class CpaLead extends Action
{
    public $accessHash = 'hpaaax';

    public function run($access_hash)
    {
        try {
            $allowed_ips = [
                '52.0.65.65'
            ];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new Exception('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $password           = \Yii::$app->request->get('password');
            $subid              = \Yii::$app->request->get('subid');
            $campaign_id        = \Yii::$app->request->get('campaign_id');
            $campaign_name      = \Yii::$app->request->get('campaign_name');
            $payout             = \Yii::$app->request->get('payout');
            $virtual_currency   = \Yii::$app->request->get('virtual_currency');
            $lead_id            = \Yii::$app->request->get('lead_id');
            $ip_address         = \Yii::$app->request->get('ip_address');

            $postback_password = 'b6ek0rf1';

            if ($postback_password != $password) {
                throw new Exception('Wrong password: ' . $password);
            }

            if ($transaction = Transaction::find()->select(['id'])->lead($lead_id, Transaction::OBJECT_TYPE_CPALEAD_OFFER)->one()) {
                throw new Exception('Transaction already exist: ' . $transaction->id);
            }

            if (!($user = User::findOne(['username' => $subid]))) {
                throw new Exception('Unknown user: ' . $subid);
            }

            Transaction::initTransaction(
                Transaction::TYPE_OFFER_INCOME,
                Transaction::STATUS_COMPLETE,
                $virtual_currency,
                $user->id,
                $ip_address,
                Transaction::OBJECT_TYPE_CPALEAD_OFFER,
                $campaign_id,
                $lead_id,
                $campaign_name
            );

        } catch (\Exception $e) {
            \Yii::error('CpaLead POSTBACK exception' . PHP_EOL . $e->getMessage(), 'offer_postback');
            return 0;
        }

        return 1;
    }
}