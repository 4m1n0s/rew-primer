
<?php
/* @var $this yii\web\View */
?>
<section id="home-section" class="slider1">

    <div class="tp-banner-container">
        <div class="tp-banner" >
            <ul>	

                <?php foreach ($videos as $key => $value): ?>
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on"  data-title="Intro Slide">
                        <!-- MAIN IMAGE -->
                        <img src="<?= $value->slider_image ?>" alt="<?= $value->title ?>" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption lft tp-resizeme rs-parallaxlevel-0"
                             data-x="200"
                             data-y="190" 
                             data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-speed="1000"
                             data-start="1000"
                             data-easing="Power3.easeInOut"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.1"
                             data-endelementdelay="0.1"
                             style="z-index: 8; max-width: auto; max-height: auto; white-space: nowrap;"><span class="left-top corner-border"></span>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption lfb tp-resizeme rs-parallaxlevel-0"
                             data-x="200"
                             data-y="330" 
                             data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-speed="1000"
                             data-start="1000"
                             data-easing="Power3.easeInOut"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.1"
                             data-endelementdelay="0.1"
                             style="z-index: 8; max-width: auto; max-height: auto; white-space: nowrap;"><span class="left-bottom corner-border"></span>
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption lft tp-resizeme rs-parallaxlevel-0"
                             data-x="900"
                             data-y="190" 
                             data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-speed="1000"
                             data-start="1000"
                             data-easing="Power3.easeInOut"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.1"
                             data-endelementdelay="0.1"
                             style="z-index: 8; max-width: auto; max-height: auto; white-space: nowrap;"><span class="right-top corner-border"></span>
                        </div>

                        <!-- LAYER NR. 4 -->
                        <div class="tp-caption lfb tp-resizeme rs-parallaxlevel-0"
                             data-x="900"
                             data-y="330" 
                             data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-speed="1000"
                             data-start="1000"
                             data-easing="Power3.easeInOut"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.1"
                             data-endelementdelay="0.1"
                             style="z-index: 8; max-width: auto; max-height: auto; white-space: nowrap;"><span class="right-bottom corner-border"></span>
                        </div>

                        <!-- LAYER NR. 5 -->
                        <div class="tp-caption finewide_medium_white lft tp-resizeme rs-parallaxlevel-0"
                             data-x="335"
                             data-y="270" 
                             data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-speed="1000"
                             data-start="1200"
                             data-easing="Power3.easeInOut"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.1"
                             data-endelementdelay="0.1"
                             style="z-index: 8; max-width: auto; max-height: auto; white-space: nowrap;"><?= $value->title ?>
                        </div>

                    </li>
                <?php endforeach; ?>

            </ul>
            <div class="tp-bannertimer"></div>
        </div>
    </div>
</section>

<section class="portfolio-section">
    <div class="container">
        <div class="portfolio-box owl-wrapper">
            <div class="owl-carousel" data-num="4">

                <?php foreach ($videos as $key => $value): ?>
                    <div class="item project-post">
                        <div class="project-gallery">
                            <img src="<?= $value->image ?>" alt="<?= $value->title ?>">
                            <div class="hover-box">
                                <div class="inner-hover">
                                    <h2><a href="single-project.html"><?= $value->title ?></a></h2>
                                    <span>interior</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>
</section>

<section class="portfolio-section">
    <div class="container">
        <div class="portfolio-box owl-wrapper">
            <div class="owl-carousel" data-num="4">

                <?php foreach ($videos as $key => $value): ?>
                    <div class="item project-post">
                        <div class="project-gallery">
                            <img src="<?= $value->image ?>" alt="<?= $value->title ?>">
                            <div class="hover-box">
                                <div class="inner-hover">
                                    <h2><a href="single-project.html"><?= $value->title ?></a></h2>
                                    <span>interior</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>
</section>

