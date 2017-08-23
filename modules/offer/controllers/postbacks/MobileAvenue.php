<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\core\components\ReferralBonus;
use app\modules\core\components\VirtualCurrency;
use app\modules\core\models\Transaction;
use app\modules\offer\models\Offer;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use Yii;

/**
 * Class MobileAvenue
 * @package app\modules\offer\controllers\postbacks
 */
class MobileAvenue extends Action
{
    public $accessHash = 'yj6e5k';

    public function run($access_hash)
    {
        try {

            $userID         = \Yii::$app->request->get('aff_sub');
            $amount         = \Yii::$app->request->get('aff_sub4');
            $leadID         = \Yii::$app->request->get('transaction_id');
            $campaignID     = \Yii::$app->request->get('offer_id');
            $campaignName   = \Yii::$app->request->get('offer_name');

            if (!($user = User::findOne(['id' => $userID]))) {
                throw new ErrorException('Unknown user id: ' . $userID);
            }

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                \Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $amount,
                    $user,
                    null,
                    Offer::MOBILEAVENUE,
                    $leadID,
                    $campaignID,
                    $campaignName
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
                'offer_id' => Offer::MOBILEAVENUE
            ], 'offer_postback');
        }

        \Yii::info([
            'message' => 'MOBILEAVENUE info',
            'offer_id' => Offer::MOBILEAVENUE
        ], 'offer_postback');
        return 'ok';
    }
}