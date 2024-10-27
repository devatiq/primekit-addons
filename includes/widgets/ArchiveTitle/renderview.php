<?php
/**
 * Render View for ABC Archive Title Widget
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Get the current archive title
$archive_title = get_the_archive_title();

// Check if there is an archive title
if ($archive_title) {
    $heading_tag = $this->get_settings('primekit_elementor_archive_title_tag');
    $alignment = $this->get_settings('primekit_elementor_archive_title_align');
    $text_color = $this->get_settings('primekit_elementor_archive_title_color');
    ?>

    <div class="primekit-elementor-archive-title-area">
        <<?php echo esc_html($heading_tag); ?> class="primekit-archive-title-tag"><?php echo esc_html($archive_title); ?></<?php echo esc_html($heading_tag); ?>>
    </div>

<?php
}
