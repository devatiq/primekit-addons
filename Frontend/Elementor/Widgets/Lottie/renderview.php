<?php
/**
 * Render View for Lottie
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$settings = $this->get_settings_for_display();
$unique_id = $this->get_id();

$source = $settings['lottie_source'];
$url = ($source === 'media_file') ? $settings['lottie_media_file']['url'] : $settings['lottie_external_url'];
$autoplay = $settings['autoplay'] ? 'true' : 'false';
$loop = $settings['loop'] ? 'true' : 'false';
$loop_count = $settings['loop_count']['size'] ?? '';
$reverse = $settings['reverse'] ? '-1' : '1';
$render_type = $settings['render_type'] ?? 'svg';
$hover_action = $settings['on_hover_action'] ?? '';
$speed = $settings['speed']['size'] ?? 1;

if (empty($url)) {
    echo esc_html__('Please provide a valid JSON file.', 'primekit-addons');
    return;
}

$wrapper_id = 'primekit-lottie-' . $this->get_id();

echo sprintf(
    '<div id="%s" class="primekit-lottie-wrapper" 
				data-lottie-json="%s" 
				data-autoplay="%s" 
				data-loop="%s" 
				data-loop-count="%s" 
				data-reverse="%s" 
				data-renderer="%s" 
				data-hover-action="%s" 
				data-speed="%s" 
				style="height: auto;"></div>',
    esc_attr($wrapper_id),
    esc_url($url),
    esc_attr($autoplay),
    esc_attr($loop),
    esc_attr($loop_count),
    esc_attr($reverse),
    esc_attr($render_type),
    esc_attr($hover_action),
    esc_attr($speed)
);