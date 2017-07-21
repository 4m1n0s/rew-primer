<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\core\components\VirtualCurrency;
use app\modules\core\models\RefTransactionOffer;
use app\modules\offer\models\Offer;
use app\modules\core\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use yii\helpers\Json;
use Yii;

/**
 * Class Ptcwall
 * @package app\modules\offer\controllers\actions
 */
class Ptcwall extends Action
{
    public $accessHash = '57oeou';

    public function run($access_hash)
    {
        try {

            $sent_pw        = \Yii::$app->request->get('pwd');
            $credited       = intval(\Yii::$app->request->get('c'));
            $credituser     = trim(\Yii::$app->request->get('usr'));
            $rate           = trim(\Yii::$app->request->get('r'));
            $type           = intval(\Yii::$app->request->get('t'));
            $name           = trim(\Yii::$app->request->get('none'));
            $ip             = trim(\Yii::$app->request->get('userip'));
            $transactionID  = trim(\Yii::$app->request->get('tid'));

            $allowed_ips = [
                '199.193.247.113'
            ];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new ErrorException('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }
            $user_password = '8Kvk0RH1432vJXZKaNS2vYK53VnipL5';
            if ($user_password != $sent_pw) {
                throw new ErrorException('Incorrect password: ' . $sent_pw);
            }
            if (!($user = User::findOne(['username' => $credituser]))) {
                throw new ErrorException('Unknown user: ' . $credituser);
            }
            if ($transactionOffer = RefTransactionOffer::find()->select(['id'])->lead($transactionID, Offer::PTCWALL)->one()) {
                throw new ErrorException('Transaction already exist: ' . $transactionOffer->id);
            }

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                if (!\Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $rate,
                    $user,
                    $ip,
                    Offer::PTCWALL,
                    $transactionID,
                    null,
                    $name
                )) {
                    throw new ErrorException('Could not save offer transaction');
                }

                // Crediting funds to the user
                $virtualCurrency = new VirtualCurrency($user);
                if (!$virtualCurrency->crediting($rate)) {
                    throw new ErrorException('Could not crediting user');
                }

                // Referral percents bonus
                $keyStorage = Yii::$app->keyStorage;
                $referralPercents = floatval($keyStorage->get('referral_percents'));
                $sourceReferral = $user->sourceReferral;

                if ($referralPercents > 0 && !is_null($sourceReferral)) {

                    $referralVirtualCurrency = new VirtualCurrency($sourceReferral);
                    $referralPercentsAmount = bcmul(bcdiv($rate, 100, $referralVirtualCurrency->scale), $referralPercents, $referralVirtualCurrency->scale);

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
            } catch (ErrorException $e) {
                $transactionDB->rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            \Yii::error([
                'message' => $e->getMessage(),
                'offer_id' => Offer::PTCWALL
            ], 'offer_postback');
        }

        return 'ok';
    }
}