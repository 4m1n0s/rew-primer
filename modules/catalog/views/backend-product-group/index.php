<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\models\search\ProductGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Product Groups');
$this->params['pageTitle'] = $this->title;
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('actions') ?>
<?=  Html::a(\yii\helpers\Html::tag('i', '', ['class' => 'fa fa-plus']) . ' ' . Yii::t('app', 'New Product Group'), ['create'], ['class' => 'btn btn-info btn-circle']); ?>
<?php $this->endBlock() ?>

<?php $this->beginBlock('group-actions') ?>
<?php echo \app\modules\core\widgets\GroupActions::widget([
    'items' => [
        [
            'label' => 'Delete',
            'action' => \yii\helpers\Url::toRoute(['/catalog/backend-product-group/delete-all']),
        ],
    ],
    'grid' => '#product-group-grid',
    'pjaxContainer' => '#product-group-grid-pjax'
]) ?>
<?php $this->endBlock() ?>

<div class="product-group-index">
<?php Pjax::begin(['id' => 'product-group-grid-pjax']); ?>
<?= GridView::widget([
    'id' => 'product-group-grid',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\CheckboxColumn'],

        'name',
        'image:image',
        [
            'attribute' => 'status',
            'format' => 'boolean',
            'filter' => [1 => 'Yes', 0 => 'No']
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<?php Pjax::end(); ?></div>
