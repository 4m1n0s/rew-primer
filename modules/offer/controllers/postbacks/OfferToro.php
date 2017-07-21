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
                throw new ErrorException('IP not allowed: ' . \Yii::$app->request->getUserIP());
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

            $secret_key = '795b48cc06368fa88f696a0cc1268b0f';

            // Create validation signature
            $validation_signature = md5($oid . '-' . $user_id . '-' . $secret_key);

            if ($sig != $validation_signature) {
                // Signatures not equal - send error code
                throw new ErrorException('Signature validation error: ' . $validation_signature);
            }
            if (!($user = User::findOne(['username' => $user_id]))) {
                throw new ErrorException('Unknown user: ' . $user_id);
            }
            if ($transactionOffer = RefTransactionOffer::find()->select(['id'])->lead($id, Offer::OFFERTORO)->one()) {
                throw new ErrorException('Transaction already exist: ' . $transactionOffer->id);
            }
            
            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                if (!\Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $amount,
                    $user,
                    null,
                    Offer::OFFERTORO,
                    $id,
                    $oid,
                    $o_name
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
                'offer_id' => Offer::OFFERTORO
            ], 'offer_postback');
            return 0;
        }

        return 1;
    }
}