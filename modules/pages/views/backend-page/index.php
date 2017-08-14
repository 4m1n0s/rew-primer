<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pages\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['pageTitle'] = $this->title;
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('actions') ?>
<?= Html::a('<i class="fa fa-plus"></i> <span class="">'.Yii::t('user/admin', 'New Page').'</span>', ['create'], ['class' => 'btn btn-info btn-circle']); ?>
<?php $this->endBlock() ?>

<div class="page-index">
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => \app\modules\dashboard\helpers\GridViewTemplateHelper::baseLayout(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'template',
                'value' => function($row) {
                    return $row->getTemplateName();
                }
            ],
            'title',
            'description:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'min-width:100px;width:100px'],
                'template' => '{update} {delete}',
            ]
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>