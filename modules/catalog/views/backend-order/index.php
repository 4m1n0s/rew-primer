<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['pageTitle'] = $this->title;
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('actions') ?>
<div class="row hidden">
    <?= Html::beginForm(['import'], 'post', [
        'enctype' => 'multipart/form-data',
        'id' => 'order-import-form'
    ]);?>
    <?= Html::fileInput('Import[file]', null, [
        'id' => 'file-import'
    ]);?>
    <?= Html::endForm();?>
</div>
<?= Html::button('<i class="fa fa-cloud-upload"></i> <span class="hidden-480">' . Yii::t('app', 'Import') . '</span>', ['class' => 'btn default yellow-stripe', 'id' => 'jsf-import-button']); ?>&nbsp;
<form action="<?= Url::toRoute('/catalog/backend-order/export-all') ?>"
      method="post"
      id="order-export-form"
      style="display: inline-block">
    <?= Html :: hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []);?>
    <?= Html::hiddenInput('ids', null, ['id' => 'export-ids']) ?>
    <button type="submit" class="btn yellow" style="padding: 4px 10px;
    font-size: 13px;
    line-height: 1.5;">
        <i class="fa fa-file-o"></i>&nbsp;Export Selected
    </button>
</form>&nbsp;
<?= Html::button('<i class="fa fa-check-square-o"></i> <span>'.\Yii::t('admin', 'Mark as Processing Selected').'</span>',
    [
        'title' => 'All selected orders will be marked as processing.',
        'id' => 'processing-all',
        'class' => 'btn blue',
        'data-confirm' => 'Confirm the action',
        'data-link' => Url::toRoute(['/catalog/backend-order/processing-all']),

    ]
) ?>&nbsp;
<?= Html::button('<i class="fa fa-ban"></i> <span>'.\Yii::t('admin', 'Mark as Canceled Selected').'</span>',
    [
        'title' => 'All selected orders will be marked as canceled.',
        'id' => 'canceled-all',
        'class' => 'btn red',
        'data-confirm' => 'Confirm the action',
        'data-link' => Url::toRoute(['/catalog/backend-order/canceled-all']),
    ]
) ?>
<?php $this->endBlock() ?>

<?php $this->beginBlock('content') ?>
    <div class="order-index">
        <?php Pjax::begin(['id' => 'order-grid-pjax', 'enablePushState' => true]) ?>
        <?= GridView::widget([
            'id' => 'order-grid',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => \app\modules\dashboard\helpers\GridViewTemplateHelper::baseLayout(),
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['class' => 'yii\grid\CheckboxColumn'],

                'id',
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'value' => function($row) {
                        return Html::a($row->user_id, ['/user/index-backend/edit', 'id' => $row->user_id], [
                            'data-pajx' => 0
                        ]);
                    }
                ],
                'cost',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'filter' => \app\modules\catalog\models\Order::getStatusList(),
                    'value' => function($model) {
                        return $model->getStatus(true);
                    }
                ],
                'create_date:date',
                'closed_date:date',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => Yii::t('user/admin', 'Actions'),
                    'headerOptions' => ['style' => 'min-width:230px;width:230px'],
                    'buttons' => [
                        'view' => function($url, $model) {
                            return Html::a('<i class="glyphicon glyphicon-eye-open"></i> ' . Yii::t('app', 'view'), $url, [
                                'class' => 'btn default btn-xs green',
                                'title' => Yii::t('app', 'Edit'),
                                'data-pjax' => 0
                            ]);
                        },
                        'status' => function($url, $model) {
                            if ($model->status == \app\modules\catalog\models\Order::STATUS_PROCESSING) {
                                $url = Url::to(['/catalog/backend-order/cancel']);
                                return Html::a(
                                    '<i class="fa fa-ban"></i> ' . Yii::t('app', 'Cancel'),
                                    Url::to(),
                                    [
                                        'title' => 'Move to black list',
                                        'class' => 'btn default btn-xs yellow',
                                        'onclick'=> "order_grid_module.orderStatus('$url', '$model->id')",
                                        'data-pjax' => 1
                                    ]
                                );
                            } elseif ($model->status == \app\modules\catalog\models\Order::STATUS_CANCELLED) {
                                $url = Url::to(['/catalog/backend-order/restore']);
                                return Html::a(
                                    '<i class="fa fa-check"></i> ' . Yii::t('app', 'Restore'),
                                    Url::to(),
                                    [
                                        'title' => 'Activate user',
                                        'class' => 'btn default btn-xs blue',
                                        'onclick'=> "order_grid_module.orderStatus('$url', '$model->id')",
                                        'data-pjax' => 1
                                    ]
                                );
                            }
                        },
                    ],
                    'template' => '{view} {status}',
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
<?php $this->endBlock() ?>

<?php echo \app\modules\dashboard\helpers\TemplateHelper::indexPage('content', 'actions') ?>

<?php
$this->registerJsFile('/backend/js/order_grid_module.js', ['depends' => \app\assets\BackendAsset::class]);
$this->registerJs('order_grid_module.init()');
?>
