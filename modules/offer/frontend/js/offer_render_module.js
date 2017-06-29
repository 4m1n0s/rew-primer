var offer_render_module = function($) {

    var $pageWrap = $('#offer-page-wrap');
    var actionUrl = $pageWrap.data('link');

    var ajaxRequest = function () {
        $.ajax({
            url: actionUrl,
            method: 'POST',
            dataType: 'html',
            data: {
                timezone: moment.tz.guess()
            },
            success: function (response) {
                $pageWrap.html(response);
            }
        });
    };

    return {
        init: function() {
            if (!moment) {
                console.log('"moment" is required!');
                return;
            }

            ajaxRequest();
        }
    }
}(jQuery);