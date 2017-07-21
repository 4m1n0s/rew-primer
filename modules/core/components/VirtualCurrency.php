<?php

namespace app\modules\core\components;

use app\modules\offer\models\RedeemLimit;
use app\modules\user\models\User;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\base\InvalidValueException;
use yii\helpers\Json;

/**
 * Class VirtualCurrency
 * @package app\modules\core\components
 */
class VirtualCurrency
{
    const ERROR_CODE_MIN_REDEEM = 1;
    const ERROR_CODE_MAX_REDEEM = 2;
    const ERROR_CODE_INSUFFICIENT_FUNDS = 3;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var int
     */
    public $scale = 5;

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
     * Crediting funds to user
     *
     * @param $amount
     * @return bool
     * @throws InvalidConfigException
     */
    public function crediting($amount)
    {
        if (!$this->isValidUser()) {
            throw new InvalidConfigException('User Model must be set');
        }

        $value = bcadd($this->user->virtual_currency, $amount, $this->scale);
        return $this->updateCurrency($value);
    }

    /**
     * Debiting funds from user
     *
     * @param $amount
     * @return bool
     * @throws InvalidConfigException
     */
    public function debiting($amount)
    {
        if (!$this->isValidUser()) {
            throw new InvalidConfigException('User Model must be set');
        }

        $keyStorage = \Yii::$app->keyStorage;
        $transaction = \Yii::$app->db->beginTransaction();

        try {
            $resetTime = (int)$keyStorage->get('redeem.reset') ?: '24';
            if (!is_null($redeemLimitModel = RedeemLimit::find()->user($this->user)->lastHours($resetTime)->one())) {
                $redeemLimitModel->amount = $this->getRedeemLimitTotalCurrency($redeemLimitModel, $amount);
            } else {
                $redeemLimitModel = new RedeemLimit();
                $redeemLimitModel->user_id = $this->user->id;
                $redeemLimitModel->amount = $this->getRedeemLimitTotalCurrency($redeemLimitModel, $amount);
            }
            if (!$redeemLimitModel->save()) {
                throw new Exception('Could not save ' . RedeemLimit::class . ' model');
            }

            $value = bcsub($this->user->virtual_currency, $amount, $this->scale);
            if ($value < 0) {
                throw new InvalidValueException('Insufficient funds', static::ERROR_CODE_INSUFFICIENT_FUNDS);
            }
            if (!$this->updateCurrency($value)) {
                throw new Exception('Could not update user\'s currency');
            }

            $transaction->commit();
            return true;
        } catch (InvalidValueException $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    /**
     * @param $value
     * @return bool
     * @throws ErrorException
     */
    protected function updateCurrency($value)
    {
        $this->user->setScenario(User::SCENARIO_UPDATE_CURRENCY);
        $this->user->virtual_currency = $value;

        if (!$this->user->save()) {
            \Yii::error('Could not save user\'s Virtual Currency value' . PHP_EOL .
                Json::encode($this->user->getErrors())
            );

            return false;
        }

        return true;
    }

    /**
     * @param RedeemLimit $model
     * @param $amount
     * @return int
     */
    protected function getRedeemLimitTotalCurrency(RedeemLimit $model, $amount)
    {
        $keyStorage = \Yii::$app->keyStorage;

        if ($amount < $keyStorage->get('redeem.minLimit')) {
            throw new InvalidValueException('Min Redeem limit', static::ERROR_CODE_MIN_REDEEM);
        }

        $total = bcadd($model->amount, $amount, $this->scale);

        if ($total > $keyStorage->get('redeem.maxLimit')) {
            throw new InvalidValueException('Max Redeem limit', static::ERROR_CODE_MAX_REDEEM);
        }

        return $total;
    }

    /**
     * @return bool
     */
    protected function isValidUser()
    {
        if (!$this->user instanceof User) {
            return false;
        }

        return true;
    }
}