<?php

namespace app\modules\pages\models;

use romi45\seoContent\components\SeoBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property integer $template
 * @property string $title
 * @property string $description
 * @property string $content
 * @property integer $created_at
 */
class Page extends \yii\db\ActiveRecord
{
    const TEMPLATE_CONTACT  = 1;
    const TEMPLATE_FAQ      = 2;
    const TEMPLATE_ABOUT    = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ],
            'seo' => [
                'class' => SeoBehavior::className(),
                'titleAttribute' => 'seoTitle',
                'keywordsAttribute' => 'seoKeywords',
                'descriptionAttribute' => 'seoDescription'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template'], 'required'],
            [['template', 'created_at'], 'integer'],
            [['description', 'content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['template'], 'unique'],
            [['seoTitle', 'seoKeywords', 'seoDescription'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'template' => Yii::t('app', 'Template'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\modules\pages\models\queries\PageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\pages\models\queries\PageQuery(get_called_class());
    }


    /**
     * Get template list
     * @return array
     */
    public static function getTemplateList() {
        return [
            static::TEMPLATE_CONTACT => Yii::t('app', 'Contact'),
            static::TEMPLATE_FAQ => Yii::t('app', 'Faq'),
            static::TEMPLATE_ABOUT => Yii::t('app', 'About'),
        ];
    }

    /**
     * Get template name
     * @return string
     */
    public function getTemplateName() {
        $templateList = static::getTemplateList();

        switch ($this->template) {
            case static::TEMPLATE_CONTACT :
                return $templateList[static::TEMPLATE_CONTACT];
            case static::TEMPLATE_FAQ:
                return $templateList[static::TEMPLATE_FAQ];
            case static::TEMPLATE_ABOUT:
                return $templateList[static::TEMPLATE_ABOUT];
            default:
                return 'unknown';
        }
    }
}
