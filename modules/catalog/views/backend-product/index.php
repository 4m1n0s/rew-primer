<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\catalog\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['pageTitle'] = $this->title;
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('actions') ?>

    <?= Html::a('<i class="fa fa-plus"></i> <span class="hidden-480">'.Yii::t('user/admin', 'New Product').'</span>', ['create'], ['class' => 'btn default yellow-stripe']); ?>

<?php $this->endBlock() ?>

<div class="backend-product-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => \app\modules\dashboard\helpers\GridViewTemplateHelper::baseLayout(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'sku',
            'price',
            [
                'attribute' => 'status',
                'filter' => [Product::IN_STOCK => 'In Stock', Product::OUT_OF_STOCK => 'Out Of Stock'],
                'value' => function($row) {
                    return $row->status == Product::IN_STOCK ? 'In Stock' : 'Out Of Stock';
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('user/admin', 'Actions'),
                'headerOptions' => ['style' => 'min-width:90px;width:90px'],
                'buttons' => \app\modules\dashboard\helpers\GridViewTemplateHelper::baseActionButtons(),
                'template' => '{update} {delete}',
            ]
        ],
    ]); ?>
</div>