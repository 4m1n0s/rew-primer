<?php

namespace app\modules\settings\forms;

use Yii;
use yii\base\Model;
use app\modules\settings\models\Settings;

class SettingForm extends Model
{
    public $email;
    public $site_key;
    public $secret_key;
    public $header_scripts;
    public $footer_scripts;
    public $invite_only_signup;
    public $mandrill_api_key;

    public function rules()
    {
        return [
            [['email', 'site_key', 'secret_key', 'header_scripts', 'footer_scripts', 'invite_only_signup', 'mandrill_api_key'], 'safe']
        ];
    }

    public function attributeLabels() {
        return[
            'email'                 => Yii::t('app', 'Email'),
            'site_key'              => Yii::t('app', 'Site Key'),
            'secret_key'            => Yii::t('app', 'Secret Key'),
            'header_scripts'        => Yii::t('app', 'Header'),
            'footer_scripts'        => Yii::t('app', 'Footer'),
            'mandrill_api_key'      => Yii::t('app', 'Mandrill API Key'),
            'invite_only_signup'    => Yii::t('app', 'Invite Only Signup'),
        ];
    }

    public function getAllSettings(){
        $model = Settings::find()->asArray()->all();

        foreach ($model as $key =>$value) {
            foreach ($this->attributes() as $keyAttr => $valueAttr) {
                if ($value['meta_key'] == $valueAttr) {
                    $this->{$valueAttr} = $value['meta_value'];
                }
            }
        }

    }

    public function saveSettings() {

        foreach ($this->attributes as $key => $value) {
            $model = Settings::find()->where(['meta_key' => $key])->one();
            $model->meta_value = $value;
            $model->update();
        }
        return true;
    }

}

