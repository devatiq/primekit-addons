<?php
namespace PrimeKit\Admin\Inc\ThemeBuilder\Classes;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MetaBox
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_custom_meta_box'));
        add_action('save_post', array($this, 'save_meta_box_data'));
    }

    public function add_custom_meta_box()
    {
        add_meta_box(
            'primekit_themebuilder_select',            // ID of the meta box
            __('Choose Template Type', 'primekit-addons'), // Title of the meta box
            array($this, 'meta_box_callback'),       // Callback function
            'primekit_library',                       // Post type
            'advanced',                                 // Context
            'default'                               // Priority
        );
    }


    public function meta_box_callback($post)
    {
        // Nonce field for security
        wp_nonce_field('primekit_custom_box', 'primekit_custom_box_nonce');
    
        // Get the current values of the fields
        $template_value = get_post_meta($post->ID, 'primekit_themebuilder_select', true);
        $display_condition_value = get_post_meta($post->ID, 'primekit_display_condition_select', true);
        $specific_item_value = get_post_meta($post->ID, 'primekit_specific_item_value', true); // New field for specific options
    
        // Start table layout
        echo '<table class="form-table"><tbody>';
    
        // Row for Template Type
        echo '<tr>';
        echo '<th><label for="primekit_themebuilder_select">' . esc_html__('Type:', 'primekit-addons') . '</label></th>';
        echo '<td>';
        echo '<select id="primekit_themebuilder_select" name="primekit_themebuilder_select">';
        echo '<option value="">' . esc_html__('Select...', 'primekit-addons') . '</option>';
        echo '<option value="header"' . selected($template_value, 'header', false) . '>' . esc_html__('Header (Global)', 'primekit-addons') . '</option>';
        echo '<option value="footer"' . selected($template_value, 'footer', false) . '>' . esc_html__('Footer (Global)', 'primekit-addons') . '</option>';
        echo '<option value="single_post"' . selected($template_value, 'single_post', false) . '>' . esc_html__('Single Post', 'primekit-addons') . '</option>';
        echo '<option value="single_page"' . selected($template_value, 'single_page', false) . '>' . esc_html__('Single Page', 'primekit-addons') . '</option>';
        echo '<option value="search_page"' . selected($template_value, 'search_page', false) . '>' . esc_html__('Search Page', 'primekit-addons') . '</option>';
        echo '<option value="404_page"' . selected($template_value, '404_page', false) . '>' . esc_html__('404 Page', 'primekit-addons') . '</option>';
        echo '<option value="archive_page"' . selected($template_value, 'archive_page', false) . '>' . esc_html__('Archive Page', 'primekit-addons') . '</option>';
        echo '</select>';
        echo '</td>';
        echo '</tr>';
    

        // Row for Display Condition with optgroup
        echo '<tr style="display:none">';
        echo '<th><label for="primekit_display_condition_select">' . esc_html__('Display Condition:', 'primekit-addons') . '</label></th>';
        echo '<td>';
        echo '<select id="primekit_display_condition_select" name="primekit_display_condition_select">';

        echo '<option value="entire_site"' . selected($display_condition_value, 'entire_site', false) . '>' . esc_html__('Entire Site', 'primekit-addons') . '</option>';


        echo '</td>';
        echo '</tr>';
        // End table layout
        echo '</tbody></table>';


    }
    

    public function save_meta_box_data($post_id)
    {
        // Check nonce validity
        if (!isset($_POST['primekit_custom_box_nonce']) || !wp_verify_nonce($_POST['primekit_custom_box_nonce'], 'primekit_custom_box')) {
            return $post_id;
        }

        // Check the user's permissions.
        if ('primekit_library' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }

        // Save or Update the meta box field values
        $new_template_value = (isset($_POST['primekit_themebuilder_select']) ? sanitize_text_field($_POST['primekit_themebuilder_select']) : '');
        $new_display_condition_value = (isset($_POST['primekit_display_condition_select']) ? sanitize_text_field($_POST['primekit_display_condition_select']) : '');
        $new_specific_item_value = (isset($_POST['primekit_specific_item_value']) ? sanitize_text_field($_POST['primekit_specific_item_value']) : '');

        update_post_meta($post_id, 'primekit_themebuilder_select', $new_template_value);
        update_post_meta($post_id, 'primekit_display_condition_select', $new_display_condition_value);

        // Only save specific item value if one of the specific options is selected
        if (in_array($new_display_condition_value, ['category_specific', 'post_specific', 'page_specific'])) {
            update_post_meta($post_id, 'primekit_specific_item_value', $new_specific_item_value);
        } else {
            delete_post_meta($post_id, 'primekit_specific_item_value');
        }
    }



}
