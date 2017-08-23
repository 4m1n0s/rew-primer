<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\search\LogPostbackSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-postback-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'offer_id') ?>

    <?= $form->field($model, 'prefix') ?>

    <?php // echo $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'log_vars') ?>

    <?php // echo $form->field($model, 'log_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
