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

<?php //Pjax::begin(['id' => 'contact-grid-pjax', 'enablePushState' => true]); ?>
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
            'filter' => \app\modules\dashboard\helpers\GridViewTemplateHelper::dateRange($searchModel, 'cr_date_from', 'cr_date_to'),
            'headerOptions' => ['style' => 'width: 180px;min-width: 180px;'],
            'attribute' => 'create_date',
            'format' => 'datetime',
        ],
        [
            'attribute' => 'status',
            'format' => 'raw',
            'filter' => \app\modules\contact\models\Contact::getStatusList(),
            'value' => function($model) {
                return $model->getStatus(true);
            }
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'buttons' => \yii\helpers\ArrayHelper::merge(\app\modules\dashboard\helpers\GridViewTemplateHelper::baseActionButtons(), [
                'reply' => function($url, $model) {
                    return Html::a('<i class="fa fa-reply"></i>', $url, [
                        'class' => 'btn btn-sm btn-default btn-circle btn-editable',
                        'title' => Yii::t('app', 'Reply'),
                        'data-pjax' => 0
                    ]);
                },
            ]),
            'template' => '{reply} {delete}'
        ],
    ],
]); ?>
<?php //Pjax::end(); ?>

<?php
$this->registerJsFile('/backend/js/contact_grid_module.js', ['depends' => \app\assets\BackendAsset::class]);
$this->registerJs('contact_grid_module.init()');
?>
