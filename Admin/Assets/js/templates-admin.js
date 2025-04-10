jQuery(document).ready(function ($) {
    const $container = $('#primekit-templates-content-wrapper');

    $.ajax({
        url: PrimeKitTemplates.ajax_url,
        method: 'POST',
        dataType: 'json',
        data: {
            action: 'primekit_fetch_templates',
            nonce: PrimeKitTemplates.nonce
        },
        beforeSend: function () {
            $container.html('<div class="loading">Loading templates...</div>');
        },
        success: function (response) {
            if (response.success && response.data.html) {
                $container.html(response.data.html);
            } else {
                $container.html('<div class="notice notice-error"><p>Failed to load templates.</p></div>');
            }
        },
        error: function () {
            $container.html('<div class="notice notice-error"><p>Error occurred while loading templates.</p></div>');
        }
    });
});
