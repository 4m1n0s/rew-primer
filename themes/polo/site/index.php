<?php

    $urlPortfolio = '/images/portfolio/';
    $urlMockup = '/images/mockup/';

?>


<!-- WELCOME -->
<section class="p-b-0">
    <div class="container">
        <div class="heading heading-center m-b-40">
            <h2>WELCOME TO THE WORLD OF <?= Yii::$app->name ?></h2>
        </div>
    </div>
</section>
<!-- END: WELCOME -->

<!-- WHAT WE DO -->
<section class="background-grey">
    <div class="container">
        <div class="heading text-left">
            <h2>WHAT WE DO</h2>
            <span class="lead">Create amam ipsum dolor sit amet, consectetur adipiscing elit.</span>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="text-box" data-animation="fadeInUp" data-animation-delay="0">
                    <h4>Modern Design</h4>
                    <p>Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-box" data-animation="fadeInUp" data-animation-delay="200">
                    <h4>Loaded with Features</h4>
                    <p>Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-box" data-animation="fadeInUp" data-animation-delay="400">
                    <h4>Completely Customizable</h4>
                    <p>Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-box" data-animation="fadeInUp" data-animation-delay="600">
                    <h4>100% Responsive Layout</h4>
                    <p>Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-box" data-animation="fadeInUp" data-animation-delay="800">
                    <h4>Clean Modern Code</h4>
                    <p>Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-box" data-animation="fadeInUp" data-animation-delay="1000">
                    <h4>Free Updates & Support</h4>
                    <p>Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam.</p>
                </div>
            </div>


        </div>
    </div>
</section>
<!-- END WHAT WE DO -->

<!-- PORTFOLIO -->
<section class="p-b-0">
    <div class="container">
        <div class="heading text-left">
            <h2>RECENT WORK</h2>
            <span class="lead">Lorem ipsum dolor sit amet, coper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto.</span>
        </div>
    </div>
    <div class="portfolio">
        <!-- Portfolio Items -->
        <div id="isotope" class="isotope portfolio-items" data-isotope-item-space="0" data-isotope-mode="masonry" data-isotope-col="4" data-isotope-item=".portfolio-item">
            <div class="portfolio-item design artwork">
                <div class="image-box effect victor"> <img src="<?= $urlMockup ?>1.jpg" alt="">
                    <div class="image-box-content">
                        <h3>Fast Skateboard</h3>
                        <p>Consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
            <div class="portfolio-item design beauty">
                <div class="image-box effect victor"> <img src="<?= $urlMockup ?>2.jpg" alt="">
                    <div class="image-box-content">
                        <h3>Working hard</h3>
                        <p>Consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
            <div class="portfolio-item design beauty">
                <div class="image-box effect victor"> <img src="<?= $urlMockup ?>3.jpg" alt="">
                    <div class="image-box-content">
                        <h3>The feather man</h3>
                        <p>Consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
            <div class="portfolio-item design artwork">
                <div class="image-box effect victor"> <img src="<?= $urlMockup ?>4.jpg" alt="">
                    <div class="image-box-content">
                        <h3>The long line</h3>
                        <p>Consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
            <div class="portfolio-item banner beauty">
                <div class="image-box effect victor"> <img src="<?= $urlMockup ?>5.jpg" alt="">
                    <div class="image-box-content">
                        <h3>Backwards</h3>
                        <p>Consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
            <div class="portfolio-item design artwork banner">
                <div class="image-box effect victor"> <img src="<?= $urlMockup ?>6.jpg" alt="">
                    <div class="image-box-content">
                        <h3>Disappointed horse</h3>
                        <p>Consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
            <div class="portfolio-item design artwork">
                <div class="image-box effect victor"> <img src="<?= $urlMockup ?>7.jpg" alt="">
                    <div class="image-box-content">
                        <h3>Wire's</h3>
                        <p>Consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
            <div class="portfolio-item design marketing">
                <div class="image-box effect victor"> <img src="<?= $urlMockup ?>8.jpg" alt="">
                    <div class="image-box-content">
                        <h3>Forcing</h3>
                        <p>Consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Portfolio Items -->

    </div>
</section>
<!-- END: PORTFOLIO -->

<!-- SERVICES -->
<section>
    <div class="container">
        <div class="heading heading-center">
            <h2>SERVICES</h2>
            <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
        </div>

        <div class="row">
            <div class="col-md-4" data-animation="fadeInUp" data-animation-delay="0">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-plug"></i></a>
                    </div>
                    <h3>Powerful template</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
            <div class="col-md-4" data-animation="fadeInUp" data-animation-delay="200">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-desktop"></i></a>
                    </div>
                    <h3>Flexible Layouts</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
            <div class="col-md-4" data-animation="fadeInUp" data-animation-delay="400">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-cloud"></i></a>
                    </div>
                    <h3>Retina Ready</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>

            <div class="col-md-4" data-animation="fadeInUp" data-animation-delay="600">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-lightbulb-o"></i></a>
                    </div>
                    <h3>Fast processing</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
            <div class="col-md-4" data-animation="fadeInUp" data-animation-delay="800">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-trophy"></i></a>
                    </div>
                    <h3>Unlimited Colors</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
            <div class="col-md-4" data-animation="fadeInUp" data-animation-delay="1000">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-thumbs-o-up"></i></a>
                    </div>
                    <h3>Premium Sliders</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>

            <div class="col-md-4" data-animation="fadeInUp" data-animation-delay="1200">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-rocket"></i></a>
                    </div>
                    <h3>Modern Design</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
            <div class="col-md-4" data-animation="fadeInUp" data-animation-delay="1400">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-flask"></i></a>
                    </div>
                    <h3>Clean Modern Code</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
            <div class="col-md-4" data-animation="fadeInUp" data-animation-delay="1600">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-umbrella"></i></a>
                    </div>
                    <h3>Free Updates & Support</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- END: SERVICES -->

<!-- BLOG -->
<section class="content background-grey">
    <div class="container">

        <div class="heading heading text-left">
            <h2>OUR BLOG</h2>
        </div>
    </div>

    <div id="blog">
        <div class="container">
            <!-- Blog post-->
            <div class="post-content  post-block post-modern post-3-columns post-light-background">
                <!-- Blog image post-->
                <div class="post-item" data-animation="fadeInUp" data-animation-delay="0">
                    <div class="post-image">
                        <a href="#">
                            <img alt="" src="images/blog/thumb/4.jpg">
                        </a>
                    </div>
                    <div class="post-content-details">
                        <div class="post-title">
                            <h3><a href="#">Image post example</a></h3>
                        </div>
                        <div class="post-info">
                            <span class="post-autor">Post by: <a href="#">Alea Grande</a></span>
                            <span class="post-category">in <a href="#">Productivity</a></span>
                        </div>
                        <div class="post-description">
                            <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet. Ut nec metus a mi ullamcorper hendrerit.</p>

                            <div class="post-info">
                                <a class="read-more" href="blog-post.html">read more <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="post-meta">
                        <div class="post-date">
                            <span class="post-date-day">19</span>
                            <span class="post-date-month">January</span>
                            <span class="post-date-year">2015</span>
                        </div>

                        <div class="post-comments">
                            <a href="#">
                                <i class="fa fa-comments-o"></i>
                                <span class="post-comments-number">324</span>
                            </a>
                        </div>
                        <div class="post-comments">
                            <a href="#">
                                <i class="fa fa-share-alt"></i>
                                <span class="post-comments-number">324</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Blog slider post-->
                <div class="post-item" data-animation="fadeInUp" data-animation-delay="200">

                    <div class="post-image">
                        <a href="#">
                            <img alt="" src="images/blog/thumb/5.jpg">
                        </a>
                    </div>

                    <div class="post-content-details">
                        <div class="post-title">
                            <h3><a href="#">Slider post demo</a></h3>
                        </div>
                        <div class="post-info">
                            <span class="post-autor">Post by: <a href="#">Alea Grande</a></span>
                            <span class="post-category">in <a href="#">Productivity</a></span>
                        </div>
                        <div class="post-description">
                            <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet. Ut nec metus a mi ullamcorper hendrerit.

                            </p>

                            <div class="post-info">
                                <a class="read-more" href="blog-post.html">read more <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="post-meta">
                        <div class="post-date">
                            <span class="post-date-day">16</span>
                            <span class="post-date-month">January</span>
                            <span class="post-date-year">2015</span>
                        </div>

                        <div class="post-comments">
                            <a href="#">
                                <i class="fa fa-comments-o"></i>
                                <span class="post-comments-number">324</span>
                            </a>
                        </div>
                        <div class="post-comments">
                            <a href="#">
                                <i class="fa fa-share-alt"></i>
                                <span class="post-comments-number">324</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Blog image post-->
                <div class="post-item" data-animation="fadeInUp" data-animation-delay="400">
                    <div class="post-image">
                        <a href="#">
                            <img alt="" src="images/blog/thumb/6.jpg">
                        </a>
                    </div>
                    <div class="post-content-details">
                        <div class="post-title">
                            <h3><a href="#">Image post example</a></h3>
                        </div>
                        <div class="post-info">
                            <span class="post-autor">Post by: <a href="#">Alea Grande</a></span>
                            <span class="post-category">in <a href="#">Productivity</a></span>
                        </div>
                        <div class="post-description">
                            <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet. Ut nec metus a mi ullamcorper hendrerit.

                            </p>

                            <div class="post-info">
                                <a class="read-more" href="blog-post.html">read more <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="post-meta">
                        <div class="post-date">
                            <span class="post-date-day">14</span>
                            <span class="post-date-month">February</span>
                            <span class="post-date-year">2015</span>
                        </div>

                        <div class="post-comments">
                            <a href="#">
                                <i class="fa fa-comments-o"></i>
                                <span class="post-comments-number">324</span>
                            </a>
                        </div>
                        <div class="post-comments">
                            <a href="#">
                                <i class="fa fa-share-alt"></i>
                                <span class="post-comments-number">324</span>
                            </a>
                        </div>
                    </div>
                </div>



            </div>
            <!-- END: Blog post-->
        </div>
    </div>
</section>
<!-- END: BLOG -->

<!-- CLIENTS -->
<section class="p-t-60">
    <div class="container">
        <div class="heading heading-center">
            <h2>CLIENTS</h2>
            <span class="lead">Our awesome clients we've had the pleasure to work with! </span>
        </div>                <div class="carousel clients-carousel" data-carousel-col="6" data-carousel-margins="60" data-carousel-col-xs="2" data-carousel-autoplay="true">
            <div>
                <a href="#"><img alt="" src="images/clients/1.png"> </a>
            </div>
            <div>
                <a href="#"><img alt="" src="images/clients/2.png"> </a>
            </div>
            <div>
                <a href="#"><img alt="" src="images/clients/3.png"> </a>
            </div>
            <div>
                <a href="#"><img alt="" src="images/clients/4.png"> </a>
            </div>
            <div>
                <a href="#"><img alt="" src="images/clients/5.png"> </a>
            </div>
            <div>
                <a href="#"><img alt="" src="images/clients/6.png"> </a>
            </div>
            <div>
                <a href="#"><img alt="" src="images/clients/7.png"> </a>
            </div>
            <div>
                <a href="#"><img alt="" src="images/clients/8.png"> </a>
            </div>
            <div>
                <a href="#"><img alt="" src="images/clients/9.png"> </a>
            </div>
        </div>
    </div>

</section>
<!-- END: CLIENTS -->

<!-- TEAM -->
<section class="background-grey">
    <div class="container">
        <div class="heading heading-center">
            <h2>MEET OUR TEAM</h2>
            <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="image-box circle-image small"> <img class="" src="images/team/1.jpg" alt=""> </div>
                <div class="image-box-description text-center">
                    <h4>Juna Doe</h4>
                    <p class="subtitle">Software Developer</p>
                    <hr class="line">
                    <div>Nullam vulputate euis od urna non pharetra thasellus</div>
                    <div class="social-icons social-icons-border m-t-10 text-center">
                        <ul>
                            <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="social-pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                            <li class="social-linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="image-box circle-image small"> <img alt="" src="images/team/2.jpg"> </div>
                <div class="image-box-description text-center">
                    <h4>Alea Ross</h4>
                    <p class="subtitle">Business Analyst</p>
                    <hr class="line">
                    <div>Nullam vulputate euis od urna non pharetra thasellus</div>
                    <div class="social-icons social-icons-border m-t-10 text-center">
                        <ul>
                            <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="social-pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                            <li class="social-linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="image-box circle-image small"> <img src="images/team/3.jpg" alt=""> </div>
                <div class="image-box-description text-center ">
                    <h4>Ariol Perry</h4>
                    <p class="subtitle">Software Engineer</p>
                    <hr class="line">
                    <div>Nullam vulputate euis od urna non pharetra thasellus</div>
                    <div class="social-icons social-icons-border m-t-10 text-center">
                        <ul>
                            <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="social-pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                            <li class="social-linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="image-box circle-image small"> <img src="images/team/4.jpg" alt=""> </div>
                <div class="image-box-description text-center">
                    <h4>Resa Smith</h4>
                    <p class="subtitle">Systems Engineer</p>
                    <hr class="line">
                    <div>Nullam vulputate euis od urna non pharetra thasellus</div>
                    <div class="social-icons social-icons-border m-t-10 text-center">
                        <ul>
                            <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="social-pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                            <li class="social-linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: TEAM -->