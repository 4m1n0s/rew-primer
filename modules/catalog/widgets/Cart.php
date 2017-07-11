<?php

namespace app\modules\catalog\widgets;

use yii\base\Widget;

class Cart extends Widget
{
    public function run()
    {
        return $this->render('cart', [
            'cartCount' => \Yii::$app->cart->getCount()
        ]);
    }
}