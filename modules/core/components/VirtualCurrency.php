<?php

namespace app\modules\core\components;

use app\modules\core\models\RedeemLimit;
use app\modules\core\models\RedeemLimitIp;
use app\modules\user\models\User;
use yii\base\ErrorException;
use yii\base\InvalidConfigException;
use yii\base\InvalidValueException;
use yii\helpers\Json;
use Yii;

/**
 * Class VirtualCurrency
 * @package app\modules\core\components
 */
class VirtualCurrency
{
    const ERROR_CODE_MIN_REDEEM = 1;
    const ERROR_CODE_MAX_REDEEM = 2;
    const ERROR_CODE_INSUFFICIENT_FUNDS = 3;

    public $checkRedemptionCurrencyLimits = true;
    public $checkRedemptionIPLimits = true;

    public $redemptionMinLimit = 100;
    public $redemptionMaxLimit = 500;
    public $redemptionResetHours = 24;

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

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($this->checkRedemptionCurrencyLimits) {
                $this->limitsCurrency($amount);
            }
            if ($this->checkRedemptionIPLimits) {
                $this->limitsIP($amount);
            }

            $value = bcsub($this->user->virtual_currency, $amount, $this->scale);
            if ($value < 0) {
                throw new InvalidValueException('Insufficient funds', static::ERROR_CODE_INSUFFICIENT_FUNDS);
            }
            if (!$this->updateCurrency($value)) {
                throw new ErrorException('Could not update user\'s currency');
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
            Yii::error('Could not save user\'s Virtual Currency value' . PHP_EOL .
                Json::encode($this->user->getErrors())
            );

            return false;
        }

        return true;
    }

    /**
     * @param RedeemLimit|RedeemLimitIp $model
     * @param $amount
     * @return int
     */
    protected function getRedeemLimitTotalCurrency($model, $amount)
    {
        if ($amount < floatval($this->redemptionMinLimit)) {
            throw new InvalidValueException('Min Redeem limit', static::ERROR_CODE_MIN_REDEEM);
        }

        $total = bcadd($model->amount, $amount, $this->scale);
        if ($total > floatval($this->redemptionMaxLimit)) {
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

    /**
     * @param $amount
     * @throws ErrorException
     */
    protected function limitsCurrency($amount)
    {
        if (!is_null($model = RedeemLimit::find()->user($this->user)->lastHours(floatval($this->redemptionResetHours))->one())) {
            $model->amount = $this->getRedeemLimitTotalCurrency($model, $amount);
        } else {
            $model = new RedeemLimit();
            $model->user_id = $this->user->id;
            $model->amount = $this->getRedeemLimitTotalCurrency($model, $amount);
        }
        if (!$model->save()) {
            throw new ErrorException('Could not save ' . RedeemLimit::class . ' model');
        }
    }

    /**
     * @param $amount
     * @throws ErrorException
     */
    protected function limitsIP($amount)
    {
        $ip = Yii::$app->ipNormalizer->getIP();
        if (!is_null($model = RedeemLimitIp::find()->ip($ip)->lastHours(floatval($this->redemptionResetHours))->one())) {
            $model->amount = $this->getRedeemLimitTotalCurrency($model, $amount);
        } else {
            $model = new RedeemLimitIp();
            $model->ip = $ip;
            $model->amount = $this->getRedeemLimitTotalCurrency($model, $amount);
        }
        if (!$model->save()) {
            throw new ErrorException('Could not save ' . RedeemLimitIp::class . ' model');
        }
    }

}