<?php

namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class UserMetaFixture extends ActiveFixture
{
    public $modelClass = 'app\modules\user\models\UserMeta';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
