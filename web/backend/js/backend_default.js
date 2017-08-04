(function($) {

    var $window = $(window),
        $document = $(document),
        $body = $('body'),
        $globalModal = $('#view-modal'),
        modalToggleBtn = '.view-modal-btn';

    var initGridPjaxBlock = function () {
        $document.on('pjax:send', function() {
            App.blockUI({target: $('.portlet').find('.portlet-body'), iconOnly: true});
        });
        $document.on('pjax:complete', function() {
            App.unblockUI($('.portlet').find('.portlet-body'));
        });
    };

    var initGlobalModal = function () {
        $document.on('click', modalToggleBtn, function (e) {
            e.preventDefault();
            e.stopPropagation();
            App.blockUI({target: $globalModal.find('.modal-dialog'), iconOnly: true});
            $globalModal.modal('show').find('.modal-body').load($(this).attr('href'), function () {
                App.unblockUI($globalModal.find('.modal-dialog'));
            });
        });
        $document.on('hidden.bs.modal', $globalModal, function (e) {
            $(this).find('.modal-body').html('');
        })
    };

    $document.ready(function (e) {
        initGridPjaxBlock();
        initGlobalModal();
    });

})(jQuery);