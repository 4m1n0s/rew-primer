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
 * Class OfferDaddy
 * @package app\modules\offer\controllers\actions
 */
class OfferDaddy extends Action
{
    public $accessHash = 'wtq7if';

    public function run($access_hash)
    {
        try {
            $transaction_id     = urldecode(\Yii::$app->request->get('transaction_id'));
            $offer_id           = urldecode(\Yii::$app->request->get('offer_id'));
            $offer_name         = urldecode(\Yii::$app->request->get('offer_name'));
            $amount             = urldecode(\Yii::$app->request->get('amount')); //This is what your user is paid in your virtual currency, for example 300 coins
            $virtual_currency   = urldecode(\Yii::$app->request->get('virtual_currency')); // This is simply the name of the currency of your app
            $userid             = urldecode(\Yii::$app->request->get('userid')); //
            $signature          = urldecode(\Yii::$app->request->get('signature'));
            $payout             = urldecode(\Yii::$app->request->get('payout'));
            $subid1             = urldecode(\Yii::$app->request->get('subid1'));
            $subid2             = urldecode(\Yii::$app->request->get('subid2'));
            $subid3             = urldecode(\Yii::$app->request->get('subid3'));

            $your_app_key = 'dd0a8a7f909b9a0e4feb10ef0a9defad';

            //Check the signature
            $my_signature = md5($transaction_id . "/" . $offer_id . "/" . $your_app_key);

            if ($my_signature != trim($signature)) {
                //Signatures don't match
                throw new ErrorException('Signature validation error: ' . $my_signature);
            }
            if (!($user = User::findOne(['username' => $userid]))) {
                throw new ErrorException('Unknown user: ' . $userid);
            }

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                \Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $amount,
                    $user,
                    null,
                    Offer::OFFERDADDY,
                    $transaction_id,
                    $offer_id,
                    $offer_name
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
                'offer_id' => Offer::OFFERDADDY
            ], 'offer_postback');
            return 0;
        }

        return 1;
    }
}