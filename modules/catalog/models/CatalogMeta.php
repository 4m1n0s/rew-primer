<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "{{%catalog_meta}}".
 *
 * @property integer $type
 * @property string $entity
 * @property string $key
 * @property string $value
 */
class CatalogMeta extends \yii\db\ActiveRecord
{
    const TYPE_PRODUCT = 1;
    const TYPE_GROUP = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_meta}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'entity', 'key'], 'required'],
            [['type'], 'integer'],
            [['value'], 'string'],
            [['entity', 'key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type' => Yii::t('app', 'Type'),
            'entity' => Yii::t('app', 'Entity'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\queries\CatalogMetaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\catalog\models\queries\CatalogMetaQuery(get_called_class());
    }

    public static function get($type, $entity, $key)
    {
        return static::find()->where(['type' => $type, 'entity' => $entity, 'key' => $key])->one();
    }

    public static function set($type, $entity, $key, $value)
    {
        $model = static::findOne(['type' => $type, 'entity' => $entity, 'key' => $key]);
        if (!$model) {
            $model = new static;
        }

        $model->type = $type;
        $model->entity = strval($entity);
        $model->key = strval($key);
        $model->value = strval($value);
        return $model->save();
    }
}
