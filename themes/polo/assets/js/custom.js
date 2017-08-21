/* Add your custom JavaScript code */

// Window load event used just in case window height is dependant upon images

function positionFooter() {
    var footerHeight = 0,
        footerTop = 0,
        $footer = $("#footer");

    footerHeight = $footer.height();
    footerTop = ($(window).scrollTop() + $(window).height() - footerHeight);

    if ( ($(document.body).height()) < $(window).height()) {
        $footer.css({
            position: "absolute",
            top: footerTop
        });
    } else {
        $("#footer").css({
            position: "",
            top: ""
        });
    }

    $footer.fadeIn(1);
}

$(window).on("load", function() {
    positionFooter();
    $(window).scroll(positionFooter).resize(positionFooter);
});

$(document).on('pjax:complete', function() {
    $(window).trigger('resize');
});