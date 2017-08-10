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
 * Class Kiwiwall
 * @package app\modules\offer\controllers\actions
 */
class Kiwiwall extends Action
{
    public $accessHash = 'f6xdcz';

    public function run($access_hash)
    {
        try {
            // Your secret key can be found in your apps section by clicking on the "Secret Key" button
            $secret_key = 'NGUoWT990bieACDN8xiWkRuXtP6ewmc2';

            // KiwiWall server IP addresses
            $allowed_ips = array(
                '34.193.235.172'
            );

            // Process only requests from KiwiWall IP addresses
            // This is optional validation
            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new ErrorException('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            // Get parameters
            $status = trim($_REQUEST['?status']);   // Unknown leading symbol '?' issue
            $trans_id = $_REQUEST['trans_id'];
            $sub_id = $_REQUEST['sub_id'];
            $sub_id_2 = $_REQUEST['sub_id_2'];
            $gross = $_REQUEST['gross'];
            $amount = $_REQUEST['amount'];
            $offer_id = $_REQUEST['offer_id'];
            $offer_name = $_REQUEST['offer_name'];
            $app_id = $_REQUEST['app_id'];
            $ip_address = $_REQUEST['ip_address'];
            $signature = $_REQUEST['signature'];

            // Create validation signature
            $validation_signature = md5($sub_id . ':' . $amount . ':' . $secret_key);
            if ($signature != $validation_signature) {
                // Signatures not equal - send error code
                throw new ErrorException('Signature validation error: ' . $validation_signature);
            }
            if (!($user = User::findOne(['username' => $sub_id]))) {
                throw new ErrorException('Unknown user: ' . $sub_id);
            }

            $transactionDB = Yii::$app->db->beginTransaction();
            try {

                // Init transaction
                \Yii::$app->transactionCreator->offerIncome(
                    Transaction::STATUS_COMPLETED,
                    $amount,
                    $user,
                    $ip_address,
                    Offer::KIWIWALL,
                    $trans_id,
                    $offer_id,
                    $offer_name
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
                'offer_id' => Offer::KIWIWALL
            ], 'offer_postback');
            return 0;
        }

        return 1;
    }
}