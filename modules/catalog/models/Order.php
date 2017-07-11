<?php

namespace app\modules\catalog\models;

use app\modules\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $status
 * @property string $note
 * @property integer $closed_user_id
 * @property integer $closed_date
 * @property integer $create_date
 * @property integer $update_date
 *
 * @property User $user
 * @property RefProductOrder[] $refProductOrders
 * @property Product[] $products
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_PROCESSING = 1;
    const STATUS_COMPLETED  = 2;
    const STATUS_CANCELLED  = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'create_date',
                'updatedAtAttribute' => 'update_date'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'required'],
            [['user_id', 'status', 'closed_user_id', 'closed_date', 'create_date', 'update_date'], 'integer'],
            [['note'], 'string'],
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
            'status' => Yii::t('app', 'Status'),
            'note' => Yii::t('app', 'Note'),
            'closed_user_id' => Yii::t('app', 'Closed User ID'),
            'closed_date' => Yii::t('app', 'Closed Date'),
            'create_date' => Yii::t('app', 'Create Date'),
            'update_date' => Yii::t('app', 'Update Date'),
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
    public function getRefProductOrders()
    {
        return $this->hasMany(RefProductOrder::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('loc_ref_product_order', ['order_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\queries\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\catalog\models\queries\OrderQuery(get_called_class());
    }
}
