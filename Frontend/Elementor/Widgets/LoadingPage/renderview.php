<?php
/**
 * Render View for PrimeKit Loading Screen Widget
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Get the settings from the Elementor widget
$primekit_settings = $this->get_settings_for_display();

// Get the loading image, text, and switches
$primekit_loading_image = !empty($primekit_settings['primekit_loading_screen_image']['url']) 
    ? $primekit_settings['primekit_loading_screen_image']['url'] 
    : \Elementor\Utils::get_placeholder_image_src();
$primekit_loading_text = !empty($primekit_settings['primekit_loading_screen_text']) 
    ? $primekit_settings['primekit_loading_screen_text'] 
    : 'Loading...';
$primekit_image_alt = get_bloginfo('name');

// Get the switch values
$primekit_test_mode = !empty($primekit_settings['primekit_loading_screen_test_switch']) 
    && $primekit_settings['primekit_loading_screen_test_switch'] === 'yes';
$primekit_img_switch = !empty($primekit_settings['primekit_loading_screen_img_switch']) 
    && $primekit_settings['primekit_loading_screen_img_switch'] === 'yes';
$primekit_text_switch = !empty($primekit_settings['primekit_loading_screen_text_switch']) 
    && $primekit_settings['primekit_loading_screen_text_switch'] === 'yes';
$primekit_bar_switch = !empty($primekit_settings['primekit_loading_screen_bar_switch']) 
    && $primekit_settings['primekit_loading_screen_bar_switch'] === 'yes';
?>

<!-- Loading Screen -->
<div id="primekit-loading-screen" data-test-mode="<?php echo esc_attr($primekit_test_mode ? 'yes' : 'no'); ?>">
    
    <!-- Display Image based on switch -->
    <?php if ($primekit_img_switch) : ?>
        <img src="<?php echo esc_url($primekit_loading_image); ?>" alt="<?php echo esc_attr($primekit_image_alt); ?>" class="primekit-loading-image">
    <?php endif; ?>
    
    <!-- Display Text based on switch -->
    <?php if ($primekit_text_switch) : ?>
        <p class="primekit-loading-text"><?php echo esc_html($primekit_loading_text); ?></p>
    <?php endif; ?>
    
    <!-- Display Loading Bar based on switch -->
    <?php if ($primekit_bar_switch) : ?>
        <div class="primekit-loading-bar">
            <div class="primekit-buffering">
                <div class="primekit-buffer-circle"></div>
                <div class="primekit-buffer-circle"></div>
                <div class="primekit-buffer-circle"></div>
                <div class="primekit-buffer-circle"></div>
                <div class="primekit-buffer-circle"></div>
            </div>
        </div>
    <?php endif; ?>
</div>
<!-- /end PrimeKit Loading Screen -->

<script>
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
        // On the front end, hide the loading screen after the page fully loads
        $(window).on('load', function() {
            hideLoadingScreen();
        });
    }
});

</script>