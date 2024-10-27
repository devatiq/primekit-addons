<?php
/**
 * Render View for ABC Page Ttitle Widget
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Get the current post title
$primekit_page_title = get_the_title();

// Check if there is a post title
if ($primekit_page_title) {
    $primekit_heading_tag = $this->get_settings('primekit_elementor_page_title_tag');
    $primekit_alignment = $this->get_settings('primekit_elementor_page_title_align');
    $primekit_text_color = $this->get_settings('primekit_elementor_page_title_color');
    ?>

        <div class="primekit-elementor-page-title-area">
            <<?php echo esc_html($primekit_heading_tag); ?> class="primekit-page-title-tag"><?php echo esc_html($primekit_page_title); ?></<?php echo esc_html($primekit_heading_tag); ?>>
        </div>
    <?php
}
?>
