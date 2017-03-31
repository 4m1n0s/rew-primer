<?php

    $url = '/images/portfolio/';

?>

<!-- PAGE TITLE -->
<section id="page-title" class="page-title-parallax page-title-center text-dark" style="background-image:url(images/parallax/page-title-parallax.jpg);">
    <div class="container">
        <div class="page-title col-md-8">
            <h1>Portfolio</h1>
            <span>Portfolio Columns - One columns version</span>
        </div>
    </div>
</section>
<!-- END: PAGE TITLE -->


<!-- SECTION -->
<section>
    <div class="container portfolio">

        <!--Portfolio Filter-->
        <div class="filter-active-title">Show All</div>
        <ul class="portfolio-filter" id="portfolio-filter" data-isotope-nav="isotope">
            <li class="ptf-active" data-filter="*">Show All</li>
            <li data-filter=".artwork">Artwork</li>
            <li data-filter=".banner">Banner</li>
            <li data-filter=".beauty">Beauty</li>
            <li data-filter=".marketing">Marketing</li>
            <li data-filter=".design">Design</li>
        </ul>
        <!-- END: Portfolio Filter -->

        <!-- Portfolio Items -->
        <div id="isotope" class="isotope portfolio-items" data-isotope-col="1" data-isotope-item=".portfolio-item">
            <div class="portfolio-item design">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>1.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">Fast Skateboard</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>

                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design beauty">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>2.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">Working hard</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design beauty">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>3.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">The feather man</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design artwork">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>4.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">The long line</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item banner beauty">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>5.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">Backwards</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design artwork banner">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>6.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">Disappointed horse</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design artwork">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>7.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">Wire's</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design marketing">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>8.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">Forcing</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design marketing banner">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>9.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">No words</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design marketing banner">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>10.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>

                <div class="portfolio-description">
                    <h4 class="title">Baloon</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design artwork banner">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>11.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">Hidden girl</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design artwork">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>12.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">Yellow box</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>



            <div class="portfolio-item design marketing banner">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>13.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">Traveling</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design artwork banner">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>14.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">Free bird</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

            <div class="portfolio-item design artwork">
                <div class="portfolio-image effect social-links">
                    <img src="<?= $url ?>15.jpg" alt="">
                    <div class="image-box-content">
                        <p>
                            <a href="<?= $url ?>1.jpg" data-lightbox-type="image" title="Your image title here!"><i class="fa fa-expand"></i></a>
                            <a href="portfolio-page-basic.html"><i class="fa fa-link"></i></a>
                        </p>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h4 class="title">Kameleon</h4>
                    <p><i class="fa fa-tag"></i>Design / Artwork</p>
                </div>
                <div class="portfolio-date">
                    <p class="small"><i class="fa fa-calendar-o"></i>April 26, 2015</p>
                </div>
                <div class="portfolio-details">
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam, non ornare orci ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla luctus. Fusce id mi diam.</p>
                    <br />
                    <a href="#" class="button color rounded button-3d effect icon-top"><span><i class="fa fa-external-link"></i>More details</span></a>
                </div>
            </div>

        </div>
        <!-- END: Portfolio Items -->


    </div>

    <hr class="space">

</section>
