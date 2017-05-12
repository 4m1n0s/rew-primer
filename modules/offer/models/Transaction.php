<?php

namespace app\modules\offer\models;

use app\modules\core\components\IPNormalizer;
use app\modules\user\models\User;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%transaction}}".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $status
 * @property string $amount
 * @property integer $user_id
 * @property string $ip
 * @property integer $object_type
 * @property integer $object_id
 * @property string $description
 * @property string $params
 * @property integer $created_at
 * @property string name
 * @property string external_transaction_id
 *
 * @property User $user
 */
class Transaction extends \yii\db\ActiveRecord
{
    const TYPE_OFFER_INCOME     = 1;
    const TYPE_REFERRAL_INCOME  = 2;
    const TYPE_REDEMPTION_SPEND = 3;

    const STATUS_PENDING    = 1;
    const STATUS_COMPLETE   = 2;
    const STATUS_REVERSED   = 3;
    const STATUS_DELETED    = 4;

    const OBJECT_TYPE_REFERRAL = 1;
    const OBJECT_TYPE_ADWORKMEDIA_OFFER = 10;
    const OBJECT_TYPE_KIWIWALL_OFFER = 11;
    const OBJECT_TYPE_OFFERTORO_OFFER = 12;
    const OBJECT_TYPE_OFFERDADDY_OFFER = 13;
    const OBJECT_TYPE_CLIXWALL_OFFER = 14;

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
            [['type', 'user_id', 'object_id', 'object_type'], 'required'],
            [['type', 'status', 'user_id', 'object_id', 'object_type', 'created_at'], 'integer'],
            [['amount'], 'number'],
            [['params'], 'string'],
            [['ip'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 128],
            [['external_transaction_id'], 'string', 'max' => 64],
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
            'object_type' => Yii::t('app', 'Object Type'),
            'object_id' => Yii::t('app', 'Object ID'),
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
     * @inheritdoc
     * @return \app\modules\offer\models\queries\TransactionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\offer\models\queries\TransactionQuery(get_called_class());
    }

    /**
     * @param $type
     * @param $status
     * @param $amount
     * @param $userID
     * @param $userIP
     * @param $objectType
     * @param $objectID
     * @param $external_transaction_id
     * @param $name
     * @param $description
     * @param null $params
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function initTransaction($type, $status, $amount, $userID, $userIP, $objectType, $objectID,
                                           $external_transaction_id, $name, $description = null, $params = null)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $model = new static;
            $model->type = $type;
            $model->status = $status;
            $model->amount = $amount;
            $model->user_id = $userID;
            $model->ip = $userIP;
            $model->object_type = $objectType;
            $model->object_id = $objectID;
            $model->external_transaction_id = $external_transaction_id;
            $model->name = $name;
            $model->description = $description;
            $model->params = $params;

            if (!$model->save()) {
                throw new Exception('Could not save transaction' . PHP_EOL . Json::encode($model->errors));
            }

            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false; // TODO: Log occurred errors
        }
    }
}
