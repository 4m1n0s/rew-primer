<?php

namespace app\modules\catalog\models;

use app\modules\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

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
 * @property integer $refunded
 * @property integer $cost
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
            [['user_id', 'status', 'closed_user_id', 'closed_date', 'create_date', 'update_date', 'refunded'], 'integer'],
            [['note'], 'string'],
            [['cost'], 'number'],
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
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%ref_product_order}}', ['order_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\queries\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\catalog\models\queries\OrderQuery(get_called_class());
    }

    /**
     * Get status list
     * @return array
     */
    public static function getStatusList() {
        return [
            static::STATUS_PROCESSING => Yii::t('app', 'Processing'),
            static::STATUS_COMPLETED => Yii::t('app', 'Completed'),
            static::STATUS_CANCELLED => Yii::t('app', 'Canceled'),
        ];
    }

    /**
     * Get status
     * @param boolean $html
     * @return string
     */
    public function getStatus($html = false) {
        $statusList = $this->getStatusList();

        switch ($this->status) {
            case static::STATUS_PROCESSING :
                $label = 'info';
                $status = $statusList[static::STATUS_PROCESSING];
                break;
            case static::STATUS_COMPLETED:
                $label = 'success';
                $status = $statusList[static::STATUS_COMPLETED];
                break;
            case static::STATUS_CANCELLED:
                $label = 'danger';
                $status = $statusList[static::STATUS_CANCELLED];
                break;
            default:
                $label = 'default';
                $status = 'unknown';
        }

        if ($html) {
            return "<span class=\"label label-sm label-$label\">$status</span>";
        }

        return $status;
    }

    public function setStatusCanceled()
    {
        $this->status = static::STATUS_CANCELLED;
        $this->closed_user_id = Yii::$app->user->getId();
        $this->closed_date = time();
        return $this->save();
    }

    public function setStatusProcessing()
    {
        $this->status = static::STATUS_PROCESSING;
        $this->closed_user_id = null;
        $this->closed_date = null;
        return $this->save();
    }

    public function setStatusCompleted()
    {
        $this->status = static::STATUS_COMPLETED;
        $this->closed_user_id = Yii::$app->user->getId();
        $this->closed_date = time();
        return $this->save();
    }

    public function getProductsView()
    {
        $html = '<ul>';
        foreach ($this->refProductOrders as $refProductOrder) {
            $html .= '<li>' . Html::a($refProductOrder->product->name . ' (' . $refProductOrder->quantity . ')', [
                    '/catalog/backend-product/update', 'id' => $refProductOrder->product->id
                ]) . '</li>';
        }
        $html .= '<ul>';
        return $html;
    }
}
