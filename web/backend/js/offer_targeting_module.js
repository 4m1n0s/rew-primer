var offer_targeting_module = function ($) {

    var initHandlers = function () {
        var url = $('#country-link').data('link');

        $('.offer-targeting-select').select2({
            width: '100%',
            allowClear: true,
            triggerChange: true,
            ajax: {
                url: url,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                        // page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.country_name,
                                id: item.id
                            }
                        })
                        // pagination: {
                        // more: (params.page * 30) < data.total_count
                        // }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 3
        });

    };

    return {

        init: function () {
            if (!jQuery().select2) {
                console.log('"select2" is required!');
                return;
            }

            $.fn.select2.defaults.set("theme", "classic");
            $.fn.select2.defaults.set("width", "resolve");

            initHandlers();
        }

    }
}(jQuery);