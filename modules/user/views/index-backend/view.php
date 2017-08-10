<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\user\models\User;

/* @var $this yii\web\View */
/* @var $model User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <?php

    $specificData = [];
    if ($model->role == User::ROLE_PARTNER) {
        $specificData = [
            [
                'label' => 'referral_percents',
                'value' => function($model) {
                    return $model->getReferralPercents();
                }
            ],
            [
                'label' => 'referral_percents_value',
                'value' => function($model) {
                    return $model->getReferralRegisterValue();
                }
            ]
        ];
    } else {
        $specificData = [
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
        ];
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => \yii\helpers\ArrayHelper::merge([
            [
                'label' => 'User #',
                'attribute' => 'id'
            ],
            'username',
            'email',
            'referral_code',
            'virtual_currency',
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

        ], $specificData),
    ]) ?>

</div>
