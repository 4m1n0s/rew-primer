<section class="content">
    <div class="container">
        <div class="row">

            <!-- post content -->
            <div class="post-content col-md-9">
                <!-- Post item-->
                <div class="post-item">
                    <div class="post-content-details">
                        <div class="seperator"><span>Referral Link</span></div>
                        <blockquote>
                            <p>Your Code is <strong><?php echo $referralCode; ?></strong>
                                <br>Share Link below to get percents!
                            </p>
                            <p></p>
                            <p><?php echo $referralLink ?></p>
                        </blockquote>

                        <?php if ($dataProvider->count): ?>
                            <div class="seperator"><span>Referrals</span></div>
                            <?php \yii\widgets\Pjax::begin();
                            echo \yii\grid\GridView::widget([
                                'dataProvider' => $dataProvider,
                                'tableOptions' => [
                                    'class' => 'table table-striped',
                                ],
                                'columns' => [
                                    'username',
                                    'first_name',
                                    'last_name',
                                    'email:email'
                                ]
                            ]);
                            \yii\widgets\Pjax::end(); ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <!-- END: post content -->

            <!-- Sidebar-->
            <div class="sidebar col-md-3">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Panel title</h3>
                    </div>
                    <div class="panel-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo.
                    </div>
                </div>

                <div class="panel panel-primary">
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