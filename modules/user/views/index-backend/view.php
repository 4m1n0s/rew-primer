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
            'id',
            'username',
            'email',
            'virtual_currency',
            [
                'attribute' => 'role',
                'filter' => User::getRoleList(),
                'headerOptions' => ['width' => '150'],
                'value' => function($model) {
                    return $model->getRoles();
                }
            ],
            [
                'attribute' => 'status',
                'filter' => User::getStatusList(),
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
                'filter' => User::getStatusList(),
                'headerOptions' => ['width' => '150'],
                'format' => 'raw',
                'value' => function($model) {
                    return $model->getGenderName();
                }
            ],
        ],
    ]) ?>

</div>
