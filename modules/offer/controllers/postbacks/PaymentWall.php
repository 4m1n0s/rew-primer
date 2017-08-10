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
 * Class PaymentWall
 * @package app\modules\offer\controllers\postbacks
 */
class PaymentWall extends Action
{
    public $accessHash = 'vxbowb';

    public function run()
    {
        try {
            $transaction_id     = urldecode(\Yii::$app->request->get('ref'));
            $userID             = urldecode(\Yii::$app->request->get('uid'));
            $amount             = intval(\Yii::$app->request->get('currency'));
            $type               = intval(\Yii::$app->request->get('type'));
            $signature          = urldecode(\Yii::$app->request->get('sig'));

            $secretKey = '69c1a56a1f6cb9264333d258ab55a37d';

            //Check the signature
            $my_signature = md5('uid=' . $userID . 'currency=' . $amount . 'type=' . $type . 'ref=' . $transaction_id . $secretKey);
            if ($my_signature != trim($signature)) {
                //Signatures don't match
                throw new ErrorException('Signature validation error: ' . $my_signature);
            }
            if (!($user = User::findOne(['id' => $userID]))) {
                throw new ErrorException('Unknown user: ' . $userID);
            }

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                \Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $amount,
                    $user,
                    null,
                    Offer::PAYMENTWALL,
                    $transaction_id
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
                'offer_id' => Offer::PAYMENTWALL
            ], 'offer_postback');
            return 0;
        }

        return 'OK';
    }
}