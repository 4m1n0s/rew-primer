<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\Category */

$this->title = Yii::t('app', 'Create Category');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Categories'),
    'url' => ['index'],
    'template' => '<li> {link} <i class="fa fa-circle"></i></li>'
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i><?= Html::encode($this->title); ?>
        </div>
    </div>
    <div class="portlet-body form">
        <?= $this->render('_form', [
            'model' => $model
        ]) ?>
    </div>
</div>
