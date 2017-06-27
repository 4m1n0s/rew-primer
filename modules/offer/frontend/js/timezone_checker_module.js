var timezone_checker_module = function($) {

    var retainTimezone = function () {
        Cookies.set('RB__clientTimeZone', moment.tz.guess(), {expires: 7, path: '/'});
    };

    return {

        init: function() {
            if (!moment) {
                console.log('"moment" is required!');
                return;
            }

            retainTimezone();
        }
    }
}(jQuery);