<?php
/**
 * Render View for PrimeKit Back to Top Widget
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly
$primekit_settings = $this->get_settings_for_display();
$primekit_alwaysShowClass = ($primekit_settings['primekit_elementor_back_to_top_display_switch'] === 'yes') ? 'primekit-show-always' : '';

$primekit_buttonContent = ($primekit_settings['primekit_elementor_back_to_top_type'] === 'text' && !empty($primekit_settings['primekit_elementor_back_to_top_text'])) ? esc_html($primekit_settings['primekit_elementor_back_to_top_text']) : '<svg id="fi_3106683" enable-background="new 0 0 2000 2000" height="512" viewBox="0 0 2000 2000" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m1744 1436c-16.4 0-32.8-6.2-45.3-18.7l-698.7-698.8-698.7 698.7c-25 25-65.5 25-90.5 0s-25-65.5 0-90.5l744-744c25-25 65.5-25 90.5 0l744 744c25 25 25 65.5 0 90.5-12.5 12.6-28.9 18.8-45.3 18.8z"></path></g></g></svg>';

// Allowed SVG tags for wp_kses
$primekit_allowed_svg_tags = array(
	'svg'  => [
		'xmlns'       => [],
		'fill'        => [],
		'viewbox'     => [],
		'role'        => [],
		'aria-hidden' => [],
		'focusable'   => [],
		'height'      => [],
		'width'       => [],
	],
	'path' => [
		'd'    => [],
		'fill' => [],
	]
);
?>

<div class="primekit-elementor-back-top-area">
    <div id="primekit-back-to-top" class="<?php echo esc_attr('primekit-backtop-hidden ' . $primekit_alwaysShowClass); ?>">
        <?php echo wp_kses($primekit_buttonContent, $primekit_allowed_svg_tags); ?>
    </div>
</div><!-- end back to top area -->
