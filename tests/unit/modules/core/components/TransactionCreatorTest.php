<?php

use \yii\codeception\DbTestCase;
use \app\modules\core\models\Transaction;
use \app\tests\fixtures\UserFixture;
use \app\modules\offer\models\Offer;
use \app\tests\fixtures\OfferFixture;

class TransactionCreatorTest extends DbTestCase
{
    /**
     * @var UnitTester
     */
    protected $tester;

    protected function _before() {
        \app\modules\core\models\RefTransactionOffer::deleteAll();
        \app\modules\core\models\Transaction::deleteAll();

        \Yii::configure(\Yii::$app, [
            'components' => [
                'transactionCreator' => [
                    'class' => '\app\modules\core\components\TransactionCreator'
                ]
            ]
        ]);

        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
            'offer' => [
                'class' => OfferFixture::className(),
                'dataFile' => codecept_data_dir() . 'offer.php'
            ]
        ]);
    }

    public function testOfferIncome()
    {
        $user = $this->tester->grabFixture('user', 'sf_user');

        $this->assertTrue(Yii::$app->transactionCreator->offerIncome(
            Transaction::STATUS_COMPLETED, 50, $user, null, Offer::ADWORKMEDIA
        ), 'Check offer income null params');

        $this->tester->seeRecord('\app\modules\core\models\RefTransactionOffer', [
            'lead_id' => null,
            'campaign_id' => null,
            'campaign_name' => null,
        ]);

        $this->tester->seeRecord('\app\modules\core\models\Transaction', [
            'type' => Transaction::TYPE_OFFER_INCOME,
            'status' => Transaction::STATUS_COMPLETED,
            'amount' => 50,
            'user_id' => $user->getId(),
            'ip' => null,
            'description' => null,
            'params' => null
        ]);


        $this->assertTrue(Yii::$app->transactionCreator->offerIncome(
            Transaction::STATUS_PENDING, 100, $user, '127.0.0.1', 10, 'test_lead_id', 'test_campaign_id', 'test_campaign_name', 'description', 'params here'
        ), 'Check full params');

        $this->tester->seeRecord('\app\modules\core\models\RefTransactionOffer', [
            'lead_id' => 'test_lead_id',
            'campaign_id' => 'test_campaign_id',
            'campaign_name' => 'test_campaign_name',
        ]);

        $this->tester->seeRecord('\app\modules\core\models\Transaction', [
            'type' => Transaction::TYPE_OFFER_INCOME,
            'status' => Transaction::STATUS_PENDING,
            'amount' => 100,
            'user_id' => $user->getId(),
            'ip' => '127.0.0.1',
            'description' => 'description',
            'params' => 'params here'
        ]);
    }
}