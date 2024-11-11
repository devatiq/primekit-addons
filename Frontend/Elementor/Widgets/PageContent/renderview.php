<?php
/**
 * Render View for PrimeKit Page Content Widget
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Check if Elementor is in editor mode
if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
    // Fetch the latest page's content in editor mode
    $latest_post_query = new \WP_Query([
        'post_type' => 'page',
        'posts_per_page' => 1,
    ]);
    
    // Ensure we have a post before trying to access its content
    if ($latest_post_query->have_posts()) {
        $latest_post_query->the_post();
        $primekit_page_content = apply_filters('the_content', get_the_content());
        wp_reset_postdata();
    } else {
        $primekit_page_content = esc_html__('No content available.', 'primekit-addons');
    }
} else {
    // For frontend, use the current post's content
    $primekit_page_content = apply_filters('the_content', get_the_content());
}

// Display the post content if available
if ($primekit_page_content) {
    ?>
    <div class="primekit-elementor-page-content-area">
        <?php echo wp_kses_post($primekit_page_content); ?>
    </div>
    <?php
}
