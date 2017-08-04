<?php

namespace app\modules\dashboard\helpers;

use yii\helpers\Html;

class GridViewTemplateHelper
{
    public static function baseLayout()
    {
        return "
            <div class=\"table-scrollable\">
                {items} 
            </div>
            <div class=\"row\"> 
                <div class=\"col-md-5 col-sm-12\">
                    <div class=\"dataTables_info\" id=\"sample_1_info\">{summary}</div>
                </div>
                <div class=\"col-md-7 col-sm-12\">
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
                    'class' => 'btn default btn-xs blue-hoki view-modal-btn',
                    'title' => 'View',
                    'data-pjax' => 0
                ]);
            },
            'update' => function($url, $model) {
                return Html::a('<i class="fa fa-edit"></i>', $url, [
                    'class' => 'btn default btn-xs grey-mint',
                    'title' => 'Edit',
                    'data-pjax' => 0
                ]);
            },
            'delete' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-trash"></i>', $url, [
                    'class' => 'btn default btn-xs red-sunglo',
                    'title' => 'Remove',
                    'data-method' => 'post',
                    'data-confirm' => \Yii::t('yii', 'Are you sure you want to delete this item?'),
                ]);
            },
        ];
    }
}