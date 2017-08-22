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
use yii\helpers\Json;
use Yii;

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
                '138.197.7.220'
            ];

            if (!in_array(\Yii::$app->request->getUserIP(), $allowed_ips)) {
                throw new ErrorException('IP not allowed: ' . \Yii::$app->request->getUserIP());
            }
            $user_password = '8Kvk0RH1432vJXZKaNS2vYK53VnipL5';
            if ($user_password != $sent_pw) {
                throw new ErrorException('Incorrect password: ' . $sent_pw);
            }
            if (!($user = User::findOne(['username' => $credituser]))) {
                throw new ErrorException('Unknown user: ' . $credituser);
            }

            if ($credited == 1 && $type == 2) {     // CREDIT Transaction, and is rewarding POINTS

                $transactionDB = Yii::$app->db->beginTransaction();
                try {

                    // Init transaction
                    \Yii::$app->transactionCreator->offerIncome(
                        Transaction::STATUS_COMPLETED,
                        $rate,
                        $user,
                        $ip,
                        Offer::PTCWALL,
                        $transactionID,
                        null,
                        $name
                    );

                    // Crediting funds to the user
                    $virtualCurrency = new VirtualCurrency($user);
                    $virtualCurrency->crediting($rate);

                    // Referral percents bonus
                    $keyStorage = Yii::$app->keyStorage;
                    $referralBonus = new ReferralBonus($user);
                    $referralBonus->generalPercents = floatval($keyStorage->get('referral_percents'));
                    $referralBonus->addPercents($rate);

                    $transactionDB->commit();
                } catch (ErrorException $e) {
                    $transactionDB->rollBack();
                    throw $e;
                }
            }

        } catch (\Exception $e) {
            \Yii::error([
                'message' => $e->getMessage(),
                'offer_id' => Offer::PTCWALL
            ], 'offer_postback');
        }

        return 'ok';
    }
}