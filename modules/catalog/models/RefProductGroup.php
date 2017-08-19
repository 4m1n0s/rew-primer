<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "{{%ref_product_group}}".
 *
 * @property integer $product_id
 * @property integer $group_id
 *
 * @property ProductGroup $group
 * @property Product $product
 */
class RefProductGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_product_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'group_id'], 'required'],
            [['product_id', 'group_id'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product ID'),
            'group_id' => Yii::t('app', 'Group ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(ProductGroup::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\queries\RefProductGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\catalog\models\queries\RefProductGroupQuery(get_called_class());
    }
}
