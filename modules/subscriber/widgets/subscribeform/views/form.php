<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

?>

<div class="newsletter-signup">
    <?php Pjax::begin(['id' => 'subscribe-form', 'enablePushState' => false]); ?>
    
        <?php if (Yii::$app->session->hasFlash('subscribe-success')): ?>
            <div class="alert alert-success alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <span class="text-success"><?= Yii::$app->session->getFlash('subscribe-success') ?></span>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('subscribe-error')): ?>
            <div class="alert alert-danger alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <span class="text-danger"><?= Yii::$app->session->getFlash('subscribe-error') ?></span>
            </div>
        <?php endif; ?>

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
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'your.address@email.com']) ?>
        <?= Html::submitInput(Yii::t('app', 'Subscribe')) ?>
        <?php $form->end(); ?>
    <?php Pjax::end(); ?>
</div>