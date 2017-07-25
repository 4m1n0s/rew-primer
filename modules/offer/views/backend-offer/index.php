<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\offer\models\search\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offers';
$this->params['pageTitle'] = Yii::t('admin', 'Offers');
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'] = [
    'Offers',
];
?>

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
    'id' => 'offer-grid',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'name',
        'label',
        [
            'attribute' => 'img',
            'format' => 'raw',
            'filter' => false,
            'value' => function($row) {
                return Yii::$app->formatter->asImage($row->img, ['width' => 140]);
            }
        ],
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
            'headerOptions' => ['style' => 'min-width:70px;width:70px'],
            'buttons' => [
                'edit' => function($url, $model) {
                    $url = Yii::$app->getUrlManager()->createUrl(['offer/backend-offer/update', 'id' => $model->id]);

                    return Html::a('<i class="fa fa-edit"></i> ' . 'Edit', $url, [
                        'class' => 'btn default btn-xs green',
                        'title' => 'Edit',
                        'data-pjax' => 0
                    ]);
                },
            ],

            'template' => '{edit}'
        ],
    ],
]); ?>
<?php Pjax::end(); ?>