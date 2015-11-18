<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\invitation\models\Invitation */

$this->title = Yii::t('app', 'Sign In');
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle'] = Yii::t('app', 'Sign In');
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
                            <h1><?= Yii::t('app', 'Sign In');?></h1>
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
                            <!-- Login Form -->
                            <?php
                            $form = ActiveForm::begin([
                                        'id' => 'login-form',
                                        'options' => ['class' => 'login-form'],
                            ]);
                            ?>
                            <div class="contact_form login_form">
                                <h3><?= Yii::t('app', 'Login and Enjoy Our Service!');?></h3>
                                <?php if (Yii::$app->session->hasFlash('success')): ?>
                                    <div class="alert alert-success">
                                        <button class="close" data-close="alert"></button>
                                        <span>
                                            <?= Yii::$app->session->getFlash('success'); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php if (Yii::$app->session->hasFlash('error')): ?>
                                    <div class="alert alert-danger">
                                        <button class="close" data-close="alert"></button>
                                        <span>
                                            <?= Yii::$app->session->getFlash('error'); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?=
                                $form->field($model, 'username', [
                                    'options' => [
                                        'class' => 'form-row',
                                    ],
                                    'template' => "{label}\n{input}",
                                    'inputOptions' => [
                                        'class' => 'requiredField',
                                        'placeholder' => 'Username or Email',
                                        'autocomplete' => 'off',
                                    ]
                                ])
                                ?>
                                <?php $forgotLink = Html::a(Yii::t('app', 'Forgot Password'), ['/user/account/recovery-request']) ?>
                                <?=
                                $form->field($model, 'password', [
                                    'template' => "{label}\n$forgotLink\n{input}",
                                    'inputOptions' => [
                                        'class' => 'requiredField',
                                        'placeholder' => 'Password',
                                        'autocomplete' => 'off',
                                    ]
                                ])->passwordInput()
                                ?>
                                <div class="form-row submit">
                                    <?= Html::submitButton(Yii::t('app', 'Log In'), ['class' => 'qbutton']); ?>
                                    <?php if(isset($settings['invite_only']) && (bool)$settings['invite_only'] == false):?>
                                        <?= Html::a(Yii::t('app', 'Sign Up'), ['/user/account/register'], ['class' => 'qbutton']); ?>
                                    <?php else: ?>
                                        <?= Html::a(Yii::t('app', 'Not a member yet? Request invition code here'), ['/user/account/invition-request']);?>
                                    <?php endif; ?>
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