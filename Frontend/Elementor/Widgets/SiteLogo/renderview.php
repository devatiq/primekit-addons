<?php
/**
 * Render View for PrimeKit Site Logo Widget
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$primekit_settings = $this->get_settings_for_display();
$primekit_site_title = get_bloginfo('name');

// Define a default logo URL.
$primekit_default_logo_url = PRIMEKIT_ELEMENTOR_ASSETS . '/img/primekit-logo.png';

if ('yes' === $primekit_settings['primekit-elementor-site-logo-custom-switch'] && !empty($primekit_settings['primekit-elementor-site-logo-custom-image']['url'])) {
    $primekit_logo_url = $primekit_settings['primekit-elementor-site-logo-custom-image']['url'];
} else {
    // Fallback to the site logo set in the WordPress Customizer if available.
    $primekit_custom_logo_id = get_theme_mod('custom_logo');
    $primekit_logo_url = $primekit_custom_logo_id ? wp_get_attachment_image_url($primekit_custom_logo_id, 'full') : $primekit_default_logo_url;
}

// Ensure the logo URL is not empty; if it is, use the default logo.
$primekit_logo_url = !empty($primekit_logo_url) ? $primekit_logo_url : $primekit_default_logo_url;

// Check if a link is provided and not just the default '#'.
$primekit_logo_link = !empty($primekit_settings['primekit-elementor-site-logo-link']['url']) && $primekit_settings['primekit-elementor-site-logo-link']['url'] != '#' ? $primekit_settings['primekit-elementor-site-logo-link']['url'] : '';

?>
<div class="primekit-elementor-site-logo-area">
    <?php if (!empty($primekit_logo_link)): ?>
        <a href="<?php echo esc_url($primekit_logo_link); ?>" <?php echo $primekit_settings['primekit-elementor-site-logo-link']['is_external'] ? 'target="_blank"' : ''; ?> <?php echo $primekit_settings['primekit-elementor-site-logo-link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
            <img src="<?php echo esc_url($primekit_logo_url); ?>" alt="<?php echo esc_attr($primekit_site_title); ?>">
        </a>
    <?php else: ?>
        <img src="<?php echo esc_url($primekit_logo_url); ?>" alt="<?php echo esc_attr($primekit_site_title); ?>">
    <?php endif; ?>
</div><!-- end site logo area -->
