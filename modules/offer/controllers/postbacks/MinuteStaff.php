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
 * Class MinuteStaff
 * @package app\modules\offer\controllers\actions
 */
class MinuteStaff extends Action
{
    public $accessHash = 'vqct4j';

    public function run($access_hash)
    {
        try {
            $allowed_ips = ["108.170.27.234", "108.170.27.238", "198.15.95.74", "198.15.113.58"];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new ErrorException('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $notify_id      = intval(\Yii::$app->request->post('notify_id'));
            $app_id         = intval(\Yii::$app->request->post('app_id'));
            $user_id        = preg_replace("/[^a-zA-Z0-9]/", "", \Yii::$app->request->post('user_id'));
            $user_ip        = \Yii::$app->request->post('user_ip');
            $create_time    = intval(\Yii::$app->request->post('create_time'));
            $real_amount    = floatval(\Yii::$app->request->post('real_amount'));
            $credit_amount  = floatval(\Yii::$app->request->post('credit_amount'));
            $retry          = intval(\Yii::$app->request->post('retry'));
            $verify_code    = preg_replace("/[^a-zA-Z0-9]/", "", \Yii::$app->request->post('verify_code'));
            $status         = intval(\Yii::$app->request->post('status'));
            $more_info      = preg_replace("/[^a-zA-Z0-9]/", "", \Yii::$app->request->post('more_info'));

            // Define Notify Code - Grab from Panel
            $notify_code = 'b661fc34f202f5f7';

            // Generate the Verification Code by MD5 Hash
            $generated_verify_code = md5($notify_code . $app_id . $user_id . $notify_id);

            // Insert Entry into Data (for Logging, Duplicate Checking)

            if ($status != 1) {
                throw new ErrorException('Incorrect status: ' . $status);
            }
            if ($verify_code == $generated_verify_code) {
                // Signatures not equal - send error code
                throw new ErrorException('Signature validation error: ' . $generated_verify_code);
            }
            if (!($user = User::findOne(['id' => $user_id]))) {
                throw new ErrorException('Unknown user: ' . $user_id);
            }

            // Credit User Based on credit_amount
            if (($credit_amount > 0) && ($real_amount > 0)) {

                $transactionDB = Yii::$app->db->beginTransaction();
                try {

                    // Init transaction
                    \Yii::$app->transactionCreator->offerIncome(
                        Transaction::STATUS_COMPLETED,
                        $credit_amount,
                        $user,
                        $user_ip,
                        Offer::MINUTESTAFF,
                        $notify_id
                    );

                    // Crediting funds to the user
                    $virtualCurrency = new VirtualCurrency($user);
                    $virtualCurrency->crediting($credit_amount);

                    // Referral percents bonus
                    $keyStorage = Yii::$app->keyStorage;
                    $referralBonus = new ReferralBonus($user);
                    $referralBonus->generalPercents = floatval($keyStorage->get('referral_percents'));
                    $referralBonus->addPercents($credit_amount);

                    $transactionDB->commit();
                } catch (ErrorException $e) {
                    $transactionDB->rollBack();
                    throw $e;
                }

                // Deduct Earning From User
            } else if (($credit_amount < 0) && ($real_amount < 0)) {

                // Issue Warning to User, Can Use "extra_detail" to Provide Additional Info to User.

                // System Notification (Warning), Send User a Message with "extra_detail"
            } else if (($credit_amount == 0.00000) && ($real_amount == 0.00000)) {

            }

        } catch (\Exception $e) {
            \Yii::error([
                'message' => $e->getMessage(),
                'offer_id' => Offer::MINUTESTAFF
            ], 'offer_postback');
            return 0;
        }

        return 1;
    }
}