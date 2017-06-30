<?php

namespace app\modules\core\components;

use app\modules\offer\models\RedeemLimit;
use app\modules\user\models\User;
use yii\base\Component;
use yii\base\ErrorException;
use yii\base\InvalidConfigException;
use yii\base\InvalidValueException;
use yii\helpers\Json;

/**
 * Class VirtualCurrency
 * @package app\modules\core\components
 */
class VirtualCurrency extends Component
{
    const ERROR_CODE_MIN_REDEEM = 1;
    const ERROR_CODE_MAX_REDEEM = 2;

    /**
     * @var User
     */
    public $user;

    /**
     * @var int
     */
    public $scale = 5;

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

        $value = bcsub($this->user->virtual_currency, $amount, $this->scale);
        $keyStorage = \Yii::$app->keyStorage;

        if (is_null($redeemLimitModel = RedeemLimit::find()->user($this->user)->lastHours((int)$keyStorage->get('redeem.reset'))->one())) {
            $redeemLimitModel = new RedeemLimit();
            $redeemLimitModel->user_id = $this->user->id;
            $redeemLimitModel->amount = $this->getRedeemLimitTotalCurrency($redeemLimitModel, $amount);
            $redeemLimitModel->save();
        } else {
            $redeemLimitModel->amount = $this->getRedeemLimitTotalCurrency($redeemLimitModel, $amount);
            $redeemLimitModel->save();
        }

        // TODO: Handle negative number result
        return $this->updateCurrency($value);
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