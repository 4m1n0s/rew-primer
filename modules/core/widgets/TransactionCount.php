<?php

namespace app\modules\core\widgets;

use app\modules\core\models\Transaction;
use yii\base\Widget;

class TransactionCount extends Widget
{
    public $type;

    public function run()
    {
        return Transaction::find()
            ->select('id')
            ->type(Transaction::TYPE_OFFER_INCOME)
            ->user(\Yii::$app->getUser()->getIdentity())
            ->count();
    }
}