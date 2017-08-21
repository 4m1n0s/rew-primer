<?php

namespace app\modules\dashboard\helpers;

use yii\helpers\Html;
use Yii;

class GridViewTemplateHelper
{
    public static function baseLayout()
    {
        return "
            <div class=\"table-scrollable\">
                {items} 
            </div>
            <div class=\"row\"> 
                <div class=\"col-md-3 col-sm-12\">
                    <div class=\"dataTables_info\" id=\"sample_1_info\">{summary}</div>
                </div>
                <div class=\"col-md-9 col-sm-12\">
                    <div class=\"dataTables_paginate paging_bootstrap\">
                        {pager}
                    </div>
                </div>
            </div>";
    }

    public static function baseActionButtons()
    {
        return [
            'view' => function($url, $model, $key) {
                return Html::a('<i class="fa fa-eye"></i>', $url, [
                    'class' => 'btn btn-sm btn-default btn-circle btn-editable view-modal-btn',
                    'title' => 'View',
                    'data-pjax' => 0
                ]);
            },
            'update' => function($url, $model) {
                return Html::a('<i class="fa fa-edit"></i>', $url, [
                    'class' => 'btn btn-sm btn-default btn-circle btn-editable',
                    'title' => 'Edit',
                    'data-pjax' => 0
                ]);
            },
            'delete' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-trash"></i>', $url, [
                    'class' => 'btn btn-sm btn-default btn-circle btn-editable',
                    'title' => 'Remove',
                    'data-method' => 'post',
                    'data-confirm' => \Yii::t('yii', 'Are you sure you want to delete this item?'),
                ]);
            },
        ];
    }

    public static function dateRange($searchModel, $attributeFrom, $attributeTo, $format = 'yyyy-mm-dd')
    {
        $inputFrom = Html::activeTextInput($searchModel, $attributeFrom,  ['class' => 'form-control date-picker', 'readonly' => '', 'placeholder' => Yii::t('app', 'From')]);
        $inputTo = Html::activeTextInput($searchModel, $attributeTo,  ['class' => 'form-control date-picker', 'readonly' => '', 'placeholder' => Yii::t('app', 'To')]);
        return "<div class = \"input-group date margin-bottom-5\" data-date-format = $format>
                    $inputFrom
                    <span class = \"input-group-btn\">
                        <button class = \"btn default date-set\" type = \"button\"><i class = \"fa fa-calendar\"></i></button>
                    </span>
                </div>
                <div class = \"input-group date\" data-date-format = $format>
                    $inputTo
                    <span class = \"input-group-btn\">
                        <button class = \"btn default date-set\" type = \"button\"><i class = \"fa fa-calendar\"></i></button>
                    </span>
                </div>";
    }

    public static function textRange($searchModel, $attributeFrom, $attributeTo)
    {
        $inputFrom = Html::activeTextInput($searchModel, $attributeFrom,  ['class' => 'form-control form-filter input-sm', 'placeholder' => Yii::t('app', 'From')]);
        $inputFromError = Html::error($searchModel, $attributeFrom, ['class' => 'help-block"']);
        $inputTo = Html::activeTextInput($searchModel, $attributeTo,  ['class' => 'form-control form-filter input-sm', 'placeholder' => Yii::t('app', 'To')]);
        $inputToError = Html::error($searchModel, $attributeTo, ['class' => 'help-block"']);
        return $html =  Html::tag('div', $inputFrom , ['class' => 'input-group margin-bottom-5']) . Html::tag('div', $inputTo . $inputFromError . $inputToError);
    }
}