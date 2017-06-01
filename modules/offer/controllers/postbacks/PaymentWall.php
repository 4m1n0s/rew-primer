<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use yii\base\Exception;

/**
 * Class PaymentWall
 * @package app\modules\offer\controllers\postbacks
 */
class PaymentWall extends Action
{
    public $accessHash = 'vxbowb';

    public function run()
    {
        try {
            $transaction_id     = urldecode(\Yii::$app->request->get('ref'));
            $userID             = urldecode(\Yii::$app->request->get('uid'));
            $amount             = intval(\Yii::$app->request->get('currency'));
            $type               = intval(\Yii::$app->request->get('type'));
            $signature          = urldecode(\Yii::$app->request->get('sig'));

            $secretKey = '69c1a56a1f6cb9264333d258ab55a37d';

            //Check the signature
            $my_signature = md5('uid=' . $userID . 'currency=' . $amount . 'type=' . $type . 'ref=' . $transaction_id . $secretKey);

            if ($my_signature != trim($signature)) {
                //Signatures don't match
                throw new Exception('Signature validation error: ' . $my_signature);
            }

            if (!($user = User::findOne(['id' => $userID]))) {
                throw new Exception('Unknown user: ' . $userID);
            }

            Transaction::initTransaction(
                Transaction::TYPE_OFFER_INCOME,
                Transaction::STATUS_COMPLETE,
                $amount,
                $user->id,
                null,
                Transaction::OBJECT_TYPE_PAYMENTWALL_OFFER,
                null,
                $transaction_id,
                null
            );

            $virtualCurrency = \Yii::$app->virtualCurrency;
            $virtualCurrency->setUser($user);

            if (!$virtualCurrency->crediting($amount)) {
                throw new ErrorException('Could not crediting user');
            }

        } catch (\Exception $e) {
            \Yii::error('PaymentWall POSTBACK exception' . PHP_EOL . $e->getMessage(), 'offer_postback');
            return 0;
        }

        return 'OK';
    }
}