<?php

namespace app\modules\core\models;

use app\modules\offer\models\Offer;
use app\modules\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%transaction}}".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $status
 * @property string $amount
 * @property integer $user_id
 * @property string $ip
 * @property string $description
 * @property string $params
 * @property integer $created_at
 *
 * @property User $user
 * @property RefTransactionOffer $refOffer
 * @property RefTransactionReferral $refReferral
 */
class Transaction extends \yii\db\ActiveRecord
{
    const TYPE_OFFER_INCOME         = 1;
    const TYPE_REFERRAL_PERCENTS    = 2;
    const TYPE_REDEEM               = 3;

    const STATUS_PENDING    = 1;
    const STATUS_COMPLETED  = 2;
    const STATUS_REVERSED   = 3;
    const STATUS_DELETED    = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transaction}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'user_id'], 'required'],
            [['type', 'status', 'user_id', 'created_at'], 'integer'],
            [['amount'], 'number'],
            [['params'], 'string'],
            [['ip'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'amount' => Yii::t('app', 'Amount'),
            'user_id' => Yii::t('app', 'User ID'),
            'ip' => Yii::t('app', 'Ip'),
            'description' => Yii::t('app', 'Description'),
            'params' => Yii::t('app', 'Params'),
            'created_at' => Yii::t('app', 'Created At'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefOffer()
    {
        return $this->hasOne(RefTransactionOffer::className(), ['transaction_id' => 'id']);
    }

    public function getOffer()
    {
        return $this->hasOne(Offer::class, ['id' => 'offer_id'])
            ->viaTable(RefTransactionOffer::tableName(), ['transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefReferral()
    {
        return $this->hasOne(RefTransactionReferral::className(), ['transaction_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\core\models\queries\TransactionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\core\models\queries\TransactionQuery(get_called_class());
    }
}
