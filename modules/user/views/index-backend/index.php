<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user/admin', 'Users');
$this->params['pageTitle'] = Yii::t('user/admin', 'Users');
$this->params['pageSmallTitle'] = Yii::t('user/admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'] = [
    'Users',
];
?>

<?php $this->beginBlock('actions')?>
<?= Html::a('<i class="fa fa-plus"></i> <span class="hidden-480">'.Yii::t('user/admin', 'New User').'</span>', ['create'], ['class' => 'btn default yellow-stripe']); ?>
<?php $this->endBlock()?>

<?php Pjax::begin(['id' => 'user-grid', 'enablePushState' => false]); ?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'label' => 'User #',
            'attribute' => 'id',
            'headerOptions' => [
                'width' => '100',
            ],
        ],
        [
            'attribute' => 'username',
            'headerOptions' => [
                'width' => '200',
            ],
        ],
        'email:email',
        [
            'label' => 'Balance',
            'attribute' =>  'virtual_currency',
        ],
        [
            'attribute' => 'role',
            'filter' => $roleList,
            'headerOptions' => ['width' => '150'],
            'value' => function($model) {
                return $model->getRoles();
            }
        ],
        [
            'attribute' => 'status',
            'filter' => $statusList,
            'headerOptions' => ['width' => '150'],
            'format' => 'raw',
            'value' => function($model) {
                return $model->getStatus(true);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('user/admin', 'Actions'),
            'headerOptions' => ['style' => 'min-width:110px;width:auto'],
            'buttons' => \yii\helpers\ArrayHelper::merge(
               \app\modules\dashboard\helpers\GridViewTemplateHelper::baseActionButtons(), [
                'orders' => function($url, $model) {
                    return Html::a('<i class="fa fa-shopping-cart"></i>', $url,  [
                        'title' => 'Orders',
                        'class' => 'btn btn-sm btn-default btn-circle btn-editable',
                        'data-pjax' => 0,
                        'target' => '_blank',
                    ]);
                },
                'offers' => function($url, $model) {
                    return Html::a('<i class="fa fa-cubes"></i>', $url,  [
                        'title' => 'Offers',
                        'class' => 'btn btn-sm btn-default btn-circle btn-editable',
                        'data-pjax' => 0,
                        'target' => '_blank',
                    ]);
                },
                'referrals' => function($url, $model) {
                    return Html::a('<i class="icon-user-following"></i>', $url,  [
                        'title' => 'Referrals',
                        'class' => 'btn btn-sm btn-default btn-circle btn-editable',
                        'data-pjax' => 0,
                        'target' => '_blank',
                    ]);
                },
            ]),
            'template' => '{referrals} {offers} {orders} {view} {update} {delete}',
        ],
    ],
]);
?>
<?php Pjax::end(); ?>