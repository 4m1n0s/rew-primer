<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\contact\models\search\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['pageTitle'] = Yii::t('admin', 'Contacts');
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginBlock('actions')?>

    <?= Html::button('<i class="fa fa-check-square-o"></i> <span>'.\Yii::t('admin', 'Mark as Read Selected').'</span>',
        [
            'title' => 'All selected messages will be approved.',
            'id' => 'read-all',
            'class' => 'btn blue',
            'data-confirm' => 'Confirm the action',
            'data-link' => Url::toRoute(['/contact/index-backend/read-all']),

        ]
    ) ?>
    <?= Html::button('<i class="fa fa-ban"></i> <span>'.\Yii::t('admin', 'Remove Selected').'</span>',
        [
            'title' => 'All selected messages will be declined.',
            'id' => 'delete-all',
            'class' => 'btn red',
            'data-confirm' => 'Confirm the action',
            'data-link' => Url::toRoute(['/contact/index-backend/delete-all']),
        ]
    ) ?>

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

<?php Pjax::begin(['id' => 'contact-grid-pjax', 'enablePushState' => true]); ?>
<?= GridView::widget([
    'id' => 'contact-grid',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        ['class' => 'yii\grid\CheckboxColumn'],

        'name',
        'email:email',
        [
            'attribute' => 'subject',
            'value' => function($model) {
                return mb_strimwidth($model->subject, 0, 120, '...');
            }
        ],
        [
            'attribute' => 'status',
            'format' => 'raw',
            'filter' => \app\modules\contact\models\Contact::getStatusList(),
            'value' => function($model) {
                return $model->getStatus(true);
            }
        ],
        'create_date:date',

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete}'
        ],
    ],
]); ?>
<?php Pjax::end(); ?>

<?php
$this->registerJsFile('/backend/js/contact_grid_module.js', ['depends' => \app\assets\BackendAsset::class]);
$this->registerJs('contact_grid_module.init()');
?>
