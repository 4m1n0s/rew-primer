<?php
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
                        <div class="seperator"><span>Login Information</span></div>
                        <div class="col-md-12">
                            <dl class="dl-horizontal">
                                <dt>Username</dt>
                                <dd><?php echo Html::a($currentUser->username, '#') ?></dd>
                                <dt>Email</dt>
                                <dd><?php echo Html::a($currentUser->email, '#') ?></dd>
                                <dt>Password</dt>
                                <dd><?php echo Html::a('******', '#') ?></dd>
                            </dl>
                        </div>
                        <div class="seperator"><span>Personal Information</span></div>
                        <div class="col-md-12">
                            <dl class="dl-horizontal">
                                <dt>First Name</dt>
                                <dd><?php echo Html::a($currentUser->first_name, '#')?></dd>
                                <dt>Last Name</dt>
                                <dd><?php echo Html::a($currentUser->last_name, '#')?></dd>
                                <dt>Birthday</dt>
                                <dd><?php echo Html::a($currentUser->birthday, '#')?></dd>
                                <dt>Gender</dt>
                                <dd><?php echo Html::a($currentUser->gender ? 'Male' : 'Female', '#')?></dd>
                            </dl>
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