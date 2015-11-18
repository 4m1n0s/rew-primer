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
                            <h1><?= Yii::t('app', 'Sign Up');?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Image Block -->

        <div class="container">
            <div class="container_inner clearfix vertical_padding">
                <div class="section">					
                    <div class="full_section_inner clearfix">
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
                                $form->field($model, 'username', [
                                    'template' => "{label}\n{input}{error}",
                                    'options' => [
                                        'class' => 'form-row',
                                    ],
                                    'errorOptions' => [
                                        'tag' => 'span'
                                    ],
                                ])->textInput();
                                ?>

                                <?=
                                $form->field($model, 'email', [
                                    'template' => "{label}\n{input}{error}",
                                    'options' => [
                                        'class' => 'form-row',
                                    ],
                                    'errorOptions' => [
                                        'tag' => 'span'
                                    ],
                                ])->textInput();
                                ?>

                                <?=
                                $form->field($model, 'password', [
                                    'template' => "{label}\n{input}{error}",
                                    'options' => [
                                        'class' => 'form-row',
                                    ],
                                    'errorOptions' => [
                                        'tag' => 'span'
                                    ],
                                ])->passwordInput();
                                ?>

                                <?=
                                $form->field($model, 'confirmPassword', [
                                    'template' => "{label}\n{input}{error}",
                                    'options' => [
                                        'class' => 'form-row',
                                    ],
                                    'errorOptions' => [
                                        'tag' => 'span'
                                    ],
                                ])->passwordInput();
                                ?>

                                <?=
                                $form->field($model, 'referralCode', [
                                    'template' => "{label}\n{input}{error}",
                                    'options' => [
                                        'class' => 'form-row',
                                    ],
                                    'errorOptions' => [
                                        'tag' => 'span'
                                    ],
                                ])->textInput();
                                ?>

                                <?php if ((null !== $data = \app\modules\setting\helpers\SettingHelper::getOption('app-signup')) && isset($data['invite_only']) && (bool) $data['invite_only'] === true): ?>
                                    <?=
                                    $form->field($model, 'invitationCode', [
                                        'template' => "{label}\n{input}{error}",
                                        'options' => [
                                            'class' => 'form-row',
                                        ],
                                        'errorOptions' => [
                                            'tag' => 'span'
                                        ],
                                    ])->textInput();
                                    ?>
                                <?php endif; ?>
                                <p id="terms-register">
                                    <strong>
                                        <?= Yii::t('app', 'By joining you are agreeing to our {link}',[
                                            'link' => Html::a(Yii::t('app', ' terms and conditions'), ['/page/page/show', 'slug' => 'terms'])
                                        ]);?>
                                    </strong>
                                </p><br />
                                <div class="clearfix"></div>
                                <div class="form-row submit">
                                    
                                    <?= Html::submitButton(Yii::t('app', 'Join'), ['class' => 'qbutton']); ?>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                    </div>
                </div>																		
            </div>
        </div>
    </div>
</div>