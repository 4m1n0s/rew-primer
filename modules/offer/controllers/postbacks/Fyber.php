<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\core\components\VirtualCurrency;
use app\modules\core\models\RefTransactionOffer;
use app\modules\offer\models\Offer;
use app\modules\core\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\DynamicModel;
use yii\base\ErrorException;
use Yii;

/**
 * Class Fyber
 * @package app\modules\offer\controllers\actions
 */
class Fyber extends Action
{
    public $accessHash = '7d60ar';

    public function run($access_hash)
    {

        $transaction = \Yii::$app->db->beginTransaction();

        try {

            $model = new DynamicModel(['ip_address']);
            $model->addRule('ip_address', 'ip', ['ranges' => ['146.0.239.0/24']]);
            $model->setAttributes(['ip_address' => \Yii::$app->request->getUserIP()]);

            if (!$model->validate()) {
                throw new ErrorException('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $amount     = \Yii::$app->request->get('amount');
            $user_id    = \Yii::$app->request->get('uid');
            $sid        = \Yii::$app->request->get('sid');
            $tid        = \Yii::$app->request->get('_trans_id_');

            $security_token = '41508e961a87308e0bebfb259b113a83';
            $sha1_of_important_data = sha1($security_token . $user_id . $amount . $tid);

            if ($sid != $sha1_of_important_data) {
                throw new ErrorException('Signature validation error: ' . $sha1_of_important_data);
            }
            if (!($user = User::findOne(['id' => $user_id]))) {
                throw new ErrorException('Unknown user: ' . $user_id);
            }
            if ($transactionOffer = RefTransactionOffer::find()->select(['id'])->lead($tid, Offer::FYBER)->one()) {
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
                    Offer::FYBER,
                    $tid
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

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::error([
                'message' => $e->getMessage(),
                'offer_id' => Offer::FYBER
            ], 'offer_postback');
        }
    }
}