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
 * Class AdWorkMedia
 * @package app\modules\offer\controllers\actions
 */
class AdWorkMedia extends Action
{
    public $accessHash = 'e5c5xn';

    public function run($access_hash)
    {
        try {
            $allowed_ips = [
                '67.227.230.75',
                '67.227.230.76',
            ];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new ErrorException('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $campaign_id        = \Yii::$app->request->get('campaign_id');
            $campaign_name      = \Yii::$app->request->get('campaign_id');
            $sid                = \Yii::$app->request->get('sid');
            $status             = \Yii::$app->request->get('status');
            $commission         = \Yii::$app->request->get('commission');
            $ip                 = \Yii::$app->request->get('ip');
            $reversal_reason    = \Yii::$app->request->get('reversal_reason');
            $test               = \Yii::$app->request->get('test');
            $vc_value           = \Yii::$app->request->get('vc_value');
            $leadID             = \Yii::$app->request->get('leadID');
            $country            = \Yii::$app->request->get('country');

            if (!($user = User::findOne(['username' => $sid]))) {
                throw new ErrorException('Unknown user: ' . $sid);
            }
            if ($transactionOffer = RefTransactionOffer::find()->select(['id'])->lead($leadID, Offer::ADWORKMEDIA)->one()) {
                throw new ErrorException('Transaction already exist: ' . $transactionOffer->id);
            }

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                if (!\Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $vc_value,
                    $user,
                    $ip,
                    Offer::ADWORKMEDIA,
                    $leadID,
                    $campaign_id,
                    $campaign_name
                )) {
                    throw new ErrorException('Could not save offer transaction');
                }

                // Crediting funds to the user
                $userVirtualCurrency = new VirtualCurrency($user);
                if (!$userVirtualCurrency->crediting($vc_value)) {
                    throw new ErrorException('User\'s funds have not been credited');
                }

                // Referral percents bonus
                $keyStorage = Yii::$app->keyStorage;
                $referralPercents = floatval($keyStorage->get('referral_percents'));
                $sourceReferral = $user->sourceReferral;

                if ($referralPercents > 0 && !is_null($sourceReferral)) {

                    $referralVirtualCurrency = new VirtualCurrency($sourceReferral);
                    $referralPercentsAmount = bcmul(bcdiv($vc_value, 100, $referralVirtualCurrency->scale), $referralPercents, $referralVirtualCurrency->scale);

                    if (!$referralVirtualCurrency->crediting($referralPercentsAmount)) {
                        throw new ErrorException('Referral\'s funds have not been credited');
                    }

                    if (!\Yii::$app->transactionCreator->referralIncome(
                        Transaction::STATUS_COMPLETED,
                        $referralPercentsAmount,
                        $user,
                        $ip,
                        $sourceReferral
                    )) {
                        throw new ErrorException('Could not save referral transaction');
                    }
                }

                $transactionDB->commit();
            } catch (\Exception $e) {
                $transactionDB->rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            \Yii::error([
                'message' => $e->getMessage(),
                'offer_id' => Offer::ADWORKMEDIA
            ], 'offer_postback');
        }
    }
}