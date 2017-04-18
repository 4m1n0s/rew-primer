<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\settings\models\Settings */

$this->title = Yii::t('app', 'Edit {modelClass}', [
    'modelClass' => 'Settings',
]);

$this->title = $this->title;
$this->params['pageTitle'] = Yii::t('app', 'Settings');
$this->params['pageSmallTitle'] = Yii::t('app', 'edit');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i><?= Html::encode($this->title); ?>
        </div>
    </div>
    <div class="portlet-body form">
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
</div>
