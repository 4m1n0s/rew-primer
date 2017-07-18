<?php
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
                    'label' => 'Name',
                    'value' => function($row) use ($offerMapper) {
                        return (!empty($row->name)) ? $row->name : $offerMapper->getLabel($row->object_type);
                    }
                ],
                'amount',
                'created_at:date',
            ]
        ]);
        \yii\widgets\Pjax::end(); ?>
    </div>
</div>
<!-- END: post content -->