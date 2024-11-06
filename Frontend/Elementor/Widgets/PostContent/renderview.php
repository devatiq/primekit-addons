<?php
/**
 * Render View for PrimeKit Post Content Widget
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Get the current post content
$primekit_post_content = apply_filters('the_content', get_the_content());

// Check if there is post content
if ($primekit_post_content) {
    ?>
    <div class="primekit-elementor-post-content-area">
        <?php echo wp_kses_post($primekit_post_content); ?>
    </div>
    <?php
}
?>