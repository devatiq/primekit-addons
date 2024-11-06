jQuery(document).ready(function($) {
    'use strict';
    $('body').on('click', '.primekit_add_to_cart', function(e) {
        e.preventDefault();

        let button = $(this);
        if (button.is('.disabled')) {
            return; // Exit if the button is disabled
        }

        let product_id = button.data('product_id');
        button.addClass('primekit_cart_loading');
        let quantity = button.closest('form').find('.quantity input').val() || 1; // Default to 1 if not set

        $.ajax({
            type: 'POST',
            url: acbbiz_add_to_cart.ajax_url,
            data: {
                'action': 'primekit_ajax_add_to_cart_handler',
                'product_id': product_id,
                'quantity': quantity,
                'primekit_cart_nonce': acbbiz_add_to_cart.primekit_add_to_cart_nonce 
            },
            success: function(response) {
                var messageDiv = $('#acbbiz-add-to-cart-message');
                if (response.success) {
                    messageDiv.html('<p class="success-message">' + response.data.message + '</p>').fadeIn();
                    primekit_updateCartCount(); // Update cart count on successful addition
                } else {
                    messageDiv.html('<p>' + response.data.message + '</p>').fadeIn();
                }
                
                messageDiv.delay(3000).queue(function(next) {
                    $(this).empty();
                    next();
                });
            },
            complete: function() {
                button.removeClass('primekit_cart_loading');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var messageDiv = $('#acbbiz-add-to-cart-message');
                var errorMessage = "An error occurred. Please try again.";
                if (jqXHR.responseJSON && jqXHR.responseJSON.data && jqXHR.responseJSON.data.message) {
                    errorMessage = jqXHR.responseJSON.data.message;
                }
                messageDiv.html('<p class="error-message">' + errorMessage + '</p>').fadeIn().delay(3000).fadeOut();
            },
        });
    });

    function primekit_updateCartCount() {
        // Only proceed if PrimeKitCartAjax and PrimeKitCartAjax.url are defined
        if (typeof PrimeKitCartAjax !== 'undefined' && typeof PrimeKitCartAjax.url !== 'undefined') {
            $.ajax({
                type: 'POST',
                url: PrimeKitCartAjax.url,
                data: {
                    'action': 'primekit_get_cart_count'
                },
                success: function(cartCount) {
                    // Update the cart count if the element exists
                    if ($('.primekit-cart-contents-count').length) {
                        $('.primekit-cart-contents-count').text(cartCount);
                    }
                }
            });
        }
    }    
    
});