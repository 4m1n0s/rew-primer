<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function($row) {
                    return Html::a($row->user_id, ['/user/index-backend/edit', 'id' => $row->user_id]);
                }
            ],
            'cost',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($row) {
                    return $row->getStatus(true);
                }
            ],
            [
                'label' => 'Products',
                'format' => 'raw',
                'value' => function($row) {
                    return $row->getProductsView();
                }
            ],
            'note:ntext',
            'closed_user_id',
            'closed_date:date',
            'create_date:date',
            'update_date:date',
        ],
    ]) ?>

</div>
