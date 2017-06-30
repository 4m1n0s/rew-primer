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

    const DEVICE_TYPE_DESKTOP = 1;
    const DEVICE_TYPE_MOBILE = 2;
    const DEVICE_TYPE_TABLET = 3;

    const OS_OTHER = 1;
    const OS_IOS = 2;
    const OS_ANDROID = 3;
    const OS_WINDOWS = 4;
    const OS_BLACKBERRY = 5;

    const STORAGE_KEY_COUNTRY_PREFIX = 'offer.targeting.country.';
    const STORAGE_KEY_DEVICE_TYPE_PREFIX = 'offer.targeting.devicetype.';
    const STORAGE_KEY_MOBILE_PREFIX = 'offer.targeting.mobile.';
    const STORAGE_KEY_TABLET_PREFIX = 'offer.targeting.tablet.';

    /**
     * @var array
     */
    public $targetingCountryList = [];
    /**
     * @var array
     */
    public $targetingDeviceTypeList = [];
    /**
     * @var array
     */
    public $targetingDeviceMobileOSList = [];
    /**
     * @var array
     */
    public $targetingDeviceTabletOSList = [];
    /**
     * @var UploadedFile
     */
    public $imageFile;
    /**
     * @var array
     */
    public $categoriesBuff;

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
            [['id', 'name', 'img', 'label'], 'required'],
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

    /**
     * @throws InvalidConfigException
     */
    public function initTargeting()
    {
        $countries = Json::decode(\Yii::$app->keyStorage->get(static::getStorageKeyTargetingCountry($this->id)));
        $deviceTypes = Json::decode(\Yii::$app->keyStorage->get(static::getStorageKeyTargetingDeviceType($this->id)));
        $deviceMobile = Json::decode(\Yii::$app->keyStorage->get(static::getStorageKeyTargetingMobile($this->id)));
        $deviceTablet = Json::decode(\Yii::$app->keyStorage->get(static::getStorageKeyTargetingTablet($this->id)));

        $this->targetingCountryList = $countries ? $countries : [];
        $this->targetingDeviceTypeList = $deviceTypes ? $deviceTypes : [];
        $this->targetingDeviceMobileOSList = $deviceMobile ? $deviceMobile : [];
        $this->targetingDeviceTabletOSList = $deviceTablet ? $deviceTablet : [];
    }

    /**
     * @param $offerID
     * @return string
     * @throws InvalidConfigException
     */
    public static function getStorageKeyTargetingCountry($offerID)
    {
        return static::STORAGE_KEY_COUNTRY_PREFIX . $offerID;
    }

    /**
     * @param $offerID
     * @return string
     */
    public static function getStorageKeyTargetingDeviceType($offerID)
    {
        return static::STORAGE_KEY_DEVICE_TYPE_PREFIX . $offerID;
    }

    /**
     * @param $offerID
     * @return string
     */
    public static function getStorageKeyTargetingMobile($offerID)
    {
        return static::STORAGE_KEY_MOBILE_PREFIX . $offerID;
    }

    /**
     * @param $offerID
     * @return string
     */
    public static function getStorageKeyTargetingTablet($offerID)
    {
        return static::STORAGE_KEY_TABLET_PREFIX. $offerID;
    }

    /**
     * @param $offerID
     * @return array
     * @throws InvalidConfigException
     */
    public static function getSelectedTargetingCountryList($offerID)
    {
        $value = \Yii::$app->keyStorage->get(static::STORAGE_KEY_COUNTRY_PREFIX . $offerID);

        if (empty($value)) {
            return [];
        }

        $formattedValue = Json::decode($value);     // TODO: Format

        return ArrayHelper::map(
            GeoCountry::find()->where(['in', 'id', $formattedValue])->asArray()->all(),
            'id',
            'country_name'
        );
    }

    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->via('categoryOffers');
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

    public static function getOSList()
    {
        return [
            static::OS_OTHER => 'Other',
            static::OS_IOS => 'IOS',
            static::OS_ANDROID => 'Android',
            static::OS_WINDOWS => 'Windows',
            static::OS_BLACKBERRY => 'BlackBerry',
        ];
    }

    public static function getDeviceTypeList()
    {
        return [
            static::DEVICE_TYPE_DESKTOP => 'Desktop',
            static::DEVICE_TYPE_MOBILE => 'Mobile',
            static::DEVICE_TYPE_TABLET => 'Tablet',
        ];
    }

    public static function getOSName($osID)
    {
        $list = static::getOSList();
        if (!in_array($osID, $list)) {
            throw new InvalidConfigException('Invalid targeting OS ID (' . $osID . ')');
        }

        return $list[$osID];
    }
}
