<?php

namespace app\modules\offer\models;

use app\modules\core\models\GeoCountry;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%offer}}".
 *
 * @property integer $id
 * @property integer $active
 * @property string $name
 * @property string $img
 * @property string $label

 * @property GeoCountry[] $geoCountries
 * @property CategoryOffer[] $categoryOffers
 * @property RefOfferCountry[] $offerCountries
 * @property OfferDeviceType[] $deviceTypes
 * @property OfferDeviceOs[] $deviceOs
 * @property Category[] $categories
 */
class Offer extends \yii\db\ActiveRecord
{
    const ADWORKMEDIA = 10;
    const KIWIWALL = 11;
    const OFFERTORO = 12;
    const OFFERDADDY = 13;
    const CLIXWALL = 14;
    const PTCWALL = 15;
    const SUPERREWARDS = 16;
    const MINUTESTAFF = 17;
    const CPALEAD = 18;
    const PERSONA = 19;
    const FYBER = 20;
    const POLLFISH = 21;
    const PAYMENTWALL = 22;
    const SAYSOPUBS = 23;
    const DRYVERLESSADS = 24;
    const MOBILEAVENUE = 25;

    /**
     * @var UploadedFile
     */
    public $imageFile;
    /**
     * @var array
     */
    public $categoriesBuff;
    /**
     * @var array
     */
    public $newCountries;
    /**
     * @var array
     */
    public $newDeviceOs;
    /**
     * @var array
     */
    public $newDeviceTypes;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%offer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'label'], 'required'],
            [['id', 'active'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['img'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'active' => Yii::t('app', 'Active'),
            'name' => Yii::t('app', 'Name'),
            'img' => Yii::t('app', 'Img'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\queries\OfferQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\offer\models\queries\OfferQuery(get_called_class());
    }

    public function uploadImage()
    {
        $dir = Yii::getAlias('@app/web/uploads/offers');
        $web = Yii::getAlias('@web/uploads/offers');
        if (!is_dir($dir)) {
            $oldmask = umask(0);
            mkdir($dir, 0777, true);
            umask($oldmask);
        }
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if ($this->imageFile) {
            $imgName = $this->imageFile->baseName . '_' . time() . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($dir . '/' . $imgName);
            $this->img = $web . '/' . $imgName;
        }
    }

    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->via('categoryOffers');
    }

    public function getOfferCountries()
    {
        return $this->hasMany(RefOfferCountry::class, ['offer_id' => 'id']);
    }

    public function getGeoCountries()
    {
        return $this->hasMany(GeoCountry::class, ['id' => 'country_id'])
            ->via('offerCountries');
    }

    public function getDeviceOs()
    {
        return $this->hasMany(OfferDeviceOs::class, ['offer_id' => 'id']);
    }

    public function getDeviceTypes()
    {
        return $this->hasMany(OfferDeviceType::class, ['offer_id' => 'id']);
    }

    public function getCategoryOffers()
    {
        return $this->hasMany(CategoryOffer::class, ['offer_id' => 'id']);
    }

    public function getCategoriesViewList()
    {
        $list = [];
        foreach ($this->categories as $category) {
            $list[] = Inflector::variablize($category->name);
        }

        return join(' ', $list);
    }
}
