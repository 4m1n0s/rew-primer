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
    <?= Html::a('<i class="fa fa-plus"></i> <span class="hidden-480">'.Yii::t('user/admin', 'New Group').'</span>', ['create'], ['class' => 'btn default yellow-stripe']); ?>
    <?php //echo Html::a('<i class="fa  fa-cloud-download"></i> <span class="hidden-480">' . Yii::t('user/admin', 'Export All') . '</span>', ['export'], ['class' => 'btn default yellow-stripe', 'id' => 'jsf-import-button']); ?>
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
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-hover'
    ],
    'headerRowOptions' => [
        'class' => 'heading'
    ],
    'pager' => [
        'firstPageLabel' => Yii::t('user/admin', 'First'),
        'lastPageLabel' => Yii::t('user/admin', 'Last'),
    ],
    'layout' => $template,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [

        'name',

        [
            'class' => \yii\grid\ActionColumn::class,
            'headerOptions' => [
                'style' => 'width:50px'
            ],
            'template' => '{update} {delete}'
        ]
    ],
]);
?>
<?php Pjax::end(); ?>
