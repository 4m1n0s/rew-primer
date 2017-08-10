<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\core\components\ReferralBonus;
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

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                \Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $new,
                    $user,
                    null,
                    Offer::SUPERREWARDS,
                    $id,
                    $oid
                );

                // Crediting funds to the user
                $virtualCurrency = new VirtualCurrency($user);
                $virtualCurrency->crediting($new);

                // Referral percents bonus
                $keyStorage = Yii::$app->keyStorage;
                $referralBonus = new ReferralBonus($user);
                $referralBonus->generalPercents = floatval($keyStorage->get('referral_percents'));
                $referralBonus->addPercents($new);

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