<?php

namespace app\modules\core\models;

use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "{{%ref_transaction_referral}}".
 *
 * @property integer $id
 * @property integer $transaction_id
 * @property integer $user_id
 *
 * @property User $user
 */
class RefTransactionReferral extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_transaction_referral}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'transaction_id'], 'required'],
            [['user_id', 'transaction_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => Yii::t('app', 'User ID'),
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
    public function getTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'transaction_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\modules\core\models\queries\RefTransactionReferralQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\core\models\queries\RefTransactionReferralQuery(get_called_class());
    }
}
