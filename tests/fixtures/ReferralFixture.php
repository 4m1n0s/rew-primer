<?php

namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class ReferralFixture extends ActiveFixture
{
    public $modelClass = '\app\modules\user\models\Referral';
    public $depends = ['app\tests\fixtures\UserMetaFixture'];
}
