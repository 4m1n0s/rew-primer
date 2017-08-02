<?php

namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = '\app\modules\user\models\User';
    public $depends = ['app\tests\fixtures\RedeemLimitFixture', 'app\tests\fixtures\RedeemLimitIpFixture'];
}


