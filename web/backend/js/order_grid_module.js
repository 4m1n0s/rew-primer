var order_grid_module = function($) {

    var gridPjaxContainer = $('#order-grid-pjax');

    var initControlHandlers = function() {
        $(document).on('click', '#jsf-import-button', function() {
            $('input[type="file"]#file-import').click();
        });
        $(document).on('change', 'input[type="file"]#file-import', function() {
            $('#order-import-form').submit();
        });
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