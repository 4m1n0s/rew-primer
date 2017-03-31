<?php

use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use app\assets\DatePickerAsset;
use yii\bootstrap\Html;

DatePickerAsset::register($this);

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\forms\RegistrationForm */

?>


<!-- PAGE TITLE -->
<section id="page-title">
    <div class="container">
        <div class="page-title col-md-8">
            <h1>User Register</h1>
            <span>User register page</span>
        </div>
    </div>
</section>
<!-- END: PAGE TITLE -->
<!-- SECTION -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 center no-padding">
                <div class="col-md-12">
                    <h3>Register New Account</h3>
                    <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p></div>
                <?php yii\widgets\Pjax::begin(['id' => 'register', 'enablePushState' => false]) ?>

                <?php
                $form = ActiveForm::begin([
                    'options' => [
//                        'data-pjax' => 1,
                        'id' => 'sign-form',
                        'enctype' => 'multipart/form-data'
                    ],
                    'fieldConfig' => [
                        'template' => '<div class="col-md-6"><label class="sr-only">{label}</label>{input}{error}</div>',
                    ],
//                    'enableClientValidation' => true,
//                    'enableClientScript' => true,
//                    'enableAjaxValidation' => true,
                ]);
                ?>
                <div class="row">
                    <?=
                    $form->field($model, 'first_name')->textInput([
                        'placeholder' => Yii::t('app', 'First Name'),
                        'class' => 'form-control input-lg'
                    ]);
                    ?>
                    <?=
                    $form->field($model, 'last_name')->textInput([
                        'placeholder' => Yii::t('app', 'Last Name'),
                        'class' => 'form-control input-lg'
                    ]);
                    ?>
                </div>
                <div class="row">

                    <?=
                    $form->field($model, 'username')->textInput([
                        'placeholder' => Yii::t('app', 'Username'),
                        'class' => 'form-control input-lg'
                    ]);
                    ?>
                    <?=
                    $form->field($model, 'email')->textInput([
                        'placeholder' => Yii::t('app', 'E-mail'),
                        'type' => 'email',
                        'class' => 'form-control input-lg'
                    ]);
                    ?>

                </div>

                    <?php
                    echo $form->field($model, 'password')->passwordInput([
                        'placeholder' => Yii::t('app', 'Password'),
                        'type' => 'password',
                        'class' => 'form-control input-lg'
                    ]);
                    ?>

                    <?php
                    echo $form->field($model, 'confirmPassword')->passwordInput([
                        'placeholder' => Yii::t('app', 'Confirm password'),
                        'class' => 'form-control input-lg'
                    ]);
                    ?>



                    <?=
                    $form->field($model, 'birthday', [
                        'template' => '
                        <div class="col-md-6 form-group">
                            {input}
                        </div>'
                    ])->textInput([
                        'placeholder' => Yii::t('app', 'Birthday'),
                        'class' => 'form-control',
                        'id' => 'datePickerBirthday'
                    ]);
                    ?>

                    <?=
                    $form->field($model, 'gender')->dropDownList($model->getGender(), [
                        'prompt' => Yii::t('app', 'Gender'),
                        'class' => 'form-control input-lg'
                    ]);
                    ?>
                <div class="row">

                    <div class="col-md-12 form-group">
                        <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>

                        </div>
                    </div>



                <div class="col-md-12 form-group">
                    <?php echo Html::submitButton(Yii::t('app', 'Register New Account'), ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                <?php yii\widgets\Pjax::end() ?>


            </div>

        </div>
    </div>
</section>

<?php

$js = <<<JS
$(function () {
    $('#datePickerBirthday').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD',
                useCurrent: false
            });
});
JS;
$this->registerJs($js, $this::POS_READY);
