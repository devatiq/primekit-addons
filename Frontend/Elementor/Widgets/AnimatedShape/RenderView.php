<?php
/**
 * Render View file for PrimeKit Shape Widget.
 */
 if (!defined('ABSPATH')) exit; // Exit if accessed directly

$settings = $this->get_settings_for_display();
$primekit_anim_id = $this->get_id(); //unique id for this widget

$primekit_shape_type = $settings['primekit_elementor_shape_type'] ?? 'default'; 
$primekit_image_shape = isset($settings['primekit_elementor_shape_image']['url']) ? $settings['primekit_elementor_shape_image']['url'] : '';
$primekit_shape_alt = $settings['primekit_elementor_shape_image_alt']; 

$primekit_animation = 'none';
if (isset($settings['primekit_elementor_shape_animation']) && 'yes' == $settings['primekit_elementor_shape_animation']) {
    $primekit_animation = $settings['primekit_elementor_shape_animation_effect'] ?? 'default_animation_effect';
}

?>

<div class="primekit-shape-area">
<div class="primekit-shape-<?php echo esc_attr($primekit_shape_type); if ('image' != $primekit_shape_type) { echo esc_attr(' primekit-ele-shape'); } ?> <?php echo esc_attr($primekit_animation); ?>">
        <?php 
            if ('image' == $primekit_shape_type) {
                echo '<img src="' . esc_url($primekit_image_shape) . '" alt="' . esc_attr($primekit_shape_alt) . '"/>';
            }
        ?>
    </div>
</div>

