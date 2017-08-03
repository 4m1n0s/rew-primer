<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\EmailTemplate */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Email Template',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Email Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="email-template-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>