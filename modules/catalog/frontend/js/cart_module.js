var cart_module = function($) {

    var $shopCart = $('#shop-cart');
    var $headerShopCart = $('#shopping-cart');
    var $cartItem = $('.cart-item');

    var updateShopingCart = function (e) {
        $.ajax({
            url: '/cart/data',
            method: 'POST',
            dataType: 'JSON',
            success: function (response) {
                if (response.status) {
                    $headerShopCart.find('.shopping-cart-items').html(response.data.count);
                }
            }
        });
    };

    var initHandlers = function () {

        $(document).on('click', '.cart-item .cart-product-remove-item', function (e) {
            e.stopPropagation();
            e.preventDefault();
            var current = $(this);
            var url = $(this).data('url');
            var id = $(this).data('id');

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'HTML',
                data: {id: id},
                success: function (response) {
                    $shopCart.html(response);
                    updateShopingCart();
                }
            });
        });

        $(document).on('change', '.cart-item .cart-product-quantity .qty', function(e) {
            e.preventDefault();
            var current = $(this);
            var url = current.data('url');
            var id = current.data('id');
            var qty = current.val();

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'HTML',
                data: {id: id, qty: qty},
                success: function (response) {
                    $shopCart.html(response);
                    updateShopingCart();
                }
            });
        });
    };

    return {
        init: function() {
            initHandlers();
        }
    }
}(jQuery);