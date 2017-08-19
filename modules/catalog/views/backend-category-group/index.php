<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\models\search\ProductGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Group Categories');
$this->params['pageTitle'] = $this->title;
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('actions') ?>
<?=  Html::a(\yii\helpers\Html::tag('i', '', ['class' => 'fa fa-plus']) . ' ' . Yii::t('app', 'New Group Category'), ['create'], ['class' => 'btn btn-info btn-circle']); ?>
<?php $this->endBlock() ?>

<div class="product-group-index">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'active',
                'format' => 'boolean',
                'filter' => [1 => 'Yes', 0 => 'No']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
