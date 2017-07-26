<?php

namespace app\modules\core\models;

use app\modules\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%redeem_limit}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $amount
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class RedeemLimit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%redeem_limit}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => date('Y-m-d H:i:s')
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['amount', 'user_id'], 'required'],
            [['amount'], 'number'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'amount' => Yii::t('app', 'Amount'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
     * @inheritdoc
     * @return \app\modules\core\models\queries\RedeemLimitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\core\models\queries\RedeemLimitQuery(get_called_class());
    }
}
