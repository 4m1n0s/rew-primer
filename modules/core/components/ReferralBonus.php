<?php

namespace app\modules\core\components;

use app\modules\core\models\EmailTemplate;
use app\modules\core\models\Transaction;
use app\modules\user\models\User;
use Yii;
use yii\base\ErrorException;
use yii\helpers\Json;

/**
 * Class ReferralBonus
 * @package app\modules\core\components
 */
class ReferralBonus
{
    /**
     * @var User
     */
    protected $user;
    /**
     * @var double
     */
    public $generalPercents;
    /**
     * @var double
     */
    public $generalRegisterValue;


    public function __construct(User $user)
    {
        $this->setUser($user);
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * Add certain percents to user's referral
     *
     * @param $sum
     * @return boolean
     * @throws ErrorException
     * @throws \yii\base\InvalidConfigException
     */
    public function addPercents($sum)
    {
        $sourceReferral = $this->user->sourceReferral;
        if (is_null($sourceReferral)) {
            return false;
        }
        $sourceReferralVC = new VirtualCurrency($sourceReferral);
        if ($sourceReferral->role == User::ROLE_PARTNER) {
            $referralPercentsAmount = bcmul(bcdiv($sum, 100, $sourceReferralVC->scale), $sourceReferral->getReferralPercents(), $sourceReferralVC->scale);
        } else {
            $referralPercentsAmount = bcmul(bcdiv($sum, 100, $sourceReferralVC->scale), $this->generalPercents, $sourceReferralVC->scale);
        }
        if ($referralPercentsAmount <= 0) {
            return false;
        }

        $sourceReferralVC->crediting($referralPercentsAmount);
        \Yii::$app->transactionCreator->referralIncome(
            Transaction::STATUS_COMPLETED,
            $referralPercentsAmount,
            $sourceReferral,
            null,
            $this->user,
            'percents'
        );

        return true;
    }

    /**
     * Add one time bonus to user's referral on user registration
     *
     * @return bool
     * @throws \yii\db\Exception
     */
    public function addRegisterValue()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $sourceReferral = $this->user->sourceReferral;

            if (!is_null($sourceReferral)) {

                if ($sourceReferral->role == User::ROLE_PARTNER && $sourceReferral->getReferralRegisterValue() > 0) {
                    $amount = floatval($sourceReferral->getReferralRegisterValue());
                    $referralPercents = floatval($sourceReferral->getReferralPercents());

                    $sourceReferralVC = new VirtualCurrency($sourceReferral);
                    $sourceReferralVC->crediting($amount);
                    \Yii::$app->transactionCreator->referralIncome(
                        Transaction::STATUS_COMPLETED,
                        $amount,
                        $sourceReferral,
                        null,
                        $this->user,
                        'register value'
                    );
                } else {
                    $referralPercents = floatval($this->generalPercents);
                }

                if ($referralPercents > 0) {
                    $mailContainer = Yii::$app->mailContainer;
                    $mailContainer->addToQueue(
                        $sourceReferral->email,
                        EmailTemplate::TEMPLATE_REGISTER_REFERRAL_BONUS, [
                        'source_username' => $sourceReferral->username,
                        'target_username' => $this->user->username,
                        'referral_percents' => $referralPercents
                    ]);
                }
            }

            if ($this->generalRegisterValue > 0) {
                $userVC = new VirtualCurrency($this->user);
                $userVC->crediting($this->generalRegisterValue);
            }

            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::error('Referral Percents' . PHP_EOL . Json::encode($e->getMessage()), 'transaction');
            return false;
        }
    }
}
