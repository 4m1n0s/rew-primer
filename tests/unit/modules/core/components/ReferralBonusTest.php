<?php

namespace app\tests\modules\core\components;

use app\modules\core\components\ReferralBonus;
use app\modules\core\models\RefTransactionOffer;
use app\modules\core\models\RefTransactionReferral;
use app\modules\core\models\Transaction;
use app\tests\fixtures\ReferralFixture;
use app\tests\fixtures\UserFixture;
use app\tests\fixtures\UserMetaFixture;

class ReferralBonusTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function _before()
    {
        RefTransactionReferral::deleteAll();
        RefTransactionOffer::deleteAll();
        Transaction::deleteAll();

        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
            'userMeta' => [
                'class' => UserMetaFixture::class,
                'dataFile' => codecept_data_dir() . 'user_meta.php'
            ],
            'referral' => [
                'class' => ReferralFixture::class,
                'dataFile' => codecept_data_dir() . 'referral.php'
            ]
        ]);

        \Yii::configure(\Yii::$app, [
            'components' => [
                'transactionCreator' => [
                    'class' => '\app\modules\core\components\TransactionCreator'
                ]
            ]
        ]);
    }

    public function testPercentsHaveAffiliate()
    {
        $user = $this->tester->grabFixture('user', 'sf_user');

        $bonus = new ReferralBonus($user);
        self::assertTrue($bonus->addPercents(100));

        $this->tester->seeRecord('\app\modules\user\models\User', [
            'id' => 5,
            'virtual_currency' => '20.00000'
        ]);

        $transactionModel = $this->tester->grabRecord('\app\modules\core\models\Transaction', [
            'type' => Transaction::TYPE_REFERRAL_BONUS,
            'status' => Transaction::STATUS_COMPLETED,
            'amount' => 20,
            'user_id' => 5,
        ]);

        $this->tester->seeRecord('\app\modules\core\models\RefTransactionReferral', [
            'transaction_id' => $transactionModel->id,
            'user_id' => $user->id,
        ]);
    }

    public function testPercentsHaveReferral()
    {
        $user = $this->tester->grabFixture('user', 'simple_user_1');

        $bonus = new ReferralBonus($user);
        $bonus->generalPercents = 10;
        self::assertTrue($bonus->addPercents(100));

        $this->tester->seeRecord('\app\modules\user\models\User', [
            'id' => 1,
            'virtual_currency' => '10.00000'
        ]);

        $transactionModel = $this->tester->grabRecord('\app\modules\core\models\Transaction', [
            'type' => Transaction::TYPE_REFERRAL_BONUS,
            'status' => Transaction::STATUS_COMPLETED,
            'amount' => 10,
            'user_id' => 1,
        ]);

        $this->tester->seeRecord('\app\modules\core\models\RefTransactionReferral', [
            'transaction_id' => $transactionModel->id,
            'user_id' => $user->id,
        ]);
    }

    public function testPercentsNotHaveReferral()
    {
        $user = $this->tester->grabFixture('user', 'admin');

        $bonus = new ReferralBonus($user);
        $bonus->generalPercents = 10;
        self::assertFalse($bonus->addPercents(100));
    }
}