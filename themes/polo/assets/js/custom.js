/* Add your custom JavaScript code */

// Window load event used just in case window height is dependant upon images
$(window).on("load", function() {

    var footerHeight = 0,
        footerTop = 0,
        $footer = $("#footer");

    positionFooter();

    function positionFooter() {

        footerHeight = $footer.height();
        footerTop = ($(window).scrollTop() + $(window).height()-footerHeight);

        if ( ($(document.body).height()) < $(window).height()) {
            $footer.css({
                position: "absolute",
                top: footerTop
            });
        }
    }

    $(window)
        .scroll(positionFooter)
        .resize(positionFooter)

});