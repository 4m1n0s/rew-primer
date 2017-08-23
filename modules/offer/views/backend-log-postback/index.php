<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\offer\models\search\LogPostbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Postback Errors');
$this->params['pageTitle'] = $this->title;
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="log-postback-index">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Offer',
                'attribute' => 'offerFilter',
                'value' => function($row) {
                    return $row->offer->name;
                }
            ],
            'message:ntext',
            [
                'filter' => \app\modules\dashboard\helpers\GridViewTemplateHelper::dateRange($searchModel, 'log_time_from', 'log_time_to'),
                'headerOptions' => ['style' => 'width: 180px;min-width: 180px;'],
                'attribute' => 'log_time',
                'format' => 'datetime',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 50px;min-width: 50px;'],
                'template' => '{view}',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
