<?php

/* @var \yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

$this->title = 'Order history';
?>
<?php $this->beginBlock('title') ?>
<?= $this->title ?>
<?php $this->endBlock() ?>
<div class="order-history-list">
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'options' => ['class' => 'table-responsive'],
            'tableOptions' => ['class' => 'table table-condensed'],
            'headerRowOptions' => [
                'class' => 'table-header'
            ],
            'layout' => \app\modules\dashboard\helpers\GridViewTemplateHelper::baseLayout(),
            'columns' => [
                [
                    'label' => 'Products',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'product-list'],
                    'value' => function($model) {
                        $ret = \yii\helpers\ArrayHelper::map($model->products, 'id', 'name');
                        $output = Html::beginTag('ul');
                        foreach ($ret as $key => $item) {
                            $output .= Html::tag('li', Html::encode($item));
                        }
                        return $output .= Html::endTag('ul');
                    },
                    'headerOptions' => [
                        'style' => 'min-width: 250px; width: 250px'
                    ]
                ],
                [
                    'attribute' => 'cost',
                    'headerOptions' => [
                        'style' => 'min-width: 90px; width: 90px'
                    ]
                ],
                [
                    'attribute' => 'status',
                    'filter' => \app\modules\catalog\models\Order::getStatusList(),
                    'value' => function($model) {
                        return $model->getStatus();
                    },
                    'headerOptions' => [
                        'style' => 'min-width: 110px; width: 110px'
                    ]
                ],
                [
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'cr_date_from',
                        'attribute2' => 'cr_date_to',
                        'type' => DatePicker::TYPE_RANGE,
                        'separator' => 'to',
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true
                        ]
                    ]),
                    'headerOptions' => ['style' => 'min-width: 200px; width: 300px'],
                    'attribute' => 'create_date',
                    'format' => 'datetime',
                    'label' => 'Date',
                ],
            ],
        ]); ?>
</div>