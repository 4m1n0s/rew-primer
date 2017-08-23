<?php

namespace app\modules\catalog\widgets;

use app\modules\offer\models\LogPostback;
use yii\base\Widget;

class LogPostbackCount extends Widget
{
    public function run()
    {
        return LogPostback::find()->count();
    }
}