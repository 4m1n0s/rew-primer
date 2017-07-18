<?php
/* @var \app\modules\contact\models\Contact $model */
/* @var \app\modules\pages\models\Page $page */

use yii\helpers\Html;

\romi45\seoContent\components\SeoContentHelper::registerAll($page);
?>

<!-- PAGE TITLE -->
<section id="page-title" class="page-title-parallax page-title-center text-dark" style="background-image:url(/images/page-title-parallax.jpg);">
    <div class="container">
        <div class="page-title col-md-8">
            <h1><?php echo Html::encode($page->title) ?></h1>
            <span><?php echo Html::encode($page->description) ?></span>
        </div>
    </div>
</section>
<!-- END: PAGE TITLE -->
<!-- CONTENT -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php echo $page->content ?>
                <div class="m-t-30">
                    <?php $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'contact-form'
                    ]); ?>
                    <div class="row">
                        <?php echo $form->field($model, 'name', [
                            'options' => [
                                'class' => 'form-group col-sm-6'
                            ]
                        ])->textInput([
                            'placeholder' => 'Enter your Name',
                        ]); ?>
                        <?php echo $form->field($model, 'email', [
                            'options' => [
                                'class' => 'form-group col-sm-6'
                            ]
                        ])->textInput([
                            'placeholder' => 'Enter your Email',
                        ]); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->field($model, 'subject', [
                            'options' => [
                                'class' => 'form-group col-sm-12'
                            ]
                        ])->textInput([
                            'placeholder' => 'Subject...',
                        ]); ?>
                    </div>
                    <?php echo $form->field($model, 'message', [
                        'options' => [
                            'class' => 'form-group'
                        ]
                    ])->textarea([
                        'placeholder' => 'Enter your Message',
                        'rows' => 8
                    ]); ?>
                    <div class="form-group">
                        <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className())->label(false) ?>
                    </div>
                    <?php echo \yii\helpers\Html::submitButton('<i class="fa fa-paper-plane"></i>&nbsp;Send message', ['class' => 'btn btn-primary']); ?>
                    <?php $form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: CONTENT -->