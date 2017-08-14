<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\offer\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['pageTitle'] = Yii::t('admin', 'Categories');
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'] = [
    'Categories',
];
?>

<?php $this->beginBlock('actions')?>
<?= Html::a('<i class="fa fa-plus"></i> <span class="">'.Yii::t('user/admin', 'New Category').'</span>', ['create'], ['class' => 'btn btn-info btn-circle']); ?>
<?php $this->endBlock()?>

<?php Pjax::begin(['id' => 'offers-grid-pjax', 'enablePushState' => true]); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'name',
        [
            'attribute' => 'active',
            'format' => 'raw',
            'filter' => [1 => 'Yes', 0 => 'No'],
            'value' => function($row) {
                return Yii::$app->formatter->asBoolean($row->active);
            }
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'min-width:100px;width:100px'],
            'template' => '{update} {delete}'
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
