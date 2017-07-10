<?php

namespace app\modules\catalog\widgets;

use yii\base\Widget;

class Cart extends Widget
{
    public function run()
    {
        if (\Yii::$app->user->isGuest) {
            return false;
        }

        return $this->render('cart', [
            'cartCount' => \Yii::$app->cart->getCount()
        ]);
    }
}