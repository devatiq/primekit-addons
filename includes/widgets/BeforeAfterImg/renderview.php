<?php
/**
 * Render View for ABC Before After Image
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly
$primekit_settings = $this->get_settings_for_display();
$id = $this->get_id(); 

$primekit_before_label = !empty($primekit_settings['primekit_elementor_before_label_text']) ? $primekit_settings['primekit_elementor_before_label_text'] : 'Before';
$primekit_after_label = !empty($primekit_settings['primekit_elementor_after_label_text']) ? $primekit_settings['primekit_elementor_after_label_text'] : 'After';
$primekit_before_img_vis = isset($primekit_settings['primekit_elementor_before_img_visibility']['size']) ? $primekit_settings['primekit_elementor_before_img_visibility']['size'] : '0.5';
$primekit_bef_af_orientaion = !empty($primekit_settings['primekit_elementor_before_after_orientation']) ? $primekit_settings['primekit_elementor_before_after_orientation'] : 'horizontal';

$show_overlay = !empty($primekit_settings['primekit_elementor_before_after_switch']) && $primekit_settings['primekit_elementor_before_after_switch'] === 'true';
$no_overlay = $show_overlay;
$handle_move_type = !empty($primekit_settings['primekit_elementor_before_after_handle_move']) ? $primekit_settings['primekit_elementor_before_after_handle_move'] : 'on_swipe';
$move_slider_on_hover = $handle_move_type === 'on_hover' ? 'true' : 'false';
$move_with_handle_only = $handle_move_type === 'on_swipe' ? 'true' : 'false';
$click_to_move = $handle_move_type === 'on_click' ? 'true' : 'false';
?>

<div class="primekit-elementor-before-after-image">
    <div id="primekit-before-after-container" class="primekit-before-after-container-<?php echo esc_attr($id); ?>">
        <!-- The before image is first -->
        <img src="<?php echo esc_url($primekit_settings['primekit_elementor_before_img_upload']['url']); ?>" alt="<?php echo esc_attr($primekit_settings['primekit_elementor_before_img_alt']); ?>">
        <!-- The after image is last -->
        <img src="<?php echo esc_url($primekit_settings['primekit_elementor_after_img_upload']['url']); ?>" alt="<?php echo esc_attr($primekit_settings['primekit_elementor_after_img_alt']); ?>">
    </div>
</div><!-- end before after image  -->

<script>
  jQuery(document).ready(function($) {
    $(".primekit-before-after-container-<?php echo esc_attr($id); ?>").twentytwenty({
      default_offset_pct: <?php echo esc_attr($primekit_before_img_vis); ?>,
      before_label: '<?php echo esc_html($primekit_before_label); ?>',
      after_label: '<?php echo esc_html($primekit_after_label); ?>',
      orientation: '<?php echo esc_html($primekit_bef_af_orientaion); ?>',
      no_overlay: <?php echo esc_attr($no_overlay) ? 'true' : 'false'; ?>,
      move_slider_on_hover: <?php echo esc_attr($move_slider_on_hover); ?>,
      move_with_handle_only: <?php echo esc_attr($move_with_handle_only); ?>,
      click_to_move: <?php echo esc_attr($click_to_move); ?>,
    });
  });
</script>
