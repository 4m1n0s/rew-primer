<?php

namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class TokenFixture extends ActiveFixture
{
    public $modelClass = '\app\modules\user\models\Token';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
