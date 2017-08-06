<?php

namespace app\modules\catalog\widgets;

use app\modules\catalog\models\Order;
use yii\base\Widget;

class OrderCount extends Widget
{
    public $status;

    public function run()
    {
        return Order::find()->status($this->status)->count();
    }
}