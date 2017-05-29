var commercial_block_checker_module = function($) {

    var alertContainer = $('#ads-block-warning');
    var globalChecker = window.rbAdsChecker;

    var showAlert = function () {
        alertContainer.removeClass('hide');
    };

    return {

        init: function() {
            if (globalChecker === undefined) {
                showAlert();
            }
        }

    }
}(jQuery);