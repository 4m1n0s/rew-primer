<!-- post content -->
<div class="post-content">
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