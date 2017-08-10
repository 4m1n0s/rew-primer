<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\core\components\ReferralBonus;
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

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                \Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $amount,
                    $user,
                    null,
                    Offer::FYBER,
                    $tid
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