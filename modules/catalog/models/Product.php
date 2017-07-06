<?php

namespace app\modules\catalog\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $sku
 * @property string $description
 * @property string $price
 * @property integer $status
 * @property integer $created_at
 *
 * @property RefProductCategory[] $refProductCategories
 * @property CategoryProduct[] $categories
 * @property RefProductOrder[] $refProductOrders
 * @property Order[] $orders
 */
class Product extends \yii\db\ActiveRecord
{
    const IN_STOCK = 1;
    const OUT_OF_STOCK = 2;

    /**
     * @var array
     */
    public $categoriesBuff;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @return array
     */
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
            [['name', 'sku', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['status', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['sku'], 'string', 'max' => 32],
            [['sku'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'sku' => Yii::t('app', 'Sku'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProductCategories()
    {
        return $this->hasMany(RefProductCategory::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(CategoryProduct::className(), ['id' => 'category_id'])->viaTable('{{%ref_product_category}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProductOrders()
    {
        return $this->hasMany(RefProductOrder::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['id' => 'order_id'])->viaTable('{{%ref_product_order}}', ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\queries\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\catalog\models\queries\ProductQuery(get_called_class());
    }
}
