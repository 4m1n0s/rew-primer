<?php

/* @var \yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

$this->title = 'Order history';
?>

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
                            $output .= Html::tag('li', Html::a(Html::encode($item), ['/catalog/catalog/single', 'id' => $key], ['target' => '_blank']));
                        }
                        return $output .= Html::endTag('ul');
                    }
                ],
                [
                    'attribute' => 'status',
                    'filter' => \app\modules\catalog\models\Order::getStatusList(),
                    'value' => function($model) {
                        return $model->getStatus();
                    },
                    'headerOptions' => [
                        'style' => 'min-width: 110px;'
                    ]
                ],
                [
                    'attribute' => 'cost',
                    'headerOptions' => [
                        'style' => 'min-width: 70px; width: 70px'
                    ]
                ],
                [
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'date_from',
                        'attribute2' => 'date_to',
                        'type' => DatePicker::TYPE_RANGE,
                        'separator' => 'to',
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true
                        ]
                    ]),
                    'headerOptions' => ['style' => 'min-width: 250px;'],
                    'attribute' => 'create_date',
                    'format' => 'datetime',
                ],
            ],
        ]); ?>
</div>