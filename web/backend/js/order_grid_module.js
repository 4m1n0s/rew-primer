var order_grid_module = function($) {

    var gridPjaxContainer = $('#order-grid-pjax');

    var initProcessingAllControl = function() {
        var btnElement = $('#processing-all');
        var link = btnElement.data('link');

        btnElement.click(function (e) {
            processBulkAction(link);
        })
    };

    var initCancelAllControl = function() {
        var btnElement = $('#canceled-all');
        var link = btnElement.data('link');

        btnElement.click(function (e) {
            processBulkAction(link);
        })
    };

    var processBulkAction = function (link) {
        var selectedIds = $('#order-grid').yiiGridView('getSelectedRows');
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

            initProcessingAllControl();
            initCancelAllControl();
        },

        orderStatus: function(url, id) {
            $.ajax({
                url: url,
                type: "POST",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data == true) {
                    }
                }
            });
            return false;
        }
    }
}(jQuery);