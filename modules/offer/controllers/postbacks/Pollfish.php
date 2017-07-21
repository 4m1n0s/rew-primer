<?php

namespace app\modules\offer\controllers\postbacks;

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
            if ($transactionOffer = RefTransactionOffer::find()->select(['id'])->lead($tx_id, Offer::POLLFISH)->one()) {
                throw new ErrorException('Transaction already exist: ' . $transactionOffer->id);
            }

            $vcRatio = 100;
            $amount = bcmul($cpa, $vcRatio, 5);

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                if (!\Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $amount,
                    $user,
                    null,
                    Offer::POLLFISH,
                    $tx_id
                )) {
                    throw new ErrorException('Could not save offer transaction');
                }

                // Crediting funds to the user
                $virtualCurrency = new VirtualCurrency($user);
                if (!$virtualCurrency->crediting($amount)) {
                    throw new ErrorException('Could not crediting user');
                }

                // Referral percents bonus
                $keyStorage = Yii::$app->keyStorage;
                $referralPercents = floatval($keyStorage->get('referral_percents'));
                $sourceReferral = $user->sourceReferral;

                if ($referralPercents > 0 && !is_null($sourceReferral)) {

                    $referralVirtualCurrency = new VirtualCurrency($sourceReferral);
                    $referralPercentsAmount = bcmul(bcdiv($amount, 100, $referralVirtualCurrency->scale), $referralPercents, $referralVirtualCurrency->scale);

                    if (!$referralVirtualCurrency->crediting($referralPercentsAmount)) {
                        throw new ErrorException('Referral\'s funds have not been credited');
                    }

                    if (!\Yii::$app->transactionCreator->referralIncome(
                        Transaction::STATUS_COMPLETED,
                        $referralPercentsAmount,
                        $user,
                        null,
                        $sourceReferral
                    )) {
                        throw new ErrorException('Could not save referral transaction');
                    }
                }

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