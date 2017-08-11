<?php

namespace app\modules\user\forms;

use yii\base\Model;
use Yii;

class RedeemForm extends Model
{
    public $amount;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['amount', 'number', 'min' => 1]
        ];
    }

    public function attributeLabels()
    {
        return [
            'amount' => Yii::t('user', 'Amount'),
        ];
    }
}