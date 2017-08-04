(function($) {

    var $window = $(window),
        $document = $(document),
        $body = $('body');
    
    var initGridPjaxBlock = function () {
        $document.on('pjax:send', function() {
            App.blockUI({target: $('.portlet').find('.portlet-body'), iconOnly: true});
        });
        $document.on('pjax:complete', function() {
            App.unblockUI($('.portlet').find('.portlet-body'));
        });
    };

    $document.ready(function (e) {
        initGridPjaxBlock();
    });

})(jQuery);