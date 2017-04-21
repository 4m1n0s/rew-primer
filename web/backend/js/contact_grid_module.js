var contact_grid_module = function($) {

    var gridPjaxContainer = $('#contact-grid-pjax');

    var initReadAllControl = function() {
        var btnElement = $('#read-all');
        var link = btnElement.data('link');

        btnElement.click(function (e) {
            processBulkAction(link);
        })
    };

    var initDeleteAllControl = function() {
        var btnElement = $('#delete-all');
        var link = btnElement.data('link');

        btnElement.click(function (e) {
            processBulkAction(link);
        })
    };

    var processBulkAction = function (link) {
        var selectedIds = $('#contact-grid').yiiGridView('getSelectedRows');
        $.ajax({
            url: link,
            type: "POST",
            dataType: 'json',
            data: {
                ids: selectedIds
            },
            success: function(data) {
                if (data == true) {
                    $.pjax.reload({container: gridPjaxContainer});
                }
            }
        });
        return false;
    };

    return {

        init: function() {
            if (!jQuery().yiiGridView) {
                console.log('"yiiGridView" is required!');
                return;
            }

            initReadAllControl();
            initDeleteAllControl();
        }
    }
}(jQuery);