var SubscribeWidget = function() {
    var $ = jQuery;
    var handleForm = function() {
        $(document).on('submit', '#newsletter_subscribe', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            console.log(JSON.parse(formData));
            $.ajax({
                url: '/subscriber/ajax/subscribe',
                type: 'post',
                dataType: 'json',
                data: {
                    _requestData: obj,
                    _crsf: yii.getCsrfToken(),
                },
                success: function(response) {

                },
                error: function(error) {

                }
            });
        });
    }

    return {
        init: function() {
            handleForm();
        }
    };
}();