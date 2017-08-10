<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\core\components\ReferralBonus;
use app\modules\core\components\VirtualCurrency;
use app\modules\core\models\RefTransactionOffer;
use app\modules\offer\models\Offer;
use app\modules\core\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use Yii;

/**
 * Class Pollfish
 * @package app\modules\offer\controllers\actions
 */
class Pollfish extends Action
{
    public $accessHash = 'urubie';

    public function run($access_hash)
    {
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
                throw new ErrorException('Signature validation error: ' . $computed_signature);
            }
            if (!($user = User::findOne(['id' => $request_uuid]))) {
                throw new ErrorException('Unknown user: ' . $request_uuid);
            }

            $vcRatio = 100;
            $amount = bcmul($cpa, $vcRatio, 5);

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                \Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $amount,
                    $user,
                    null,
                    Offer::POLLFISH,
                    $tx_id
                );

                // Crediting funds to the user
                $virtualCurrency = new VirtualCurrency($user);
                $virtualCurrency->crediting($amount);

                // Referral percents bonus
                $keyStorage = Yii::$app->keyStorage;
                $referralBonus = new ReferralBonus($user);
                $referralBonus->generalPercents = floatval($keyStorage->get('referral_percents'));
                $referralBonus->addPercents($amount);

                $transactionDB->commit();
            } catch (ErrorException $e) {
                $transactionDB->rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            \Yii::error([
                'message' => $e->getMessage(),
                'offer_id' => Offer::POLLFISH
            ], 'offer_postback');
        }
    }
}