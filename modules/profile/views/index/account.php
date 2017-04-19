<?php
/* @var \yii\web\View $this */
/* @var \app\modules\user\models\User $currentUser */

use yii\helpers\Html;
?>
<section class="content">
    <div class="container">
        <div class="row">

            <!-- post content -->
            <div class="post-content col-md-9">
                <!-- Post item-->
                <div class="post-item">
                    <div class="post-content-details">
                        <div class="col-md-12">
                            <div class="seperator"><span>Login Information</span></div>
                            <?php \yii\widgets\Pjax::begin(['id' => 'login-info-pjax', 'enablePushState' => true]); ?>
                            <?php echo $this->render('_login-info', [
                                'currentUser' => $currentUser
                            ]); ?>
                            <?php \yii\widgets\Pjax::end(); ?>
                        </div>

                        <div class="seperator"><span>Personal Information</span></div>
                        <div class="col-md-12">
                            <?php \yii\widgets\Pjax::begin(['id' => 'personal-info-pjax', 'enablePushState' => true]); ?>
                            <?php echo $this->render('_personal-info', [
                                'currentUser' => $currentUser
                            ]); ?>
                            <?php \yii\widgets\Pjax::end(); ?>
                        </div>
                    </div>
                </div>

            </div>
            <!-- END: post content -->

            <!-- Sidebar-->
            <div class="sidebar col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Panel title</h3>
                    </div>
                    <div class="panel-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo.
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Panel title</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-posts list-medium">
                            <li><a href="#">Printing and typesetting</a></li>
                            <li><a href="#">Lorem Ipsum has been the industry's</a></li>
                            <li><a href="#">Ipsum and typesetting</a></li>
                            <li><a href="#">Specimen book</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- END: Sidebar-->
        </div>
    </div>
</section>