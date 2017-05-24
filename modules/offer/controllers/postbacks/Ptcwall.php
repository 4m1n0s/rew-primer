<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\helpers\Json;

/**
 * Class Ptcwall
 * @package app\modules\offer\controllers\actions
 */
class Ptcwall extends Action
{
    public $accessHash = '57oeou';

    public function run($access_hash)
    {
        try {

            $sent_pw        = \Yii::$app->request->get('pwd');
            $credited       = intval(\Yii::$app->request->get('c'));
            $credituser     = trim(\Yii::$app->request->get('usr'));
            $rate           = trim(\Yii::$app->request->get('r'));
            $type           = intval(\Yii::$app->request->get('t'));
            $name           = trim(\Yii::$app->request->get('none'));
            $ip             = trim(\Yii::$app->request->get('userip'));
            $transactionID  = trim(\Yii::$app->request->get('tid'));

            $allowed_ips = [
                '199.193.247.113'
            ];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new Exception('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $user_password = '8Kvk0RH1432vJXZKaNS2vYK53VnipL5';

            if ($user_password != $sent_pw) {
                throw new Exception('Incorrect password: ' . $sent_pw);
            }

            if (!($user = User::findOne(['username' => $credituser]))) {
                throw new Exception('Unknown user: ' . $credituser);
            }

            Transaction::initTransaction(
                Transaction::TYPE_OFFER_INCOME,
                $credited == 1 ? Transaction::STATUS_COMPLETE : Transaction::STATUS_REVERSED,
                $rate,
                $user->id,
                $ip,
                Transaction::OBJECT_TYPE_PTCWALL_OFFER,
                null,
                $transactionID,
                $name,
                null,
                Json::encode(\Yii::$app->request->getQueryParams())
            );

            $virtualCurrency = \Yii::$app->virtualCurrency;
            $virtualCurrency->setUser($user);

            if (!$virtualCurrency->crediting($rate)) {
                throw new ErrorException('Could not crediting user');
            }

        } catch (\Exception $e) {
            \Yii::error('Ptcwall POSTBACK exception' . PHP_EOL . $e->getMessage(), 'offer_postback');
        }

        return 'ok';
    }
}