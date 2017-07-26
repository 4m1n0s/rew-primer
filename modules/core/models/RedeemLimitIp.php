<?php

namespace app\modules\core\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%redeem_limit_ip}}".
 *
 * @property integer $id
 * @property string $ip
 * @property string $amount
 * @property string $created_at
 * @property string $updated_at
 */
class RedeemLimitIp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%redeem_limit_ip}}';
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
            [['ip', 'amount'], 'required'],
            [['amount'], 'number'],
            [['ip'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ip' => Yii::t('app', 'Ip'),
            'amount' => Yii::t('app', 'Amount'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\modules\core\models\queries\RedeemLimitIpQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\core\models\queries\RedeemLimitIpQuery(get_called_class());
    }
}
