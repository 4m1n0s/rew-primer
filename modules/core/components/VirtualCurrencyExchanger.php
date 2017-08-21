<?php

namespace app\modules\core\components;

use Yii;
use yii\base\Object;

/**
 * Class VirtualCurrencyExchanger
 * @package app\modules\core\components
 */
class VirtualCurrencyExchanger extends Object
{
    public $rate;
    public $scale = 2;

    public function init()
    {
        parent::init();
        $this->rate = Yii::$app->keyStorage->get('exchange_rate') ?: 100;
    }

    public function toUSD($value)
    {
        return Yii::$app->formatter->asDecimal(bcdiv($value, $this->rate, $this->scale));
    }

    public function toVC($value)
    {
        return bcmul($value, $this->rate, $this->scale);
    }
}
