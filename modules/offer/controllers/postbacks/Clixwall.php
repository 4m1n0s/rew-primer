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
                \Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $amount,
                    $user,
                    null,
                    Offer::CLIXWALL,
                    null,
                    $CampaignID,
                    $CampaignName
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