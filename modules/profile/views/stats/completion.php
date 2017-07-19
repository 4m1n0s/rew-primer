<?php

use kartik\date\DatePicker;

/* @var \yii\web\View $this */
/* @var \app\modules\offer\components\OfferMapper $offerMapper */

$this->title = Yii::t('app', 'Completion History');
?>

<!-- post content -->
<div class="post-content">
    <div class="table-responsive">
        <?php \yii\widgets\Pjax::begin();
        echo \yii\grid\GridView::widget([
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
                    'label' => 'OfferWall',
                    'value' => function($row) use ($offerMapper) {
                        return $offerMapper->getLabel($row->object_type);
                    }
                ],
                [
                    'attribute' => 'name',
                    'label' => 'Name',
                    'value' => function($row) use ($offerMapper) {
                        return (!empty($row->name)) ? $row->name : $offerMapper->getLabel($row->object_type);
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
        ]);
        \yii\widgets\Pjax::end(); ?>
    </div>
</div>
<!-- END: post content -->