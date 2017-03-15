<?php

namespace app\modules\pages\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%pages}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property PagesMeta[] $pagesMeta
 */
class Pages extends \yii\db\ActiveRecord
{

    protected $metaData;

    const HOME_PAGE = ['name' => 'Home', 'folder' => 'home_page'];
    const ABOUT_US_PAGE = ['name' => 'About Us', 'folder' => 'about_us_page'];
    const ADVERTISE_PAGE = ['name' => 'Advertise', 'folder' => 'advertise_page'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagesMeta()
    {
        return $this->hasMany(PagesMeta::className(), ['id_page' => 'id']);
    }


    public static function getConstPage(){
        $array = ArrayHelper::merge([], [self::HOME_PAGE, self::ABOUT_US_PAGE, self::ADVERTISE_PAGE]);
        return $array;
    }

    public function afterFind()
    {
        $this->metaData = new \stdClass();
        foreach ($this->pagesMeta as $key => $value) {
            $this->metaData->{$value->meta_key} = $value->meta_value;
        }
    }

    /**
     * Get user meta data
     * @return object
     */

    public function getMetaData(){
        return $this->metaData;
    }

    public function getHeaderImage(){
        return isset($this->metaData->header_image) ? $this->metaData->header_image : null;
    }

    public function getText(){
        return isset($this->metaData->text) ? $this->metaData->text : null;
    }

    public static function GridPages(){

        $dataProvider = new ActiveDataProvider([
            'query' => self::find()->with('pagesMeta'),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        return $dataProvider;
    }
}
