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
 * Class Clixwall
 * @package app\modules\offer\controllers\actions
 */
class Clixwall extends Action
{
    public $accessHash = 'egkum8';

    public function run($access_hash)
    {
        try {
            $secret_password = 'H5H5D-6PWNL-PSD69';

            $password       = \Yii::$app->request->get('pwd');
            $amount         = \Yii::$app->request->get('c');
            $username       = trim(\Yii::$app->request->get('u'));
            $type           = trim(\Yii::$app->request->get('t'));
            $status         = trim(\Yii::$app->request->get('s'));
            $CampaignID     = trim(\Yii::$app->request->get('sid'));
            $CampaignName   = trim(\Yii::$app->request->get('cname'));

            if ($password != $secret_password) {
                throw new ErrorException('Incorrect password: ' . $password);
            }
            if ($status != 1) {
                throw new ErrorException('Incorrect status: ' . $status);
            }
            if (!($user = User::findOne(['username' => $username]))) {
                throw new ErrorException('Unknown user: ' . $username);
            }

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                if (!\Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $amount,
                    $user,
                    null,
                    Offer::CLIXWALL,
                    null,
                    $CampaignID,
                    $CampaignName
                )) {
                    throw new ErrorException('Could not save offer transaction');
                }

                // Crediting funds to the user
                $virtualCurrency = new VirtualCurrency($user);
                if (!$virtualCurrency->crediting($amount)) {
                    throw new ErrorException('User\'s funds have not been credited');
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
            } catch (\Exception $e) {
                $transactionDB->rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            \Yii::error([
                'message' => $e->getMessage(),
                'offer_id' => Offer::CLIXWALL
            ], 'offer_postback');
        }

        return 'done';
    }
}