<!-- PAGE TITLE -->
<section id="page-title" class="page-title-parallax page-title-center text-dark" >
    <div class="container">
        <div class="page-title col-md-8">
            <h1>Contact Us</h1>
            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span> </div>
        <div class="breadcrumb col-md-4">
            <ul>
                <li><a href="#"><i class="fa fa-home"></i></a> </li>
                <li><a href="#">Home</a> </li>
                <li><a href="#">Pages</a> </li>
                <li class="active"><a href="#">Contact Us</a> </li>
            </ul>
        </div>
    </div>
</section>
<!-- END: PAGE TITLE -->

<!-- CONTENT -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-uppercase">Get In Touch</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse condimentum porttitor cursus. Duis nec nulla turpis. Nulla lacinia laoreet odio, non lacinia nisl malesuada vel. Aenean malesuada fermentum bibendum.</p>
                <div class="m-t-30">
                    <form id="widget-contact-form" action="include/contact-form.php" role="form" method="post">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="name">Name</label>
                                <input type="text" aria-required="true" name="widget-contact-form-name" class="form-control required name" placeholder="Enter your Name">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="email">Email</label>
                                <input type="email" aria-required="true" name="widget-contact-form-email" class="form-control required email" placeholder="Enter your Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="subject">Your Subject</label>
                                <input type="text" name="widget-contact-form-subject" class="form-control required" placeholder="Subject...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea type="text" name="widget-contact-form-message" rows="5" class="form-control required" placeholder="Enter your Message"></textarea>
                        </div>
                        <input type="text" class="hidden" id="widget-contact-form-antispam" name="widget-contact-form-antispam" value="" />
                        <button class="btn btn-primary" type="submit" id="form-submit"><i class="fa fa-paper-plane"></i>&nbsp;Send message</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="text-uppercase">Address & Map</h3>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Polo, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                    </div>
                    <div class="col-md-6">
                        <address>
                            <strong>Polo Office</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                    </div>
                </div>

                <!-- Google map sensor -->
                <script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
                <div class="map m-t-30" data-map-address="Melburne, Australia" data-map-zoom="10" data-map-icon="images/markers/marker2.png" data-map-type="ROADMAP"></div>
                <!-- Google map sensor -->

            </div>
        </div>
    </div>
</section>
<!-- END: CONTENT -->