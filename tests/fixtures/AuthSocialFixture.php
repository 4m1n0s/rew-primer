<?php

namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class AuthSocialFixture extends ActiveFixture
{
    public $modelClass = 'app\modules\user\models\AuthSocial';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
