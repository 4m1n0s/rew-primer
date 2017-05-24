<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use yii\base\Exception;

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
                throw new Exception('IP not allowed: ' . \Yii::$app->request->getUserIP());
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

            if ($verify_code == $generated_verify_code) {
                // Signatures not equal - send error code
                throw new Exception('Signature validation error: ' . $generated_verify_code);
            }

            if (!($user = User::findOne(['id' => $user_id]))) {
                throw new Exception('Unknown user: ' . $user_id);
            }

            if ($transaction = Transaction::find()->select(['id'])->lead($notify_id, Transaction::OBJECT_TYPE_MINUTESTAFF_OFFER)->one()) {
                throw new Exception('Transaction already exist: ' . $transaction->id);
            }

            // Credit User Based on credit_amount
            if (($credit_amount > 0) && ($real_amount > 0)) {

                Transaction::initTransaction(
                    Transaction::TYPE_OFFER_INCOME,
                    $status == 1 ? Transaction::STATUS_COMPLETE : Transaction::STATUS_REVERSED,
                    $credit_amount,
                    $user->id,
                    $user_ip,
                    Transaction::OBJECT_TYPE_MINUTESTAFF_OFFER,
                    null,
                    $notify_id
                );

                $virtualCurrency = \Yii::$app->virtualCurrency;
                $virtualCurrency->setUser($user);

                if (!$virtualCurrency->crediting($credit_amount)) {
                    throw new ErrorException('Could not crediting user');
                }

                // Deduct Earning From User
            } else if (($credit_amount < 0) && ($real_amount < 0)) {

                // Issue Warning to User, Can Use "extra_detail" to Provide Additional Info to User.

                // System Notification (Warning), Send User a Message with "extra_detail"
            } else if (($credit_amount == 0.00000) && ($real_amount == 0.00000)) {

            }

        } catch (\Exception $e) {
            \Yii::error('MinuteStaff POSTBACK exception' . PHP_EOL . $e->getMessage(), 'offer_postback');
            return 0;
        }

        return 1;
    }
}