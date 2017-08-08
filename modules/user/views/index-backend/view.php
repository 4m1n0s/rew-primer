<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\user\models\User;

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
            [
                'label' => 'User #',
                'attribute' => 'id'
            ],
            'username',
            'email',
            'virtual_currency',
            /*[
                'label' => 'Balance',
                'attribute' => 'virtual_currency'
            ],*/
            [
                'attribute' => 'role',
                'headerOptions' => ['width' => '150'],
                'value' => function($model) {
                    return $model->getRoles();
                }
            ],
            [
                'attribute' => 'status',
                'headerOptions' => ['width' => '150'],
                'format' => 'raw',
                'value' => function($model) {
                    return $model->getStatus(true);
                }
            ],
            'first_name',
            'last_name',
            'birthday',
            [
                'attribute' => 'gender',
                'headerOptions' => ['width' => '150'],
                'format' => 'raw',
                'value' => function($model) {
                    return $model->getGenderName();
                }
            ],
        ],
    ]) ?>

</div>
