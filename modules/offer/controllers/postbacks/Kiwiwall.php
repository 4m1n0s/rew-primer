<?php

namespace app\modules\offer\controllers\postbacks;

use yii\base\Action;

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
            \Yii::info('Kiwiwall POSTBACK', 'offer_postback');

            // Your secret key can be found in your apps section by clicking on the "Secret Key" button
            $secret_key = 'NGUoWT990bieACDN8xiWkRuXtP6ewmc2';

            // KiwiWall server IP addresses
            $allowed_ips = array(
                '34.193.235.172'
            );

            // Proceess only requests from KiwiWall IP addresses
            // This is optional validation
            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                \Yii::info('Kiwiwall POSTBACK __ip_error__ ' . \Yii::$app->request->getUserIP(), 'offer_postback');
                echo 0;
                return;
            }

            // Get parameters
            $status = $_REQUEST['status'];
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
                \Yii::error('Kiwiwall POSTBACK __signature_error__ ' . $validation_signature, 'offer_postback');
                echo 0;
                return;
            }

            echo 1;
        } catch (\Exception $e) {
            \Yii::error('Kiwiwall POSTBACK exception' . json_encode($e), 'offer_postback');
            echo 0;
        }
    }
}