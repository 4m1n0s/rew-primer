<?php

namespace app\modules\catalog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%product_group}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property integer $status
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property RefProductGroup[] $refProductGroups
 * @property Product[] $products
 * @property RefProductGroupCategory[] $refProductGroupCategories
 * @property CategoryProductGroup[] $categories
 */
class ProductGroup extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $categoriesBuff;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_group}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            ['class' => TimestampBehavior::class]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['image'], 'string', 'max' => 255],
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
            'image' => Yii::t('app', 'Image'),
            'status' => Yii::t('app', 'Status'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProductGroups()
    {
        return $this->hasMany(RefProductGroup::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%ref_product_group}}', ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProductGroupCategories()
    {
        return $this->hasMany(RefProductGroupCategory::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(CategoryProductGroup::className(), ['id' => 'category_id'])->viaTable('{{%ref_product_group_category}}', ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeta()
    {
        return $this->hasMany(CatalogMeta::className(), ['id' => 'entity'])->andWhere(['type' => CatalogMeta::TYPE_GROUP]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetaKey($key)
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%ref_product_group}}', ['group_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\queries\ProductGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\catalog\models\queries\ProductGroupQuery(get_called_class());
    }

    public function afterDelete()
    {
        parent::afterDelete();

        CatalogMeta::deleteAll(['type' => CatalogMeta::TYPE_GROUP, 'entity' => $this->id]);
    }

    /**
     * @return string
     */
    public function categoryList()
    {
        return implode(', ', ArrayHelper::getColumn($this->categories, 'name'));
    }

    /**
     * @return array
     */
    public static function getList()
    {
        return ArrayHelper::map(static::find()->all(), 'id', 'name');
    }
}
