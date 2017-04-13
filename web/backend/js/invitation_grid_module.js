var invitation_grid_module = function($) {

    var gridPjaxContainer = $('#invitation-grid-pjax');

    var initApproveControl = function() {
        var approveAllElement = $('#approve-all');
        var link = approveAllElement.data('link');

        approveAllElement.click(function (e) {
            processBulkAction(link);
        })
    };

    var initDeclineControl = function() {
        var declineAllElement = $('#decline-all');
        var link = declineAllElement.data('link');

        declineAllElement.click(function (e) {
            processBulkAction(link);
        })
    };

    var processBulkAction = function (link) {
        var selectedIds = $('#invitation-grid').yiiGridView('getSelectedRows');
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

            initApproveControl();
            initDeclineControl();
        },

        status: function(url, id) {
            $.ajax({
                url: url,
                type: "POST",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data == true) {
                        $.pjax.reload({container: gridPjaxContainer});
                    }
                }
            });
            return false;
        }
    }
}(jQuery);