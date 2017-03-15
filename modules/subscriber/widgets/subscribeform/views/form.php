<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

?>

<div class="newsletter-signup">
    <?php Pjax::begin(['id' => 'subscribe-form', 'enablePushState' => false]); ?>

        <?php
        $form = ActiveForm::begin([
                    'action' => '/subscriber/ajax/subscribe',
                    'options' => [
                        'data-pjax' => true,
                    ],
                    'fieldConfig' => [
                        'template' => "{input}{error}",
                    ],
        ]);
        ?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Enter your email to get started']) ?>
        <?= Html::submitInput(Yii::t('app', 'Subscribe'), ['class' => 'btn-subscribe']) ?>
        <?php $form->end(); ?>
    
        <?php if (Yii::$app->session->hasFlash('subscribe-success')): ?>
            <div class="alert alert-success alert-dismissible fade in">
                <span class="text-success"><?= Yii::$app->session->getFlash('subscribe-success') ?></span>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('subscribe-error')): ?>
            <div class="alert alert-danger alert-dismissible fade in">
                <span class="text-danger"><?= Yii::$app->session->getFlash('subscribe-error') ?></span>
            </div>
        <?php endif; ?>

    <?php Pjax::end(); ?>
</div>