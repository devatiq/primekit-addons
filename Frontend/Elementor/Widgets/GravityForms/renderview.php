<?php
/**
 * Render View for Gravity Forms
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$settings = $this->get_settings_for_display();
$form_id = isset($settings['primekit_gf_form_id']) ? $settings['primekit_gf_form_id'] : '';

// Get other form settings from Elementor controls
$display_title = isset($settings['display_title']) && $settings['display_title'] === 'yes' ? true : false;
$display_description = isset($settings['display_description']) && $settings['display_description'] === 'yes' ? true : false;
$enable_ajax = isset($settings['enable_ajax']) && $settings['enable_ajax'] === 'yes' ? true : false;
$field_values = isset($settings['field_values']) ? $settings['field_values'] : '';
$tabindex = isset($settings['tabindex']) ? $settings['tabindex'] : 1;

$label_hide = isset($settings['hide_label']) && $settings['hide_label'] === 'yes' ? 'primekit-gravity-form-label-hide' : '';

$hide_sub_label = isset($settings['hide_sub_label']) && $settings['hide_sub_label'] === 'yes' ? 'primekit-gravity-form-sub-label-hide' : '';


?>

<div class="primekit-gravity-form-wrapper <?php echo esc_attr($label_hide); ?> <?php echo esc_attr($hide_sub_label); ?>">
    <?php
    if (!empty($form_id)) {
        // Check if the form exists and if it's active
        $form = \GFAPI::get_form($form_id);
        if ($form && !rgar($form, 'is_trash') && rgar($form, 'is_active')) {
            // Render the form with all customizable settings
            gravity_form($form_id, $display_title, $display_description, false, $field_values, $enable_ajax, $tabindex, true);
        } else {
            // Show a notice if the form is not active or is trashed
            ?>
            <div class="gravity-forms-missing-notice">
                <strong><?php echo esc_html__('The selected form does not exist, is inactive, or has been removed.', 'primekit-addons'); ?></strong>
            </div>
            <?php
        }
    } else {
        // Show a notice if no form is selected
        ?>
        <div class="gravity-forms-missing-notice">
            <strong><?php echo esc_html__('No form selected', 'primekit-addons'); ?></strong>
        </div>
        <?php
    }
    ?>
</div>