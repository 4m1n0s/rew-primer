<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use yii\base\Action;
use yii\base\Exception;

/**
 * Class Kiwiwall
 * @package app\modules\offer\controllers\actions
 */
class Kiwiwall extends Action
{
    public $accessHash = 'f6xdcz';

    /**
     * @param $access_hash
     * @return int
     */
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
                throw new Exception('IP not allowed: ' . \Yii::$app->request->getUserIP());
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
                throw new Exception('Signature validation error: ' . $validation_signature);
            }
            
            Transaction::initTransaction(
                $status == 1 ? Transaction::TYPE_OFFER_INCOME : Transaction::TYPE_OFFER_REVERSAL,
                $amount,
                $sub_id,
                $ip_address,
                Transaction::OBJECT_TYPE_KIWIWALL_OFFER,
                $offer_id,
                $offer_name
            );

        } catch (\Exception $e) {
            \Yii::error('Kiwiwall POSTBACK exception' . PHP_EOL . $e->getMessage(), 'offer_postback');
            return 0;
        }

        return 1;
    }
}