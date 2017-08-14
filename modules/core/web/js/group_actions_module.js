var group_actions_module = function($) {

    var config;

    var setConfig = function (params) {
        config = params;
    };

    var initControlHandlers = function() {
        $(config.submitBtn).on('click', function() {
            var action = $(config.list + ' :selected').data('action');
            processBulkAction(action);
        });
    };

    var processBulkAction = function (action) {
        var selectedIds = $(config.grid).yiiGridView('getSelectedRows');
        if (!selectedIds.length) {
            alert('Please choose one or more items to continue!');
            return false;
        }
        if (!confirm('Confirm the action')) {
            return false;
        }

        $.ajax({
            url: action,
            type: "post",
            dataType: 'json',
            data: {
                ids: selectedIds
            },
            success: function(data) {
                if (data == true) {
                    $.pjax.reload({container: $(config.pjaxContainer)});
                }
            }
        });
    };

    return {
        init: function(params) {
            setConfig(params);
            initControlHandlers();
        }
    }
}(jQuery);