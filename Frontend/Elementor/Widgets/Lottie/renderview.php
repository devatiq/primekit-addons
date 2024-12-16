<?php
/**
 * Render View for Lottie Widget
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$settings = $this->get_settings_for_display();

// Generate Lottie URL
$lottie_url = '';
if ('media_file' === $settings['source'] && !empty($settings['source_json']['url'])) {
    $lottie_url = esc_url($settings['source_json']['url']);
} elseif ('external_url' === $settings['source'] && !empty($settings['source_external_url']['url'])) {
    $lottie_url = esc_url($settings['source_external_url']['url']);
}

// Check if Lottie URL is valid
if (empty($lottie_url)) {
    echo '<div class="primekit-lottie-error">' . esc_html__('Lottie animation source not set!', 'primekit-addons') . '</div>';
    return;
}

// Generate Caption
$caption = '';
if ('custom' === $settings['caption_source']) {
    $caption = !empty($settings['caption']) ? esc_html($settings['caption']) : '';
} elseif ('caption' === $settings['caption_source'] && !empty($settings['source_json']['id'])) {
    $caption = wp_get_attachment_caption($settings['source_json']['id']);
} elseif ('title' === $settings['caption_source'] && !empty($settings['source_json']['id'])) {
    $caption = get_the_title($settings['source_json']['id']);
}
$widget_caption = $caption ? '<p class="primekit-lottie-caption">' . $caption . '</p>' : '';

// Generate Animation Attributes
$animation_attributes = [
    'data-lottie-url' => $lottie_url,
    'data-trigger' => esc_attr($settings['trigger']),
    'data-loop' => $settings['loop'] ? 'true' : 'false',
    'data-renderer' => esc_attr($settings['renderer']),
    'data-speed' => isset($settings['play_speed']['size']) ? esc_attr($settings['play_speed']['size']) : '1',
    'data-start-point' => isset($settings['start_point']['size']) ? esc_attr($settings['start_point']['size']) : '0',
    'data-end-point' => isset($settings['end_point']['size']) ? esc_attr($settings['end_point']['size']) : '100',
    'class' => 'primekit-lottie-animation',
];

// Prepare Animation Div
$animation_div = '<div';
foreach ($animation_attributes as $key => $value) {
    $animation_div .= ' ' . $key . '="' . $value . '"';
}
$animation_div .= '></div>';

// Generate Lottie Container
$container_class = 'primekit-lottie-container elementor-align-' . esc_attr($settings['align']);
$widget_container = '<div class="' . esc_attr($container_class) . '">' . $animation_div . $widget_caption . '</div>';

// Wrap with Link if Custom Link is Set
if (!empty($settings['custom_link']['url']) && 'custom' === $settings['link_to']) {
    $this->add_link_attributes('custom_link', $settings['custom_link']);
    $widget_container = sprintf(
        '<a class="primekit-lottie-container-link" %1$s>%2$s</a>',
        $this->get_render_attribute_string('custom_link'),
        $widget_container
    );
}

// Output the Widget
echo $widget_container; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
?>
