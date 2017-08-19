<?php

namespace app\modules\catalog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%category_product_group}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $order
 * @property integer $active
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property RefProductGroupCategory[] $refProductGroupCategories
 * @property ProductGroup[] $groups
 */
class CategoryProductGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category_product_group}}';
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
            [['name'], 'required'],
            [['order', 'active', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'order' => Yii::t('app', 'Order'),
            'active' => Yii::t('app', 'Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProductGroupCategories()
    {
        return $this->hasMany(RefProductGroupCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(ProductGroup::className(), ['id' => 'group_id'])->viaTable('{{%ref_product_group_category}}', ['category_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\queries\CategoryProductGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\catalog\models\queries\CategoryProductGroupQuery(get_called_class());
    }

    /**
     * @return array
     */
    public static function getList()
    {
        return ArrayHelper::map(static::find()->all(), 'id', 'name');
    }
}
