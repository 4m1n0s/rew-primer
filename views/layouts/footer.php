<!-- footer 
                   ================================================== -->
<footer>
    <div class="container">
        <div class="footer-widgets">
            <div class="row">
                <div class="col-md-3">
                    <div class="widgets">
                        <h2><?= Yii::t('app', 'About us')?></h2>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p>Reprehenderit in voluptate velit esse cillum nulla pariatur.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widgets">
                        <h2><?= Yii::t('app', 'Channels')?></h2>
                        <ul class="tag-list">
                            <li><a href="#">Interior</a></li>
                            <li><a href="#">Website</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Medicine</a></li>
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">Photography</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-3">
                    <div class="widgets info-widget">
                        <h2><?= Yii::t('app', 'Working Hours')?></h2>
                        <p class="first-par"><?= Yii::t('app', 'You can contact or visit us during working time.')?></p>
                        <p><span><?= Yii::t('app', 'Tel')?>: </span> 1234 - 5678 - 9012</p>
                        <p><span><?= Yii::t('app', 'Email')?>: </span> nunforest@gmail.com</p>
                        <p><span><?= Yii::t('app', 'Working Hours')?>: </span> 8:00 a.m - 17:00 a.m</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="last-line">
        <div class="container">
            <p class="copyright">
                &copy; <?= Yii::$app->name?> <?= date('Y')?>.
            </p>
        </div>
    </div>
</footer>
<!-- End footer -->