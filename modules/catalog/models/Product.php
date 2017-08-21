<?php

namespace app\modules\catalog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

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
 * @property integer $type
 * @property integer $vendor
 *
 * @property RefProductCategory[] $refProductCategories
 * @property CategoryProduct[] $categories
 * @property RefProductOrder[] $refProductOrders
 * @property Order[] $orders
 * @property RefProductGroup[] $refProductGroups
 * @property ProductGroup[] $groups
 */
class Product extends \yii\db\ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;

    const VENDOR_CUSTOM     = 1;
    const VENDOR_TANGOCARD  = 2;

    const TYPE_GIFT_CARD = 1;
    const TYPE_CASH = 2;
    const TYPE_DONATION = 3;

    const IN_STOCK = 1;
    const OUT_OF_STOCK = 0;

    /**
     * @var array
     */
    public $categoriesBuff;
    /**
     * @var array
     */
    public $groupsBuff;

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
            [['name', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['status', 'created_at', 'type', 'vendor'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['sku'], 'string', 'max' => 32],
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
     * @return \yii\db\ActiveQuery
     */
    public function getRefProductGroups()
    {
        return $this->hasMany(RefProductGroup::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(ProductGroup::className(), ['id' => 'group_id'])->viaTable('{{%ref_product_group}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeta()
    {
        return $this->hasMany(CatalogMeta::className(), ['sku' => 'entity'])->andWhere(['type' => CatalogMeta::TYPE_PRODUCT]);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\queries\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\catalog\models\queries\ProductQuery(get_called_class());
    }

    public function afterDelete()
    {
        parent::afterDelete();

        if ($this->vendor == self::VENDOR_TANGOCARD) {
            $productsExists = static::find()->where(['sku' => $this->sku])->exists();
            if (!$productsExists) {
                CatalogMeta::deleteAll(['type' => $this->type, 'entity' => $this->sku]);
            }
        }
    }

    /**
     * @return string
     */
    public function categoryList()
    {
        return implode(', ', ArrayHelper::getColumn($this->categories, 'name'));
    }

    public static function getStatusList()
    {
        return [
            self::IN_STOCK => Yii::t('app', 'Active'),
            self::OUT_OF_STOCK => Yii::t('app', 'Inactive'),
        ];
    }

    /**
     * @return array
     */
    public static function getTypeList()
    {
        return [
            self::TYPE_GIFT_CARD => Yii::t('app', 'Gift Card'),
//            self::TYPE_CASH => Yii::t('app', 'Cash'),
//            self::TYPE_DONATION => Yii::t('app', 'Donation'),
        ];
    }

    /**
     * @return array
     */
    public static function getVendorList()
    {
        return [
            self::VENDOR_CUSTOM => Yii::t('app', 'Custom'),
            self::VENDOR_TANGOCARD => Yii::t('app', 'TangoCard'),
        ];
    }

    public function getStatusLabel()
    {
        $list = static::getStatusList();
        return $list[$this->status];
    }

    public function getTypeLabel()
    {
        $list = static::getTypeList();
        return $list[$this->type];
    }

    public function getVendorLabel()
    {
        $list = static::getVendorList();
        return $list[$this->vendor];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
