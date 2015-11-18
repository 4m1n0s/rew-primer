<!-- Header
                ================================================== -->
<header class="clearfix">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="top-line">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="info-list">
                            <li>
                                <i class="fa fa-phone"></i>
                                Call us:
                                <span>1234 - 5678 - 9012</span>
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"></i>
                                Email us:
                                <span>nunforest@gmail.com</span>
                            </li>
                            <li>
                                <i class="fa fa-clock-o"></i>
                                working time:
                                <span>08:00 - 17:00</span>
                            </li>
                        </ul>
                    </div>	
                    <div class="col-md-4">
                        <ul class="social-icons">
                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
                            <li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>	
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt=""></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
                
                <?php
                    echo yii\widgets\Menu::widget([
                            'encodeLabels' => false,
                            'activateParents' => true,
                            'submenuTemplate' => "\n<ul class=\"drop-down\">\n{items}\n</ul>\n",
                            'options' => [
                                'class' => 'nav navbar-nav navbar-right'
                            ],
                            'items' => [
                                [
                                    'label' => Yii::t('app', 'Home'),
                                    'url' => ['/site/index'],
                                ],
                                [
                                    'label' => Yii::t('app', 'Contact'),
                                    'url' => ['/site/index'],
                                ],
                                [
                                    'label' => '<a href="#" class="open-search"><i class="fa fa-search"></i></a>
                                    <form class="form-search">
                                        <input type="search" placeholder="Search:"/>
                                        <button type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>',
                                    'linkTemplate' => '{label}',
                                    'options' => [
                                        'class' => 'search'
                                    ],
                                ],

                            ]
                    ]);
                ?>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<!-- End Header -->