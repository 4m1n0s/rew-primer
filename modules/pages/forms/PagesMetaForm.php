<?php

namespace app\modules\pages\forms;

use app\modules\pages\models\Pages;
use Yii;
use yii\base\Model;
use app\modules\pages\models\PagesMeta;
use yii\bootstrap\Modal;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\modules\core\helpers\FileUploaderHelper;

/**
 * LoginForm is the model behind the login form.
 */
class PagesMetaForm extends Model {

    public $headerImage;
    public $text;

    public $imageHeaderFile;

    const DEFAULT_FOLDER = DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;

    /** @inheritdoc */
    public function scenarios() {
        return ArrayHelper::merge([
            Pages::HOME_PAGE['name'] => ['headerImage', 'text'],
            Pages::ABOUT_US_PAGE['name'] => ['headerImage'],
            Pages::ADVERTISE_PAGE['name'] => ['headerImage'],
        ], parent::scenarios());
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
//            ['text', 'validateHeaderImage', 'skipOnEmpty' => false],
            [['text', 'imageHeaderFile'], 'required'],
            [['imageHeaderFile'], 'file', 'extensions'=>'jpg, png'],
            ['headerImage', 'string'],
            ['headerImage', 'validateHeaderImage', 'skipOnEmpty' => false],

        ];
    }

    public function validateHeaderImage($attribute, $params){
        if($this->$attribute == null && $_FILES[$this->formName()]['name']['imageHeaderFile']){
            $this->addError('imageHeaderFile', $this->getAttributeLabel($attribute) . ' cannot be blank.');
        }
    }

    public static function columnName($attributeName){
        $column = [
            'headerImage' => 'header_image',
            'text' => 'text'
        ];

        $columnName = '';

        foreach ($column as $key => $value) {
            if($key == $attributeName) {
                $columnName = $value;
            }
        }
        return $columnName;
    }

    public function attributeLabels() {
        return[
            'headerImage' => 'Header Image',
            'text' => 'Text',
            'imageHeaderFile' => 'Header Image'
        ];
    }

    public function filePath($folder, $name) {
        return DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $name;
    }

    public function uploadHeaderImage(Pages $Page, $folder){
        $image = UploadedFile::getInstance($this, 'imageHeaderFile');

        if ($image instanceof UploadedFile) {
            $basePath = Yii::getAlias('@webroot');

            if (null !== $Page->headerImage && file_exists($basePath . $Page->headerImage)) {
                unlink($basePath . $Page->headerImage);
            }

            $path = $this->filePath($folder, self::columnName('headerImage') . '.' . $image->extension);

            if($image->saveAs($basePath . $path)) {
                PagesMeta::updateMetaPage($Page->id, self::columnName('headerImage'), $path);

            }

        }
    }

    public function updatePage(Pages $Page){
        switch ($this->scenario) {
            case Pages::HOME_PAGE['name'] :
                PagesMeta::updateMetaPage($Page->id, self::columnName('text'), $this->text);
                $this->uploadHeaderImage($Page, Pages::HOME_PAGE['folder']);
                break;
            case Pages::ABOUT_US_PAGE['name'] :

                break;
            case Pages::ADVERTISE_PAGE['name'] :

                break;
        }

        return true;
    }

}
