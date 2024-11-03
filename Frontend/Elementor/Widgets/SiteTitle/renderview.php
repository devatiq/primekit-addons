<?php
/**
 * Render View for PrimeKit Site Title and Tagline Widget
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Retrieve settings
$primekit_settings = $this->get_settings_for_display();

// Determine if site title and tagline should be displayed
$display_site_title = $primekit_settings['primekit-elementor-site-title-switch'] === 'yes';
$display_tagline = $primekit_settings['primekit-elementor-site-tagline-switch'] === 'yes';

// Retrieve site title, tagline, and their respective tags
$primekit_site_title = get_bloginfo('name');
$primekit_site_tagline = get_bloginfo('description');
$primekit_site_title_tag = $primekit_settings['primekit-elementor-site-title-tag'];
$primekit_site_tagline_tag = $primekit_settings['primekit-elementor-site-tagline-tag'];
?>

<!-- Site Title -->
<?php if ($display_site_title): ?>
    <div class="primekit-elementor-site-title-area">
        <<?php echo esc_attr($primekit_site_title_tag); ?> class="primekit-ele-site-title">
            <?php echo esc_html($primekit_site_title); ?>
        </<?php echo esc_attr($primekit_site_title_tag); ?>>
    </div><!-- end site title area -->
<?php endif; ?>

<!-- Tagline -->
<?php if ($display_tagline): ?>
    <div class="primekit-elementor-site-tagline-area">
        <<?php echo esc_attr($primekit_site_tagline_tag); ?> class="primekit-ele-site-tagline">
            <?php echo esc_html($primekit_site_tagline); ?>
        </<?php echo esc_attr($primekit_site_tagline_tag); ?>>
    </div><!-- end tagline area -->
<?php endif; ?>
