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

<section class="parallax text-light fullscreen" style="background-image: url(/images/apple-1867762_1920.jpg)">
    <div class="container container-fullscreen">
        <div class="text-middle text-light">
            <div class="row">
                <div class="col-md-3 center" style="background-color: #101010 !important; opacity: 0.95; ">
                    <div style="padding: 20px 0 20px 0">
                        <h3>Login to your Account</h3>

                        <div class="form-group btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <?php echo Html::a('<i class="fa fa-facebook"></i> facebook',
                                    ['/user/account/auth', 'authclient'=> Yii::$app->authClientCollection->getClient('facebook')->name],
                                    ['class' => 'social-facebook btn-sm btn']
                                ) ?>
                            </div>
                            <div class="btn-group" role="group">
                                <?php echo Html::a('<i class="fa fa-twitter"></i> twitter',
                                    ['/user/account/auth', 'authclient'=> Yii::$app->authClientCollection->getClient('twitter')->name],
                                    ['class' => 'social-twitter btn-sm btn']
                                ) ?>
                            </div>
                            <div class="btn-group" role="group">
                                <?php echo Html::a('<i class="fa fa-google-plus"></i> google',
                                    ['/user/account/auth', 'authclient'=> Yii::$app->authClientCollection->getClient('google')->name],
                                    ['class' => 'social-google btn-sm btn']
                                ) ?>
                            </div>
                        </div>

                        <div class="form-group-or text-center">
                            <p>or</p>
                        </div> 

                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'frontend-login-form',
                            'options' => ['class' => 'form-grey-fields'],
                        ]);
                        ?>
                        <?= $form->field($model, 'username')->textInput([
                            'placeholder' => Yii::t('app', 'Email or Username'),
                            'class' => ' form-control input-lg',
                        ])->label(false); ?>
                        <?= $form->field($model, 'password')->passwordInput([
                            'placeholder' => Yii::t('app', 'Password'),
                            'class' => ' form-control input-lg',
                        ])->label(false); ?>
                        <p><?= Html::a('Lost your Password?', ['/user/account/recovery-request']) ?></p>
                        <div class="text-left form-group">
                            <?= Html::submitButton(Yii::t('app', 'Log In'), ['class' => 'btn btn-primary']); ?>
                            <p class="text-left">Don't have an account yet?<br><?= Html::a(Yii::t('app', 'Register New Account'), ['/user/account/sign-up']); ?></p>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>