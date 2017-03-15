<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \app\modules\user\models\User  */

$this->registerCssFile('/backend/pages/css/profile.min.css', ['depends' => [\app\assets\BackendAsset::className()]]);
$this->registerCssFile('/backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css', ['depends' => [\app\assets\BackendAsset::className()]]);
$this->registerCssFile('/backend/global/css/components.min.css', ['depends' => [\app\assets\BackendAsset::className()]]);
$this->registerCssFile('/backend/global/css/plugins.min.css', ['depends' => [\app\assets\BackendAsset::className()]]);

$this->registerJsFile('/backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js', ['depends' => [\app\assets\BackendAsset::className()]]);

$this->registerJs(" 
        $(function(){
            $(document).on('clear.bs.fileinput', function(e){
                var thumbnail = $(e.target).children('.fileinput-preview');
                var src = 'http://www.placehold.it/' + thumbnail.outerWidth() + 'x' + thumbnail.outerHeight() + '/EFEFEF/AAAAAA&amp;text=no+image';
                thumbnail.append('<img src=\"' + src + '\" alt=\"\">');
            });
        });", yii\web\View::POS_END);

$this->title = Yii::t('admin', 'Account');
$this->params['pageTitle'] = $this->title;
$this->params['pageSmallTitle'] = Yii::t('admin', 'user account page');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'] = [
    'User',
];
?>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet ">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <?php if(!is_null($user->avatar)): ?>
                        <img src="<?= $user->avatar ?>" alt="<?= Yii::t('admin', 'User avatar') ?>" class="img-responsive">
                    <?php else: ?>
                        <img src="http://www.placehold.it/150x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" class="img-responsive">
                    <?php endif;?>
                </div>
                <!-- END SIDEBAR USERPIC -->

                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?= $user->name ?> </div>
                    <div class="profile-usertitle-job"> <?= $user->roles ?> </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->

            </div>
            <!-- END PORTLET MAIN -->

        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase"><?= Yii::t('admin', 'Profile Account')?></span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab"><?= Yii::t('admin', 'Personal Info')?></a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab"><?= Yii::t('admin', 'Change Avatar')?></a>
                                </li>
                                <li>
                                    <a href="#tab_1_3" data-toggle="tab"><?= Yii::t('admin', 'Change Password')?></a>
                                </li>

                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <?php
                                    $form = ActiveForm::begin([
                                                'options' => [
                                                    'enctype' => 'multipart/form-data'
                                                ],
                                                'fieldConfig' => [
                                                    'options' => [
                                                        'class' => 'form-group'
                                                    ],
                                                    'template' => "{label}{input}{error}",
                                                    'inputOptions' => [
                                                        'class' => 'form-control',
                                                    ],
                                                    'labelOptions' => [
                                                        'class' => 'control-label'
                                                    ]
                                                ],
                                    ]);
                                    ?>

                                    <?= $form->field($model, 'firstName')->textInput() ?>
                                    <?= $form->field($model, 'lastName')->textInput() ?>
                                    <?= $form->field($model, 'phone')->textInput() ?>
                                    <?= $form->field($model, 'interests')->textInput(['rows' => 6]) ?>
                                    <?= $form->field($model, 'about')->textarea(['rows' => 3]) ?>

                                    <div class="margiv-top-10">
                                        <?= Html::submitButton(Yii::t('admin', 'Save Changes'), ['class' => 'btn green']) ?>
                                    </div>

                                    <?php ActiveForm::end(); ?>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="tab_1_2">

                                    <?php
                                    $form = ActiveForm::begin([
                                                'options' => [
                                                    'enctype' => 'multipart/form-data'
                                                ],
                                                'fieldConfig' => [
                                                    'options' => [
                                                        'class' => 'form-group'
                                                    ],
                                                    'template' => "{label}{input}{error}",
                                                    'inputOptions' => [
                                                        'class' => 'form-control',
                                                    ],
                                                    'labelOptions' => [
                                                        'class' => 'control-label'
                                                    ]
                                                ],
                                    ]);
                                    ?>
                                        <div class="form-group">
                                            
                                            <?php if(!is_null($user->avatar)): ?>
                                                <div class="fileinput fileinput-exists" data-provides="fileinput">
                                            <?php else: ?>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <?php endif;?>
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 167px;">
                                                    <?php if(!is_null($user->avatar)): ?>
                                                        <img src="<?= $user->avatar ?>" alt="<?= Yii::t('admin', 'User avatar') ?>">
                                                    <?php else: ?>
                                                        <img src="http://www.placehold.it/200x167/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                                                    <?php endif;?>
                                                </div>
                                                <div>
                                                    <span class="btn red btn-outline btn-file">
                                                        <span class="fileinput-new"> <?= Yii::t('app', 'Select image')?> </span>
                                                        <span class="fileinput-exists"> <?= Yii::t('app', 'Change')?> </span>
                                                        <?= Html::activeFileInput($model, 'fileAvatar') ?>
                                                    </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> <?= Yii::t('app', 'Remove')?> </a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="margiv-top-10">
                                            <?= Html::submitButton(Yii::t('admin', 'Submit'), ['class' => 'btn green']) ?>
                                        </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="tab_1_3">
                                    <?php
                                    $form = ActiveForm::begin([
                                                'options' => [
                                                    'enctype' => 'multipart/form-data'
                                                ],
                                                'fieldConfig' => [
                                                    'options' => [
                                                        'class' => 'form-group'
                                                    ],
                                                    'template' => "{label}{input}{error}",
                                                    'inputOptions' => [
                                                        'class' => 'form-control',
                                                    ],
                                                    'labelOptions' => [
                                                        'class' => 'control-label'
                                                    ]
                                                ],
                                    ]);
                                    ?>

                                    <?= $form->field($model, 'currentPassword')->passwordInput() ?>
                                    <?= $form->field($model, 'newPassword')->passwordInput() ?>
                                    <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

                                    <div class="margiv-top-10">
                                        <?= Html::submitButton(Yii::t('admin', 'Change Password'), ['class' => 'btn green']) ?>
                                    </div>

                                    <?php ActiveForm::end(); ?>

                                </div>
                                <!-- END CHANGE PASSWORD TAB -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>