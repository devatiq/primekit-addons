jQuery(document).ready(function ($) {
    const $container = $('#primekit-templates-content-wrapper');
    const $pagination = $('#primekit-templates-pagination-wrapper');

    function loadTemplates(page = 1) {
        $.ajax({
            url: PrimeKitTemplates.ajax_url,
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'primekit_fetch_templates',
                nonce: PrimeKitTemplates.nonce,
                page: page
            },
            beforeSend: function () {
                $container.html('<div class="primekit-loading"></div>');
                $pagination.html('');
            },
            success: function (response) {
                if (response.success) {
                    $container.html(response.data.html);
                    $pagination.html(response.data.pagination);
                } else {
                    $container.html('<div class="notice notice-error"><p>Failed to load templates.</p></div>');
                }
            },
            error: function () {
                $container.html('<div class="notice notice-error"><p>Error occurred while loading templates.</p></div>');
            }
        });
    }

    // Initial load
    loadTemplates();

    // Delegate click event for pagination buttons
    $(document).on('click', '.primekit-page-btn', function () {
        const page = $(this).data('page');
        loadTemplates(page);
    });
});
