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
 * Class CpaLead
 * @package app\modules\offer\controllers\actions
 */
class CpaLead extends Action
{
    public $accessHash = 'hpaaax';

    public function run($access_hash)
    {
        try {
            $allowed_ips = [
                '52.0.65.65'
            ];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new ErrorException('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $password           = \Yii::$app->request->get('password');
            $subid              = \Yii::$app->request->get('subid');
            $campaign_id        = \Yii::$app->request->get('campaign_id');
            $campaign_name      = \Yii::$app->request->get('campaign_name');
            $payout             = \Yii::$app->request->get('payout');
            $virtual_currency   = \Yii::$app->request->get('virtual_currency');
            $lead_id            = \Yii::$app->request->get('lead_id');
            $ip_address         = \Yii::$app->request->get('ip_address');

            $postback_password = 'b6ek0rf1';

            if ($postback_password != $password) {
                throw new ErrorException('Wrong password: ' . $password);
            }
            if ($transactionOffer = RefTransactionOffer::find()->select(['id'])->lead($lead_id, Offer::CPALEAD)->one()) {
                throw new ErrorException('Transaction already exist: ' . $transactionOffer->id);
            }
            if (!($user = User::findOne(['username' => $subid]))) {
                throw new ErrorException('Unknown user: ' . $subid);
            }

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                if (!\Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $virtual_currency,
                    $user,
                    $ip_address,
                    Offer::CPALEAD,
                    $lead_id,
                    $campaign_id,
                    $campaign_name
                )) {
                    throw new ErrorException('Could not save offer transaction');
                }

                // Crediting funds to the user
                $virtualCurrency = new VirtualCurrency($user);
                if (!$virtualCurrency->crediting($virtual_currency)) {
                    throw new ErrorException('Could not crediting user');
                }

                // Referral percents bonus
                $keyStorage = Yii::$app->keyStorage;
                $referralPercents = floatval($keyStorage->get('referral_percents'));
                $sourceReferral = $user->sourceReferral;

                if ($referralPercents > 0 && !is_null($sourceReferral)) {

                    $referralVirtualCurrency = new VirtualCurrency($sourceReferral);
                    $referralPercentsAmount = bcmul(bcdiv($virtual_currency, 100, $referralVirtualCurrency->scale), $referralPercents, $referralVirtualCurrency->scale);

                    if (!$referralVirtualCurrency->crediting($referralPercentsAmount)) {
                        throw new ErrorException('Referral\'s funds have not been credited');
                    }

                    if (!\Yii::$app->transactionCreator->referralIncome(
                        Transaction::STATUS_COMPLETED,
                        $referralPercentsAmount,
                        $user,
                        $ip_address,
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
                'offer_id' => Offer::CPALEAD
            ], 'offer_postback');
            return 0;
        }

        return 1;
    }
}