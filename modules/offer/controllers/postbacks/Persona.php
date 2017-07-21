<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\core\components\VirtualCurrency;
use app\modules\offer\models\Offer;
use app\modules\core\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use Yii;

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
                throw new ErrorException('IP not allowed: ' . \Yii::$app->request->getUserIP());
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
                throw new ErrorException('Signature validation error: ' . $validation_signature);
            }
            if (!($user = User::findOne(['id' => $user_id]))) {
                throw new ErrorException('Unknown user id: ' . $user_id);
            }

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                if (!\Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $amount,
                    $user,
                    null,
                    Offer::PERSONA,
                    null,
                    $offer_id,
                    $offer_name
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
                'offer_id' => Offer::PERSONA
            ], 'offer_postback');
            return 0;
        }

        return 1;
    }
}