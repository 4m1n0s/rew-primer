<?php

namespace app\modules\catalog\forms;

use Yii;
use yii\base\Model;

/**
 * Class Import
 *
 * @author Stableflow
 */
class Import extends Model
{
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => ['csv'], 'checkExtensionByMimeType' => false, 'skipOnEmpty' => false],
        ];
    }

    public function attributeLabels()
    {
        return[
            'file' => Yii::t('app', 'File'),
        ];
    }

}
