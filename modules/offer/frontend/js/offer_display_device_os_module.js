var offer_display_device_os_module = function($) {

    var device_type_select = $('#offer-device-type-select');
    var deviceOsElem = $('.device-os');

    var display = function() {
        var deviceTypes = device_type_select.select2('val');
        var typeMobile = device_type_select.data('type-mobile');

        if(deviceTypes !== null && deviceTypes.indexOf(typeMobile + '') !== -1) {
            deviceOsElem.show();
        } else {
            deviceOsElem.hide();
        }
    };

    var initSelect2 = function(config) {
        $('#offer-category-select, #offer-country-select, #offer-device-type-select, #offer-device-os-select').select2(config);
    };

    return {
        init: function(select2Config) {
            initSelect2(select2Config);
            display();
            device_type_select.on('change', display);
        }
    }
}(jQuery);