<?php

namespace app\modules\contact\form;

use yii\base\Model;

class Reply extends Model
{
    public $message;

    public function rules()
    {
        return [
            ['message', 'string'],
            ['message', 'required']
        ];
    }
}