<?php
/**
 * Render View for PrimeKit Post Content Widget
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Check if Elementor is in editor mode
if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
    // Fetch the latest post's content in editor mode
    $latest_post = get_posts([
        'numberposts' => 1,
        'post_status' => 'publish'
    ]);
    
    // Ensure we have a post before trying to access its content
    if (!empty($latest_post)) {
        $post_id = $latest_post[0]->ID;
        $primekit_post_content = apply_filters('the_content', get_post_field('post_content', $post_id));
    } else {
        $primekit_post_content = esc_html__('No content available.', 'primekit-addons');
    }
} else {
    // For frontend, use the current post's content
    $primekit_post_content = apply_filters('the_content', get_the_content());
}

// Display the post content if available
if ($primekit_post_content) {
    ?>
    <div class="primekit-elementor-post-content-area">
        <?php echo wp_kses_post($primekit_post_content); ?>
    </div>
    <?php
}