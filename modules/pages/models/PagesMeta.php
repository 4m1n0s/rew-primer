<?php

namespace app\modules\pages\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%pages_meta}}".
 *
 * @property integer $id
 * @property integer $id_page
 * @property string $meta_key
 * @property string $meta_value
 */
class PagesMeta extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages_meta}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_page', 'meta_key', 'meta_value'], 'required'],
            [['id_page'], 'integer'],
            [['meta_value'], 'string'],
            [['meta_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_page' => 'Id Page',
            'meta_key' => 'Meta Key',
            'meta_value' => 'Meta Value',
        ];
    }


    public function getPage() {
        return $this->hasOne(Pages::className(), ['id' => 'user_id']);
    }

    public static function updateMetaPage($pageId, $key, $value){
        if(null === $model = static::find()->where(['id_page' => $pageId, 'meta_key' => $key])->one()) {
            $model = new static();
            $model->id_page = $pageId;
            $model->meta_key = $key;
            $model->meta_value = $value;
            return $model->save();
        } else {
            return $model->updateAttributes([
                'meta_value' => $value
            ]);
        }
    }

    public static function saveImagePage($pageId, $key, $value, $folder){
        if($value instanceof UploadedFile) {
            echo 'cool';
            die();
        }
    }
}
