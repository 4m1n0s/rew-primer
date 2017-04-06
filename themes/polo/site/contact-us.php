<!-- PAGE TITLE -->
<section id="page-title" class="page-title-parallax page-title-center text-dark" >
    <div class="container">
        <div class="page-title col-md-8">
            <h1>Contact Us</h1>
            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
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
        </div>
    </div>
</section>
<!-- END: CONTENT -->