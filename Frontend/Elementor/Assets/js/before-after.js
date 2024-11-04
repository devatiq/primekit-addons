jQuery(document).ready(function($) {
    function PrimeKitinitializeBeforeAfter() {
        $('.primekit-before-after-container').each(function() {
            var configData = $(this).data('primekit-config');

            // Parse JSON data if needed
            if (typeof configData === 'string') {
                configData = JSON.parse(configData);
            }

            // Initialize the twentytwenty plugin with the parsed config data
            $(this).twentytwenty({
                default_offset_pct: parseFloat(configData.default_offset_pct),
                before_label: configData.before_label,
                after_label: configData.after_label,
                orientation: configData.orientation,
                no_overlay: configData.no_overlay === 'true',
                move_slider_on_hover: configData.move_slider_on_hover === 'true',
                move_with_handle_only: configData.move_with_handle_only === 'true',
                click_to_move: configData.click_to_move === 'true',
            });
        });
    }

    // Check if we are in Elementor edit mode
    if (window.elementorFrontend && window.elementorFrontend.hooks) {
        window.elementorFrontend.hooks.addAction('frontend/element_ready/global', function() {
            PrimeKitinitializeBeforeAfter();
        });
    } else {
        PrimeKitinitializeBeforeAfter();
    }
});