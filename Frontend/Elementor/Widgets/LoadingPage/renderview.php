<?php
/**
 * Render View for PrimeKit Loading Screen Widget
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Get the current post title
$primekit_loading_screen = get_the_title();

// Check if there is a post title
if ($primekit_loading_screen) {
    $primekit_heading_tag = $this->get_settings('primekit_elementor_loading_screen_tag');
    $primekit_alignment = $this->get_settings('primekit_elementor_loading_screen_align');
    $primekit_text_color = $this->get_settings('primekit_elementor_loading_screen_color');
    ?>

        <div class="primekit-elementor-loading-screen-area">
            <<?php echo esc_html($primekit_heading_tag); ?> class="primekit-loading-screen-tag"><?php echo esc_html($primekit_loading_screen); ?></<?php echo esc_html($primekit_heading_tag); ?>>
        </div>
    <?php
}
?>
