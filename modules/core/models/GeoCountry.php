<?php

namespace app\modules\core\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%geo_country}}".
 *
 * @property integer $id
 * @property integer $geoname_id
 * @property string $locale_code
 * @property string $continent_code
 * @property string $continent_name
 * @property string $country_iso_code
 * @property string $country_name
 */
class GeoCountry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%geo_country}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['geoname_id'], 'integer'],
            [['locale_code', 'continent_code', 'continent_name', 'country_iso_code', 'country_name'], 'required'],
            [['locale_code', 'continent_code', 'country_iso_code'], 'string', 'max' => 2],
            [['continent_name', 'country_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'geoname_id' => Yii::t('app', 'Geoname ID'),
            'locale_code' => Yii::t('app', 'Locale Code'),
            'continent_code' => Yii::t('app', 'Continent Code'),
            'continent_name' => Yii::t('app', 'Continent Name'),
            'country_iso_code' => Yii::t('app', 'Country Iso Code'),
            'country_name' => Yii::t('app', 'Country Name'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\modules\core\models\queries\GeoCountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\core\models\queries\GeoCountryQuery(get_called_class());
    }

    public static function getList()
    {
        return ArrayHelper::map(static::find()->all(), 'id', 'country_name');
    }
}
