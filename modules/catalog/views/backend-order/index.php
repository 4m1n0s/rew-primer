<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['pageTitle'] = $this->title;
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('actions') ?>

<div class="btn-groups">
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
    <?= Html::button('<i class="fa fa-cloud-upload"></i> <span>' . Yii::t('app', 'Import') . '</span>', ['class' => 'btn default yellow-stripe', 'id' => 'jsf-import-button']); ?>
    <form action="<?= Url::toRoute('/catalog/backend-order/export-all') ?>"
          method="post"
          id="order-export-form">
        <?= Html :: hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []);?>
        <?= Html::hiddenInput('ids', null, ['id' => 'export-ids']) ?>
        <button type="submit" class="btn yellow">
            <i class="fa fa-file-o"></i>&nbsp;Export Selected
        </button>
    </form>
    <?= Html::button('<i class="fa fa-check-square-o"></i> <span>'.\Yii::t('admin', 'Mark as Processing Selected').'</span>',
        [
            'title' => 'All selected orders will be marked as processing.',
            'id' => 'processing-all',
            'class' => 'btn blue',
            'data-confirm' => 'Confirm the action',
            'data-link' => Url::toRoute(['/catalog/backend-order/processing-all']),

        ]
    ) ?>
    <?= Html::button('<i class="fa fa-ban"></i> <span>'.\Yii::t('admin', 'Mark as Canceled Selected').'</span>',
        [
            'title' => 'All selected orders will be marked as canceled.',
            'id' => 'canceled-all',
            'class' => 'btn red',
            'data-confirm' => 'Confirm the action',
            'data-link' => Url::toRoute(['/catalog/backend-order/canceled-all']),
        ]
    ) ?>

</div>

<?php $this->endBlock() ?>

<div class="order-index">
    <?php Pjax::begin(['id' => 'order-grid-pjax']) ?>
    <?= GridView::widget([
        'id' => 'order-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            [
                'attribute' => 'id',
                'label' => 'Order #'
            ],
            [
                'label' => 'Customer',
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function($row) {
                    $user = $row->user;
                    if (!$user) {
                        return null;
                    }
                    return Html::a($user->name . ' (#' . $user->id . ')', ['/user/index-backend/view', 'id' => $row->user_id], [
                        'data-pjax' => 0,
                        'class' => 'view-modal-btn'
                    ]);
                }
            ],
            [
                'headerOptions' => ['style' => 'width: 120px;min-width: 120px;'],
                'filter' => \app\modules\dashboard\helpers\GridViewTemplateHelper::textRange($searchModel, 'cost_from', 'cost_to'),
                'attribute' => 'cost',
            ],
            [
                'filter' => \app\modules\dashboard\helpers\GridViewTemplateHelper::dateRange($searchModel, 'cr_date_from', 'cr_date_to'),
                'headerOptions' => ['style' => 'width: 180px;min-width: 180px;'],
                'attribute' => 'create_date',
                'format' => 'datetime',
            ],
            [
                'filter' => \app\modules\dashboard\helpers\GridViewTemplateHelper::dateRange($searchModel, 'cl_date_from', 'cl_date_to'),
                'headerOptions' => ['style' => 'width: 180px;min-width: 180px;'],
                'attribute' => 'closed_date',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => \app\modules\catalog\models\Order::getStatusList(),
                'value' => function($model) {
                    return $model->getStatus(true);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'min-width:40px;width:40px'],
                'template' => '{view}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>


<?php
$this->registerJsFile('/backend/js/order_grid_module.js', ['depends' => \app\assets\BackendAsset::class]);
$this->registerJs('order_grid_module.init()');
?>
