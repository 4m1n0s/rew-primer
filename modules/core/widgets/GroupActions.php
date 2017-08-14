<?php

namespace app\modules\core\widgets;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

class GroupActions extends Widget
{
    /**
     * @var array
     *
     * Example:
     * [
     *     [
     *         'label' => 'My label',
     *         'action' => ['/module/controller/action'],
     *     ],
     *
     *     [ ... ]
     * ]
     */
    public $items;
    /**
     * @var string
     */
    public $buttonLabel = '<i class="fa fa-check"></i> Submit';
    /**
     * @var string GridView ID
     */
    public $grid;
    /**
     * @var string Pjax ID
     */
    public $pjaxContainer;
    /**
     * @var string
     */
    public $template = '{list} {button}';


    public function run()
    {
        if (!is_array($this->items)) {
            throw new InvalidConfigException('Items must be array only');
        }

        $items = [];
        $dataOptions = [];

        foreach ($this->items as $item) {
            $items[$item['label']] = $item['label'];
            $dataOptions[$item['label']] = ['data-action' => $item['action']];
        }

        $listHtml = Html::dropDownList('group-actions', null, $items, ArrayHelper::merge(['options' => $dataOptions], [
            'class' => 'form-control input-inline input-small input-sm',
            'id' => 'table-group-action-input',
            'prompt' => 'Select...'
        ]));
        $buttonHtml = Html::button($this->buttonLabel, [
            'class' => 'btn btn-sm btn-default',
            'id' => 'table-group-action-submit',
        ]);
        $output = strtr($this->template, [
            '{list}'    => $listHtml,
            '{button}'  => $buttonHtml,
        ]);

        \Yii::$app->getView()->registerAssetBundle(\app\modules\core\assets\GroupActions::class);
        $config = Json::encode([
            'grid' => $this->grid,
            'pjaxContainer' => $this->pjaxContainer,
            'list' => '#table-group-action-input',
            'submitBtn' => '#table-group-action-submit',
        ]);
        \Yii::$app->getView()->registerJs('group_actions_module.init(' . $config . ')');

        return $output;
    }
}