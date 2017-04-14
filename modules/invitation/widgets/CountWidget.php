<?php

namespace app\modules\invitation\widgets;

use app\modules\invitation\models\search\Invitation;
use yii\base\Widget;

class CountWidget extends Widget
{
    public $status;

    public function run()
    {
        return Invitation::find()->status($this->status)->count() ?: null;
    }
}
