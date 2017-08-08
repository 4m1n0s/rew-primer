(function($) {

    var $window = $(window),
        $document = $(document),
        $body = $('body'),
        $globalModal = $('#view-modal'),
        globalModalToggleBtn = '.view-modal-btn';

    var initPjaxDefaults = function () {
        if ($.pjax) {
            $.pjax.defaults.timeout = 5000;
        }
    };

    var initGridPjaxBlock = function () {
        $document.on('pjax:send', function() {
            App.blockUI({target: $('.portlet').find('.portlet-body')});
        });
        $document.on('pjax:complete', function() {
            App.unblockUI($('.portlet').find('.portlet-body'));
        });
    };

    var initGlobalModal = function () {
        $document.on('click', globalModalToggleBtn, function (e) {
            e.preventDefault();
            e.stopPropagation();
            App.blockUI({target: $globalModal.find('.modal-dialog')});
            $globalModal.modal('show').find('.modal-body').load($(this).attr('href'), function () {
                App.unblockUI($globalModal.find('.modal-dialog'));
            });
        });
        $document.on('hidden.bs.modal', $globalModal, function (e) {
            $(this).find('.modal-body').html('');
        });
    };

    var initDatePickers = function ($config) {
        $('.date-picker').datepicker($config);
        $document.on('pjax:complete', function() {
            $('.date-picker').datepicker($config);
        });
    };

    $document.ready(function (e) {
        initPjaxDefaults();
        initGridPjaxBlock();
        initGlobalModal();
        initDatePickers({
            autoclose: true,
            clearBtn: true
        });
    });

})(jQuery);