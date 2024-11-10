jQuery(document).ready(function($) {
    function hideLoadingScreen() {
        const $primeLoadingScreen = $('#primekit-loading-screen');
        if ($primeLoadingScreen.length) {
            $primeLoadingScreen.hide();
        }
    }

    // Get the value of the test mode from the data attribute
    const $loadingScreen = $('#primekit-loading-screen');
    const testMode = $loadingScreen.data('test-mode') === 'yes';
    const isElementorEditor = $('body').hasClass('elementor-editor-active');

    if (isElementorEditor) {
        // If test mode is off, hide the loading screen in the editor
        if (!testMode) {
            hideLoadingScreen();
        }
    } else {
        // On the front end, hide the loading screen after the page fully loads or after 3 seconds (whichever comes first)
        let pageLoaded = false;

        // Try to hide the loading screen when the page fully loads
        $(window).on('load', function() {
            pageLoaded = true;
            hideLoadingScreen();
        });

        // Fallback: Hide the loading screen after 3 seconds if the page hasn't loaded yet
        setTimeout(function() {
            if (!pageLoaded) {
                hideLoadingScreen();
            }
        }, 3000); // 3000ms = 3 seconds
    }
});