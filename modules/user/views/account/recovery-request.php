<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\invitation\models\Invitation */


$this->title = Yii::t('app', 'Forgot password');
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle'] = Yii::t('app', 'Forgot password');
?>


<div class="content">
    <div class="title_outer" data-height="500">
        <!-- Image Block -->
        <div class="title has_fixed_background faq_bg">
            <div class="image not_responsive">
                <img src="/img/faq.jpg" alt="" /> 
            </div>
            <div class="title_holder faq_title">
                <div class="container">
                    <div class="container_inner clearfix">
                        <div class="title_subtitle_holder">
                            <h1>Some title</h1>
                            <span class="subtitle">Some Slogan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Image Block -->
        <div class="container">
            <div class="container_inner default_template_holder clearfix vertical_padding">
                <div class="vc_row wpb_row section vc_row-fluid">					
                    <div class="full_section_inner clearfix">
                        <div class="vc_col-sm-12 wpb_column vc_column_container">
                            <!-- Login Form -->
                            <?php
                            $form = ActiveForm::begin([
                                        'id' => 'forgot-password-form',
                                        'options' => ['class' => 'forget-form']
                            ]);
                            ?>
                            <div class="contact_form login_form">
                                <h3><?= Yii::t('app', 'Forget Password ?') ?></h3>

                                <?php if (Yii::$app->session->hasFlash('error')): ?>
                                    <div class="alert alert-danger">
                                        <button class="close" data-close="alert"></button>
                                        <span>
                                            <?= Yii::$app->session->getFlash('error'); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <?=
                                $form->field($model, 'email', [
                                    'template' => "{label}\n{input}{error}",
                                    'options' => [
                                        'class' => 'form-row',
                                    ],
                                    'errorOptions' => [
                                        'tag' => 'span'
                                    ],
                                ])
                                ?>

                                <div class="form-row submit">
                                    <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'qbutton']); ?>
                                </div>

                            </div> 
                            <?php ActiveForm::end(); ?>
                            <!-- Login Form -->
                        </div> 
                    </div>
                </div>																		
            </div>
        </div>
    </div>
</div>