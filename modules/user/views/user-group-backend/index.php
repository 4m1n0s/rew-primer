<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\search\UserGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Groups';
$this->params['pageTitle'] = Yii::t('user/admin', 'User Groups');
$this->params['pageSmallTitle'] = Yii::t('user/admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('actions')?>
<?= Html::a('<i class="fa fa-plus"></i> <span class="">'.Yii::t('user/admin', 'New Group').'</span>', ['create'], ['class' => 'btn btn-info btn-circle']); ?>
<?php $this->endBlock()?>

<?php
$template = "
    <div class=\"table-scrollable\">
        {items} 
    </div>
    <div class=\"row\"> 
        <div class=\"col-md-5 col-sm-12\">
            <div class=\"dataTables_info\" id=\"sample_1_info\">{summary}</div>
        </div>
        <div class=\"col-md-7 col-sm-12\">
            <div class=\"dataTables_paginate paging_bootstrap\">
                {pager}
            </div>
        </div>
    </div>";
Pjax::begin(['id' => 'invitation-grid', 'enablePushState' => true]);
?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [

        'name',

        [
            'class' => \yii\grid\ActionColumn::class,
            'headerOptions' => ['style' => 'min-width:100px;width:100px'],
            'template' => '{update} {delete}'
        ]
    ],
]);
?>
<?php Pjax::end(); ?>
