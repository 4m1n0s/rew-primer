<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\Exception;

/**
 * Class OfferToro
 * @package app\modules\offer\controllers\actions
 */
class OfferToro extends Action
{
    public $accessHash = '59hvrr';

    public function run($access_hash)
    {
        try {
            $allowed_ips = [
                '54.175.173.245'
            ];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new Exception('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $id                 = \Yii::$app->request->get('id');
            $oid                = \Yii::$app->request->get('oid');
            $amount             = \Yii::$app->request->get('amount');
            $currency_name      = \Yii::$app->request->get('currency_name');
            $user_id            = \Yii::$app->request->get('user_id');
            $payout             = \Yii::$app->request->get('payout');
            $o_name             = \Yii::$app->request->get('o_name');
            $sig                = \Yii::$app->request->get('sig');
            $package_id         = \Yii::$app->request->get('package_id');
            $ip_address         = \Yii::$app->request->get('ip_address');

            $secret_key = '';

            // Create validation signature
            $validation_signature = md5($oid . '-' . $user_id . ':' . $secret_key);

            if ($sig != $validation_signature) {
                // Signatures not equal - send error code
                throw new Exception('Signature validation error: ' . $validation_signature);
            }

            if (!($user = User::findOne(['username' => $user_id]))) {
                throw new Exception('Unknown user: ' . $user_id);
            }

            Transaction::initTransaction(
                Transaction::TYPE_OFFER_INCOME,
                Transaction::STATUS_COMPLETE,
                $amount,
                $user->id,
                $ip_address,
                Transaction::OBJECT_TYPE_OFFERTORO_OFFER,
                $oid,
                $id,
                $o_name
            );

        } catch (\Exception $e) {
            \Yii::error('OfferToro POSTBACK exception' . PHP_EOL . $e->getMessage(), 'offer_postback');
            return 0;
        }

        return 1;
    }
}