<?php

use yii\grid\GridView;
use yii\helpers\Html;

echo GridView::widget([

    'pager' => [
        'firstPageLabel' => Yii::t('admin', 'First'),
        'lastPageLabel' => Yii::t('admin', 'Last'),
    ],
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'name',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('admin', 'Actions'),
            'buttons' => [
                'edit' => function($url, $model) {
                    $url = Yii::$app->getUrlManager()->createUrl(['pages/index-backend/update', 'id' => $model->id]);

                    return Html::a('<i class="fa fa-edit"></i> ' . Yii::t('admin', 'Edit'), $url, [
                        'class' => 'btn blue btn-outline',
                        'title' => Yii::t('admin', 'Edit'),
                        'data-pjax' => 0
                    ]);
                },
            ],
            'template' => '{edit}',
        ],
    ],
]);