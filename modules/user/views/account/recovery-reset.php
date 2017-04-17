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


<!-- PAGE TITLE -->
<section id="page-title" class="page-title-parallax page-title-center text-dark" style="background-image:url(/images/page-title-parallax.jpg);">
    <div class="container">
        <div class="page-title col-md-8">
            <h1>Password Recover</h1>
        </div>
    </div>
</section>
<!-- END: PAGE TITLE -->
<!-- SECTION -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2>Reset your password</h2>
                <?php $form = ActiveForm::begin([
                    'id' => 'forgot-password-form-reset',
                    'options' => ['class' => 'forget-form'],
                    'fieldConfig' => [
                        'template' => "{input}{error}",
                        'options' => [
                            'class' => 'form-row',
                        ],
                        'errorOptions' => [
                            'tag' => 'span'
                        ],
                    ]
                ]); ?>
                <?= $form->field($model, 'password')->passwordInput([
                    'placeholder' => 'Password'
                ])?>
                <?= $form->field($model, 'confirmPassword')->passwordInput([
                    'placeholder' => 'Confirm Password'
                ])?>
                <div>
                    <?= Html::submitButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-primary']); ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
<!-- END: SECTION -->