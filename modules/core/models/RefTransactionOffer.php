<?php

namespace app\modules\core\models;

use app\modules\offer\models\Offer;
use Yii;

/**
 * This is the model class for table "{{%ref_transaction_offer}}".
 *
 * @property integer $id
 * @property integer $transaction_id
 * @property integer $offer_id
 * @property string $lead_id
 * @property string $campaign_id
 * @property string $campaign_name
 *
 * @property Offer $offer
 * @property Transaction $transaction
 */
class RefTransactionOffer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_transaction_offer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_id', 'offer_id'], 'integer'],
            [['transaction_id', 'offer_id'], 'required'],
            [['lead_id', 'campaign_id'], 'string', 'max' => 64],
            [['campaign_name'], 'string', 'max' => 128],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['offer_id' => 'id']],
            [['transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['transaction_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'offer_id' => Yii::t('app', 'Offer ID'),
            'lead_id' => Yii::t('app', 'Lead ID'),
            'campaign_id' => Yii::t('app', 'Campaign ID'),
            'campaign_name' => Yii::t('app', 'Campaign Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offer::className(), ['id' => 'offer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'transaction_id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\core\models\queries\RefTransactionOfferQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\core\models\queries\RefTransactionOfferQuery(get_called_class());
    }
}
