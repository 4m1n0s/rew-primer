<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\core\models\search\EmailTemplate */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Email Templates');
$this->params['pageTitle'] = $this->title;
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-template-index">
<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layout' => \app\modules\dashboard\helpers\GridViewTemplateHelper::baseLayout(),
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'name',
        'subject',

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('user/admin', 'Actions'),
            'headerOptions' => ['style' => 'min-width:40px;width:40px'],
            'buttons' => \app\modules\dashboard\helpers\GridViewTemplateHelper::baseActionButtons(),
            'template' => '{update}',
        ]
    ],
]); ?>
<?php Pjax::end(); ?>
</div>
