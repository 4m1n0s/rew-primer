<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\offer\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['pageTitle'] = Yii::t('admin', 'Categories');
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'] = [
    'Categories',
];
?>

<?php $this->beginBlock('actions')?>

    <?= Html::a('<i class="fa fa-plus"></i> <span class="hidden-480">'.Yii::t('user/admin', 'New Category').'</span>', ['create'], ['class' => 'btn default yellow-stripe']); ?>

<?php $this->endBlock()?>

<?php
$template = "
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
?>

<?php Pjax::begin(['id' => 'offers-grid-pjax', 'enablePushState' => true]); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'name',
        [
            'attribute' => 'active',
            'format' => 'raw',
            'filter' => [1 => 'Yes', 0 => 'No'],
            'value' => function($row) {
                return Yii::$app->formatter->asBoolean($row->active);
            }
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'headerOptions' => ['style' => 'min-width:170px;width:170px'],
            'buttons' => [
                'update' => function($url, $model) {
                    return Html::a('<i class="fa fa-edit"></i> ' . 'Edit', $url, [
                        'class' => 'btn default btn-xs green',
                        'title' => 'Edit',
                        'data-pjax' => 0
                    ]);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-trash"></i> ' . 'Remove', $url, [
                        'class' => 'btn default btn-xs red',
                        'title' => 'Remove',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    ]);
                },
            ],

            'template' => '{update} {delete}'
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
