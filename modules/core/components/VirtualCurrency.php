<?php

namespace app\modules\core\components;

use app\modules\user\models\User;
use yii\base\Component;
use yii\base\ErrorException;
use yii\base\InvalidConfigException;
use yii\helpers\Json;

/**
 * Class VirtualCurrency
 * @package app\modules\core\components
 */
class VirtualCurrency extends Component
{
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