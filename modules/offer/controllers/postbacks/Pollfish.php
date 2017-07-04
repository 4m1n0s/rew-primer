<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Offer;
use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use yii\base\Exception;

/**
 * Class Pollfish
 * @package app\modules\offer\controllers\actions
 */
class Pollfish extends Action
{
    public $accessHash = 'urubie';

    public function run($access_hash)
    {

        $transaction = \Yii::$app->db->beginTransaction();

        try {

            $secret_key = '44af0038-3e84-4373-8887-325c982e889c';

            $device_id      = rawurldecode(\Yii::$app->request->get('device_id'));
            $cpa            = rawurldecode(\Yii::$app->request->get('cpa'));
            $request_uuid   = rawurldecode(\Yii::$app->request->get('request_uuid'));
            $tx_id          = rawurldecode(\Yii::$app->request->get('tx_id'));
            $status         = rawurldecode(\Yii::$app->request->get('status'));
            $timestamp      = rawurldecode(\Yii::$app->request->get('timestamp'));
            $signature      = rawurldecode(\Yii::$app->request->get('signature'));

            if (!$status) {
                return;
            }

            $data = $cpa . ":" . $device_id;
            if (!empty($request_uuid)) { // only added when non-empty
                $data = $data . ":" . $request_uuid;
            }
            $data = $data . ":" . $status . ":" . $timestamp . ":" . $tx_id;
            $computed_signature = base64_encode(hash_hmac("sha1" , $data, $secret_key, true));

            if ($signature != $computed_signature) {
                throw new Exception('Signature validation error: ' . $computed_signature);
            }

            if (!($user = User::findOne(['id' => $request_uuid]))) {
                throw new Exception('Unknown user: ' . $request_uuid);
            }

            $vcRatio = 100;
            $amount = bcmul($cpa, $vcRatio, 5);

            Transaction::initTransaction(
                Transaction::TYPE_OFFER_INCOME,
                Transaction::STATUS_COMPLETE,
                $amount,
                $user->id,
                null,
                Transaction::OBJECT_TYPE_POLLFISH_OFFER,
                null,
                $tx_id
            );

            $virtualCurrency = \Yii::$app->virtualCurrency;
            $virtualCurrency->setUser($user);

            if (!$virtualCurrency->crediting($amount)) {
                throw new ErrorException('Could not crediting user');
            }

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::error([
                'message' => $e->getMessage(),
                'offer_id' => Offer::POLLFISH
            ], 'offer_postback');
        }
    }
}