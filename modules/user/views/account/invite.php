<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\invitation\models\Invitation */

$this->title = Yii::t('app', 'Sign Up');
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle'] = Yii::t('app', 'Sign Up');
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
                            <h1><?= Yii::t('app', 'Sign Up'); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Image Block -->

        <div class="container">
            <div class="container_inner default_template_holder clearfix vertical_padding">
                <div class="vc_row wpb_row section vc_row-fluid">					
                    <div class="full_section_inner clearfix">
                        <div class="vc_col-sm-12 wpb_column vc_column_container">
                            <?php
                            $form = ActiveForm::begin([
                                        'id' => 'register-form',
                                        'options' => ['class' => 'register-form'],
                            ]);
                            ?>
                            <div class="contact_form login_form">
                                <h3>Join Us!</h3>

                                <?php if (Yii::$app->session->hasFlash('error')): ?>
                                    <div class="alert alert-danger">
                                        <button class="close" data-close="alert"></button>
                                        <span>
                                            <?= Yii::$app->session->getFlash('error'); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <?=
                                $form->field($model, 'invitationCode', [
                                    'template' => "{label}\n{input}{error}",
                                    'options' => [
                                        'class' => 'form-row',
                                    ],
                                    'inputOptions' => [
                                        'class' => 'requiredField',
                                        'placeholder' => $model->getAttributeLabel('invitationCode'),
                                        'autocomplete' => 'off',
                                    ],
                                    'errorOptions' => [
                                        'tag' => 'span'
                                    ],
                                ])->textInput();
                                ?>
                                
                                <div class="form-row">
                                    <?= Html::submitButton(Yii::t('app', 'Join'), ['class' => 'qbutton']); ?>
                                    <?= Html::a(Yii::t('app', 'Don\'t have a code? Request one here'), ['/user/account/invition-request']);?>
                                </div>
                            </div> 
                            <?php ActiveForm::end(); ?>
                        </div> 
                    </div>
                </div>																		
            </div>
        </div>
    </div>
</div>