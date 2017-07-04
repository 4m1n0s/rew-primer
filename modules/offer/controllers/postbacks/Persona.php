<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Offer;
use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use yii\base\Exception;

/**
 * Class Persona
 * @package app\modules\offer\controllers\postbacks
 */
class Persona extends Action
{
    public $accessHash = '6mzvje';

    public function run($access_hash)
    {
        try {
            $allowed_ips = array(
                '162.243.242.7',
                '162.243.34.227',
                '52.200.142.249',
            );

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new Exception('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $user_id        = \Yii::$app->request->get('user_id');
            $amount         = \Yii::$app->request->get('amount');
            $offer_id       = \Yii::$app->request->get('offer_id');
            $app_id         = \Yii::$app->request->get('app_id');
            $signature      = \Yii::$app->request->get('signature');
            $offer_name     = \Yii::$app->request->get('offer_name');

            $secret_key = '4585b277bff753702b3988b520a0c9ae';
            $app_hash = '93aa4722ccc529cfc231482b18b7d78f';

            // Create validation signature
            $validation_signature = md5($user_id . ':' . $app_hash . ':' . $secret_key); // the app_hash can be found in your app settings

            if ($signature != $validation_signature) {
                // Signatures not equal - send error code
                throw new Exception('Signature validation error: ' . $validation_signature);
            }

            if (!($user = User::findOne(['id' => $user_id]))) {
                throw new Exception('Unknown user id: ' . $user_id);
            }

            Transaction::initTransaction(
                Transaction::TYPE_OFFER_INCOME,
                Transaction::STATUS_COMPLETE,
                $amount,
                $user->id,
                null,
                Transaction::OBJECT_TYPE_PERSONA_OFFER,
                $offer_id,
                null,
                $offer_name
            );

            $virtualCurrency = \Yii::$app->virtualCurrency;
            $virtualCurrency->setUser($user);

            if (!$virtualCurrency->crediting($amount)) {
                throw new ErrorException('Could not crediting user');
            }

        } catch (\Exception $e) {
            \Yii::error([
                'message' => $e->getMessage(),
                'offer_id' => Offer::PERSONA
            ], 'offer_postback');
            return 0;
        }

        return 1;
    }
}