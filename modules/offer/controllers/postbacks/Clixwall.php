<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use yii\base\Exception;

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
                throw new Exception('Unknown user: ' . $username);
            }

            Transaction::initTransaction(
                Transaction::TYPE_OFFER_INCOME,
                Transaction::STATUS_COMPLETE,
                $amount,
                $user->id,
                null,
                Transaction::OBJECT_TYPE_CLIXWALL_OFFER,
                $CampaignID,
                null,
                $CampaignName
            );

        } catch (Exception $e) {
            \Yii::error('Clixwall POSTBACK exception' . PHP_EOL . $e->getMessage(), 'offer_postback');
        }

        return 'done';
    }
}