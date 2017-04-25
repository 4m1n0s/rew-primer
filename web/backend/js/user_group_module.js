var user_group_module = function ($) {

    var initHandlers = function () {
        var url = $('#usergroup-user').data('link');

        $('#usergroup-user').select2({
            placeholder: 'Select a User',
            allowClear: true,
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
                                text: item.email,
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

        $('#add-user').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            
            var data = $('#usergroup-user').select2('data')[0];
            var link = $(this).data('link');

            if (!data) {
                return;
            }

            $.ajax({
                url: link,
                type: "POST",
                dataType: 'json',
                data: {
                    user_id: data.id
                },
                success: function(data) {
                    if (data.status == 'success') {
                        $('#user-list-group').prepend(data.html);
                    }
                }
            });
        });

        $(document).on('click', '.remove-user', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var $item = $(this);
            $item.closest('.user-group-item').remove();
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