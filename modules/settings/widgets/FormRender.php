<?php

namespace app\modules\settings\widgets;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\modules\settings\forms\FormModel;
use yii\widgets\ActiveForm;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class FormRender extends Widget
{
    /**
     * @var \app\modules\settings\forms\FormModel
     */
    protected $model;
    /**
     * @var string
     */
    public $formClass = '\yii\widgets\ActiveForm';
    /**
     * @var array
     */
    public $formOptions;
    /**
     * @var string
     */
    public $submitText;
    /**
     * @var array
     */
    public $submitOptions;
    /**
     * @var array
     */
    public $formBodyWrapOptions = [];
    /**
     * @var string
     */
    public $formControls;

    /**
     * @throws InvalidConfigException
     */
    public function run()
    {
        $model = $this->model;
        $form = call_user_func([$this->formClass, 'begin'], $this->formOptions);
        echo Html::beginTag('div', $this->formBodyWrapOptions);
        /* @var ActiveForm $form */
        foreach ($model->keys as $key => $config) {
            $label = ArrayHelper::getValue($config, 'label', null);
            $labelOptions = ArrayHelper::getValue($config, 'labelOptions', []);
            $type = ArrayHelper::getValue($config, 'type', FormModel::TYPE_TEXTINPUT);
            $options = ArrayHelper::getValue($config, 'options', []);
            $field = $form->field($model, $key);
            $items = ArrayHelper::getValue($config, 'items', []);
            switch ($type) {
                case FormModel::TYPE_TEXTINPUT:
                    $input = $field->textInput($options);
                    break;
                case FormModel::TYPE_DROPDOWN:
                    $input = $field->dropDownList($items, $options);
                    break;
                case FormModel::TYPE_CHECKBOX:
                    $input = $field->checkbox($options, false);
                    break;
                case FormModel::TYPE_CHECKBOXLIST:
                    $input = $field->checkboxList($items, $options);
                    break;
                case FormModel::TYPE_RADIOLIST:
                    $input = $field->radioList($items, $options);
                    break;
                case FormModel::TYPE_TEXTAREA:
                    $input = $field->textarea($options);
                    break;
                case FormModel::TYPE_WIDGET:
                    $widget = ArrayHelper::getValue($config, 'widget');
                    if ($widget === null) {
                        throw new InvalidConfigException('Widget class must be set');
                    }
                    $input = $field->widget($widget, $options);
                    break;
                default:
                    $input = $field->input($type, $options);
            }
            echo $input->label($label, $labelOptions);
        }
        echo Html::endTag('div');
        echo $this->formControls;
        call_user_func([$this->formClass, 'end']);
    }

    public function setModel(FormModel $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }
}
