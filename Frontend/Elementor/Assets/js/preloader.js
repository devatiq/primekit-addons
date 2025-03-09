(function($) {
    'use strict';

    // Function to hide preloader
    function hidePreloader() {
        var preloader = $('.primekit-preloader');
        if (preloader.length) {
            preloader.addClass('hide');
            setTimeout(function() {
                preloader.remove();
            }, 500);
        }
    }

    // Hide preloader when page is fully loaded
    $(window).on('load', function() {
        hidePreloader();
    });

    // Fallback: Hide preloader after 5 seconds if load event doesn't fire
    setTimeout(hidePreloader, 5000);

})(jQuery);