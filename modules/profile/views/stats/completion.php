<?php

use kartik\date\DatePicker;

/* @var \yii\web\View $this */

$this->title = Yii::t('app', 'Completion History');
?>
<?php $this->beginBlock('title') ?>
<?= $this->title ?>
<?php $this->endBlock() ?>
<div class="completion-history-list">
    <?php echo \yii\grid\GridView::widget([
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
                'attribute' => 'offer_wall',
                'label' => 'OfferWall',
                'value' => function($row) {
                    return $row->offer->label;
                }
            ],
            [
                'attribute' => 'name_campaign',
                'label' => 'Name',
                'value' => function($row) {
                    return $row->name_campaign;
                }
            ],
            'amount',
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
                'attribute' => 'created_at',
                'format' => 'datetime',
                'label' => 'Date'
            ],
        ]
    ]); ?>
</div>