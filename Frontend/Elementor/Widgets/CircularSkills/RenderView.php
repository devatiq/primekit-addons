<?php
/**
 * Render View file for PrimeKit Circular Skills.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$id = $this->get_id(); //unique id for this widget


$primekit_skills_text     = $primekit_settings['primekit_elementor_circl_skill_text'] ? $primekit_settings['primekit_elementor_circl_skill_text'] : '';
$primekit_skills_value    = $primekit_settings['primekit_elementor_circl_skill_value'] ? $primekit_settings['primekit_elementor_circl_skill_value'] : '80';
$primekit_skill_empty_color = $primekit_settings['primekit_elementor_circl_skill_empty_fill_color'] ? $primekit_settings['primekit_elementor_circl_skill_empty_fill_color'] : 'rgba(0, 0, 0, .3)';
$primekit_skill_style     = 'skilldark';
$primekit_skill_color_one = $primekit_settings['primekit_elementor_circl_skill_fill_gradient_color_one'] ? $primekit_settings['primekit_elementor_circl_skill_fill_gradient_color_one'] : '#e60a0a';
$primekit_skill_color_two = $primekit_settings['primekit_elementor_circl_skill_fill_gradient_color_two'] ? $primekit_settings['primekit_elementor_circl_skill_fill_gradient_color_two'] : '#d1de04';
$primekit_skill_cir_size = isset($primekit_settings['primekit_elementor_circl_skill_size']['size']) ? $primekit_settings['primekit_elementor_circl_skill_size']['size'] : '180';


// Prepare the configuration data
$circleConfig = wp_json_encode([
    'skillValue' => $primekit_skills_value / 100, // Convert to a decimal for JS
    'skillSize' => $primekit_skill_cir_size,
    'skillColorOne' => $primekit_skill_color_one,
    'skillColorTwo' => $primekit_skill_color_two,
    'skillEmptyColor' => $primekit_skill_empty_color,
]);
?>

<div class="primekit-ele-skill-area">
    <div class="primekit-ele-skill-circle primekit-ele-skill-<?php echo esc_attr($id); ?>" 
         data-circle-config='<?php echo esc_attr($circleConfig); ?>'>
        <strong></strong>
        <span><?php echo esc_attr($primekit_skills_text); ?></span>
    </div>
</div><!-- end skill area -->

