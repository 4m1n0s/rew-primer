<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\core\components\ReferralBonus;
use app\modules\core\components\VirtualCurrency;
use app\modules\offer\models\Offer;
use app\modules\core\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use Yii;

/**
 * Class Dryverlessads
 * @package app\modules\offer\controllers\actions
 */
class Dryverlessads extends Action
{
    public $accessHash = 'rvdkcz';

    public function run($access_hash)
    {
        try {
            $allowed_ips = [
                '40.118.255.137',
                '40.118.255.231',
                '40.118.250.218',
                '40.118.252.35',
            ];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new ErrorException('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $apiKey = 'b9b8239e6f5045ac905f2f9b65b65b27';

            $subID         = \Yii::$app->request->get('subid');
            $payout         = \Yii::$app->request->get('payout');     // Custom currency
            $country        = \Yii::$app->request->get('country');     // Country code
            $leadID         = \Yii::$app->request->get('tid');
            $campaignID     = \Yii::$app->request->get('id');
            $campaignName   = \Yii::$app->request->get('name');
            $status         = \Yii::$app->request->get('status');
            $cs             = \Yii::$app->request->get('hash');

            if (!($user = User::findOne(['id' => $subID]))) {
                throw new ErrorException('Unknown user id: ' . $subID);
            }
            if ($status != 1) {
                throw new ErrorException('Wrong status ' . $status);
            }

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                \Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $payout,
                    $user,
                    null,
                    Offer::DRYVERLESSADS,
                    $leadID,
                    $campaignID,
                    $campaignName
                );

                // Crediting funds to the user
                $virtualCurrency = new VirtualCurrency($user);
                $virtualCurrency->crediting($payout);

                // Referral percents bonus
                $keyStorage = Yii::$app->keyStorage;
                $referralBonus = new ReferralBonus($user);
                $referralBonus->generalPercents = floatval($keyStorage->get('referral_percents'));
                $referralBonus->addPercents($payout);

                $transactionDB->commit();
            } catch (ErrorException $e) {
                $transactionDB->rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            \Yii::error([
                'message' => $e->getMessage(),
                'offer_id' => Offer::DRYVERLESSADS
            ], 'offer_postback');
        }

        \Yii::info([
            'message' => 'Dryverlessads info',
            'offer_id' => Offer::DRYVERLESSADS
        ], 'offer_postback');
    }
}