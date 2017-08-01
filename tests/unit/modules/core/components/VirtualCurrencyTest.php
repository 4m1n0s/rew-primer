<?php

namespace app\tests\modules\core\components;

use app\modules\core\components\VirtualCurrency;
use app\modules\user\models\User;
use app\tests\fixtures\UserFixture;

class VirtualCurrencyTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;
    /**
     * @var User $user
     */
    public $user;

    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
        ]);

        $this->user = User::find()->where(['username' => 'admin'])->one();
    }

    public function testCrediting()
    {
        $vc = new VirtualCurrency($this->user);
        self::assertTrue($vc->crediting(12.00001));
        self::assertTrue($this->user->virtual_currency === number_format(12.00001, 5));
        self::assertTrue($vc->crediting(12.12345));
        self::assertTrue($this->user->virtual_currency === number_format(24.12346, 5));
    }
}