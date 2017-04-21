<?php

namespace app\modules\contact\widgets;

use app\modules\contact\models\Contact;
use yii\base\Widget;

class CountWidget extends Widget
{
    public $status;

    public function run()
    {
        return Contact::find()->status($this->status)->count() ?: null;
    }
}
