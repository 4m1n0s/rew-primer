<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "{{%ref_product_group_category}}".
 *
 * @property integer $category_id
 * @property integer $group_id
 *
 * @property CategoryProductGroup $category
 * @property ProductGroup $group
 */
class RefProductGroupCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_product_group_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'group_id'], 'required'],
            [['category_id', 'group_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryProductGroup::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category ID'),
            'group_id' => Yii::t('app', 'Group ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryProductGroup::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(ProductGroup::className(), ['id' => 'group_id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\queries\RefProductGroupCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\catalog\models\queries\RefProductGroupCategoryQuery(get_called_class());
    }
}
