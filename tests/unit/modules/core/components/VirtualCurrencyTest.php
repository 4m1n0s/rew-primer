<?php

namespace app\tests\modules\core\components;

use app\modules\core\components\IPNormalizer;
use app\modules\core\components\VirtualCurrency;
use app\tests\fixtures\RedeemLimitFixture;
use app\tests\fixtures\RedeemLimitIpFixture;
use app\tests\fixtures\UserFixture;

class VirtualCurrencyTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
        ]);

        \Yii::configure(\Yii::$app, [
            'components' => [
                'ipNormalizer' => [
                    'class' => IPNormalizer::class
                ]
            ],
        ]);
    }

    public function testCrediting()
    {
        $user = $this->tester->grabFixture('user', 'admin');

        $vc = new VirtualCurrency($user);
        self::assertTrue($vc->crediting(12.00001));
        self::assertEquals($user->virtual_currency, 12.00001);
        self::assertTrue($vc->crediting(12.12345));
        self::assertEquals($user->virtual_currency, 24.12346);
    }

    public function testDebiting()
    {
        $user = $this->tester->grabFixture('user', 'sf_user');

        $virtualCurrency = new VirtualCurrency($user);
        $virtualCurrency->redemptionMaxLimit = 100;
        $virtualCurrency->redemptionMinLimit = 20;

        $amount = '50';
        $this->assertTrue($virtualCurrency->debiting($amount));
        $this->assertEquals(55, $user->virtual_currency);
    }

    /**
     * @expectedException \yii\base\InvalidValueException
     * @expectedExceptionCode app\modules\core\components\VirtualCurrency::ERROR_CODE_MIN_REDEEM
     */
    public function testRedemptionMinLimit()
    {
        $user = $this->tester->grabFixture('user', 'sf_user');

        $virtualCurrency = new VirtualCurrency($user);
        $virtualCurrency->redemptionMaxLimit = 100;
        $virtualCurrency->redemptionMinLimit = 20;

        $virtualCurrency->debiting(19);

    }

    /**
     * @expectedException \yii\base\InvalidValueException
     * @expectedExceptionCode app\modules\core\components\VirtualCurrency::ERROR_CODE_MAX_REDEEM
     */
    public function testRedemptionMaxLimit()
    {
        $user = $this->tester->grabFixture('user', 'sf_user');

        $virtualCurrency = new VirtualCurrency($user);
        $virtualCurrency->redemptionMaxLimit = 100;
        $virtualCurrency->redemptionMinLimit = 20;

        $virtualCurrency->debiting(101);
    }

    /**
     * @expectedException \yii\base\InvalidValueException
     * @expectedExceptionCode app\modules\core\components\VirtualCurrency::ERROR_CODE_MAX_REDEEM
     */
    public function testIpLimit()
    {
        $this->tester->haveFixtures([
            'redeem_limit_ip' => [
                'class' => RedeemLimitIpFixture::class,
                'dataFile' => codecept_data_dir() . 'redeem_limit_ip.php'
            ]
        ]);

        $user = $this->tester->grabFixture('user', 'sf_user');

        $virtualCurrency = new VirtualCurrency($user);
        $virtualCurrency->redemptionMaxLimit = 100;
        $virtualCurrency->redemptionMinLimit = 20;

        $virtualCurrency->debiting(21);
    }

    /**
     * @expectedException \yii\base\InvalidValueException
     * @expectedExceptionCode app\modules\core\components\VirtualCurrency::ERROR_CODE_MAX_REDEEM
     */
    public function testCurrencyLimit()
    {
        $this->tester->haveFixtures([
            'redeem_limit' => [
                'class' => RedeemLimitFixture::class,
                'dataFile' => codecept_data_dir() . 'redeem_limit.php'
            ]
        ]);

        $user = $this->tester->grabFixture('user', 'sf_user');

        $virtualCurrency = new VirtualCurrency($user);
        $virtualCurrency->redemptionMaxLimit = 100;
        $virtualCurrency->redemptionMinLimit = 20;

        $virtualCurrency->debiting(21);
    }

}