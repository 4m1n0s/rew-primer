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
 * Class SuperRewards
 * @package app\modules\offer\controllers\actions
 */
class SuperRewards extends Action
{
    public $accessHash = '69m34d';

    public function run($access_hash)
    {
        try {
            $allowed_ips = [
                '54.85.0.76',
                '54.84.205.80',
                '54.84.27.163',
            ];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new ErrorException('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $id     = \Yii::$app->request->get('id'); // ID of this transaction.
            $uid    = \Yii::$app->request->get('uid'); // ID of the user which performed this transaction.
            $oid    = \Yii::$app->request->get('oid'); // ID of the offer or direct payment method.
            $new    = \Yii::$app->request->get('new'); // Number of in-game currency your user has earned by completing this offer.
            $total  = \Yii::$app->request->get('total'); // Total number of in-game currency your user has earned on this App.
            $sig    = \Yii::$app->request->get('sig'); // Security hash used to verify the authenticity of the postback.

            $app_secret = '6205db1f7ae8dce7764945db8616fd0a';

            // Create validation signature
            $sig_compare = md5($id . ':' . $new . ':' . $uid . ':' . $app_secret);
            if ($sig != $sig_compare) {
                // Signatures not equal - send error code
                throw new ErrorException('Signature validation error: ' . $sig_compare);
            }
            if (!($user = User::findOne(['id' => $uid]))) {
                throw new ErrorException('Unknown user: ' . $uid);
            }
            if ($transactionOffer = RefTransactionOffer::find()->select(['id'])->lead($id, Offer::SUPERREWARDS)->one()) {
                throw new ErrorException('Transaction already exist: ' . $transactionOffer->id);
            }

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                if (!\Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $new,
                    $user,
                    null,
                    Offer::SUPERREWARDS,
                    $id,
                    $oid
                )) {
                    throw new ErrorException('Could not save offer transaction');
                }

                // Crediting funds to the user
                $virtualCurrency = new VirtualCurrency($user);
                if (!$virtualCurrency->crediting($new)) {
                    throw new ErrorException('Could not crediting user');
                }

                // Referral percents bonus
                $keyStorage = Yii::$app->keyStorage;
                $referralPercents = floatval($keyStorage->get('referral_percents'));
                $sourceReferral = $user->sourceReferral;

                if ($referralPercents > 0 && !is_null($sourceReferral)) {

                    $referralVirtualCurrency = new VirtualCurrency($sourceReferral);
                    $referralPercentsAmount = bcmul(bcdiv($new, 100, $referralVirtualCurrency->scale), $referralPercents, $referralVirtualCurrency->scale);

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
                'offer_id' => Offer::SUPERREWARDS
            ], 'offer_postback');
            return 0;
        }

        return 1;
    }
}