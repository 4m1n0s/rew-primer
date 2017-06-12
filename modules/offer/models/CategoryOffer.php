<?php

namespace app\modules\offer\models;

use Yii;

/**
 * This is the model class for table "{{%category_offer}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $offer_id
 *
 * @property Category $category
 * @property Offer $offer
 */
class CategoryOffer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category_offer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'offer_id'], 'integer'],
            [['offer_id'], 'required'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['offer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'offer_id' => Yii::t('app', 'Offer ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offer::className(), ['id' => 'offer_id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\queries\CategoryOfferQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\offer\models\queries\CategoryOfferQuery(get_called_class());
    }
}
