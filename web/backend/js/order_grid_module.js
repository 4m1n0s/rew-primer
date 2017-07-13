var order_grid_module = function($) {

    var gridPjaxContainer = $('#order-grid-pjax');

    var initControlHandlers = function() {
        var btnElements = $('#processing-all, #canceled-all');
        btnElements.click(function (e) {
            var $target = $(e.currentTarget);
            processBulkAction($target);
        });
        $(document).on('click', '#jsf-import-button', function() {
            $('input[type="file"]#file-import').click();
        });
        $(document).on('change', 'input[type="file"]#file-import', function() {
            $('#order-import-form').submit();
        });
    };

    var processBulkAction = function (element) {
        var selectedIds = $('#order-grid').yiiGridView('getSelectedRows');
        var url = element.data('link');
        $.ajax({
            url: url,
            type: "post",
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

    var initExport = function () {
        $('#order-export-form').on('submit', function (e) {
            var selectedIds = $('#order-grid').yiiGridView('getSelectedRows');
            $('#order-export-form #export-ids').val(selectedIds);
        })
    };

    return {

        init: function() {
            if (!jQuery().yiiGridView) {
                console.log('"yiiGridView" is required!');
                return;
            }

            initControlHandlers();
            initExport();
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