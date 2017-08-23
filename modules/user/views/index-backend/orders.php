<?php

/* @var \yii\web\View $this */
/* @var \app\modules\user\models\User $user */

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\dashboard\helpers\GridViewTemplateHelper;

$this->title = 'Order history';

$this->params['pageTitle'] = Yii::t('user/admin', 'User\'s');
$this->params['pageSmallTitle'] = Yii::t('user/admin', 'orders');

$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginBlock('caption') ?>
<h3><?php echo Html::a($user->username  . ' (#' . $user->id . ')',
        ['/user/index-backend/view', 'id' => $user->id],
        ['class' => 'view-modal-btn'])
    ?>
</h3>
<?php $this->endBlock() ?>

<div class="order-history-list">
    <?php \yii\widgets\Pjax::begin(['id' => 'pjax-user-order-grid']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'headerOptions' => ['style' => 'width: 40px;min-width: 40px;'],
                'attribute' => 'id',
                'label' => 'Order #'
            ],
            [
                'headerOptions' => ['style' => 'width: 80px;min-width: 80px;'],
                'filter' => GridViewTemplateHelper::textRange($searchModel, 'cost_from', 'cost_to'),
                'attribute' => 'cost',
            ],
            [
                'filter' => GridViewTemplateHelper::dateRange($searchModel, 'cr_date_from', 'cr_date_to'),
                'headerOptions' => ['style' => 'width: 160px;min-width: 160px;'],
                'attribute' => 'create_date',
                'format' => 'datetime',
            ],
            [
                'filter' => GridViewTemplateHelper::dateRange($searchModel, 'cl_date_from', 'cl_date_to'),
                'headerOptions' => ['style' => 'width: 160px;min-width: 160px;'],
                'attribute' => 'closed_date',
                'format' => 'datetime',
            ],
            [
                'headerOptions' => ['style' => 'width: 80px;min-width: 80px;'],
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => \app\modules\catalog\models\Order::getStatusList(),
                'value' => function($model) {
                    return $model->getStatus(true);
                }
            ],
            [
                'label' => 'Products',
                'format' => 'raw',
                'contentOptions' => ['class' => 'product-list'],
                'value' => function($model) {
                    $output = Html::beginTag('ol');
                    foreach ($model->refProductOrders as $item) {
                        $output .= Html::tag('li', Html::a(Html::encode($item->product->name) . ' (' . $item->quantity . ')',
                            ['/catalog/backend-product/view', 'id' => $item->product->id], [
                            'data-pjax' => 0,
                            'class' => 'view-modal-btn'
                        ]));
                    }
                    return $output .= Html::endTag('ol');
                },
                'headerOptions' => [
                    'style' => 'min-width: 180px; width: 180px'
                ]
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>