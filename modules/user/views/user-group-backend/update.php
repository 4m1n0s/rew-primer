<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\UserGroup */

$this->title = 'Update User Group: ' . $model->name;
$this->params['breadcrumbs'][] = [
    'label' => 'User Groups',
    'url' => ['index'],
    'template' => '<li> {link} <i class="fa fa-circle"></i></li>'
];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-group-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>
</div>