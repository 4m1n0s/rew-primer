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
<?= Html::a('<i class="fa fa-plus"></i> <span class="">'.Yii::t('user/admin', 'New Product').'</span>', ['create'], ['class' => 'btn btn-info btn-circle']); ?>
<?php $this->endBlock() ?>

<?php $this->beginBlock('group-actions') ?>
<?php echo \app\modules\core\widgets\GroupActions::widget([
    'items' => [
        [
            'label' => 'Delete',
            'action' => \yii\helpers\Url::toRoute(['/catalog/backend-product/delete-all']),
        ],
    ],
    'grid' => '#product-grid',
    'pjaxContainer' => '#product-grid-pjax'
]) ?>
<?php $this->endBlock() ?>

<div class="backend-product-index">
    <?php \yii\widgets\Pjax::begin(['id' => 'product-grid-pjax']) ?>
    <?= GridView::widget([
        'id' => 'product-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => \app\modules\dashboard\helpers\GridViewTemplateHelper::baseLayout(),
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            [
                'attribute' => 'vendor',
                'filter' => Product::getVendorList(),
                'value' => function($row) {
                    return $row->getVendorLabel();
                }
            ],
            [
                'attribute' => 'type',
                'filter' => Product::getTypeList(),
                'value' => function($row) {
                    return $row->getTypeLabel();
                }
            ],
            'sku',
            'name',
            [
                'attribute' => 'groupsFilter',
                'label' => 'Product Groups',
                'value' => function($row) {
                    $groupNames = [];
                    foreach ($row->groups as $group) {
                        $groupNames[] = $group->name;
                    }
                    return implode(', ', $groupNames);
                }
            ],
            [
                'headerOptions' => ['style' => 'width: 120px;min-width: 120px;'],
                'filter' => \app\modules\dashboard\helpers\GridViewTemplateHelper::textRange($searchModel, 'price_from', 'price_to'),
                'attribute' => 'price',
            ],
            [
                'attribute' => 'status',
                'filter' => Product::getStatusList(),
                'value' => function($row) {
                    return $row->getStatusLabel();
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'min-width:100px;width:100px'],
            ]
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>