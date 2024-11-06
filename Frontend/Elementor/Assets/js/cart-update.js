jQuery(function($) {
    'use strict';

    $('body').on('added_to_cart', function() {
        $.ajax({
            url: primekitCartAjax.url,
            type: 'POST',
            data: {
                action: 'primekit_get_cart_count',
                nonce: primekitCartAjax.nonce // Add nonce here
            },
            success: function(data) {
                $('.primekit-cart-contents-count').text(data);
            }
        });
    });
});