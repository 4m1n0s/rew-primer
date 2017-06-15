<?php

namespace app\modules\offer\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $active
 *
 * @property CategoryOffer[] $categoryOffers
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 64],
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
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryOffers()
    {
        return $this->hasMany(CategoryOffer::className(), ['category_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\queries\CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\offer\models\queries\CategoryQuery(get_called_class());
    }

    public static function getList()
    {
        return ArrayHelper::map(static::find()->all(), 'id', 'name');
    }
}
