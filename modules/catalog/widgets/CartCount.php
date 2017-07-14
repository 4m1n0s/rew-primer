<?php

namespace app\modules\catalog\widgets;

use yii\base\Widget;

class CartCount extends Widget
{
    public function run()
    {
        return \Yii::t('app', '{n, plural, =1{# Item} other{# Items}}', [
            'n' => \Yii::$app->cart->getCount(),
        ]);
    }
}