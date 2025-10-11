<?php
/**
 * Render View for PrimeKit Post Ttitle Widget
 */
 if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Get the current post title
$primekit_post_title = get_the_title();

// Check if there is a post title
if ($primekit_post_title) {
    $primekit_heading_tag = $this->get_settings('primekit_elementor_post_title_tag');
    $primekit_alignment = $this->get_settings('primekit_elementor_post_title_align');
    $primekit_text_color = $this->get_settings('primekit_elementor_post_title_color');
    ?>

        <div class="primekit-elementor-post-title-area">
            <<?php echo esc_html($primekit_heading_tag); ?> class="primekit-post-title-tag"><?php echo esc_html($primekit_post_title); ?></<?php echo esc_html($primekit_heading_tag); ?>>
        </div>
    <?php
}