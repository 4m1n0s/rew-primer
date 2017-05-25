<?php

namespace app\modules\offer\controllers\postbacks;

use app\modules\offer\models\Transaction;
use app\modules\user\models\User;
use yii\base\Action;
use yii\base\DynamicModel;
use yii\base\ErrorException;
use yii\base\Exception;

/**
 * Class OfferToro
 * @package app\modules\offer\controllers\actions
 */
class Fyber extends Action
{
    public $accessHash = '7d60ar';

    public function run($access_hash)
    {
        try {

            echo \Yii::$app->security->generateRandomString(6);

            $model = new DynamicModel(['ip_address']);
            $model->addRule('ip_address', 'ip', ['ranges' => ['146.0.239.0/24']]);
            $model->setAttributes(['ip_address' => \Yii::$app->request->getUserIP()]);

            if (!$model->validate()) {
                throw new Exception('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }

            $amount     = \Yii::$app->request->get('amount');
            $user_id    = \Yii::$app->request->get('uid');
            $sid        = \Yii::$app->request->get('sid');
            $tid        = \Yii::$app->request->get('_trans_id_');

            $security_token = '41508e961a87308e0bebfb259b113a83';
            $sha1_of_important_data = sha1($security_token . $user_id . $amount . $tid);

            if ($sid != $sha1_of_important_data) {
                throw new Exception('Signature validation error: ' . $sha1_of_important_data);
            }

            if (!($user = User::findOne(['id' => $user_id]))) {
                throw new Exception('Unknown user: ' . $user_id);
            }

            Transaction::initTransaction(
                Transaction::TYPE_OFFER_INCOME,
                Transaction::STATUS_COMPLETE,
                $amount,
                $user->id,
                null,
                Transaction::OBJECT_TYPE_FYBER_OFFER,
                null,
                $tid
            );

            $virtualCurrency = \Yii::$app->virtualCurrency;
            $virtualCurrency->setUser($user);

            if (!$virtualCurrency->crediting($amount)) {
                throw new ErrorException('Could not crediting user');
            }

        } catch (\Exception $e) {
            \Yii::error('Fyber POSTBACK exception' . PHP_EOL . $e->getMessage(), 'offer_postback');
        }
    }
}