<?php
namespace PrimeKit\Admin\Inc\ThemeBuilder\Admin;

//don't load directly
if (!defined('ABSPATH')) exit;


class Column {
    public function __construct()
    {
        // Add custom columns to the 'primekit_library' post type
        add_filter('manage_primekit_library_posts_columns', array($this, 'add_custom_columns'));

        // Populate the custom columns with data
        add_action('manage_primekit_library_posts_custom_column', array($this, 'populate_custom_columns'), 10, 2);

        // Make the 'Type' column sortable
        add_filter('manage_edit-primekit_library_sortable_columns', array($this, 'make_columns_sortable'));

        // Handle sorting by the 'Type' column
        add_action('pre_get_posts', array($this, 'sort_by_type_column'));
    }

    // Add custom columns to the 'primekit_library' post type
    public function add_custom_columns($columns)
    {
      
        $new_columns = array(
            'cb' => $columns['cb'],  // Checkbox column
            'title' => esc_html__('Title', 'primekit-addons'),
            'primekit_type' => esc_html__('Type', 'primekit-addons'), 
        );
    
        // Merge the rest of the columns after 'Type'
        unset($columns['title']); 
        return array_merge($new_columns, $columns); 
    }
    

    // Populate the custom columns with data from 'primekit_themebuilder_select'
    public function populate_custom_columns($column, $post_id)
    {
        if ($column === 'primekit_type') {
            
            $type_value = get_post_meta($post_id, 'primekit_themebuilder_select', true);
    
            
            $type_labels = array(
                'archive_page' => __('Archive Page', 'primekit-addons'),
                'search_page' => __('Search Page', 'primekit-addons'),
                '404_page' => __('404 Page', 'primekit-addons'),
                'single_post' => __('Single Post', 'primekit-addons'),
                'single_page' => __('Single Page', 'primekit-addons'),
                'footer' => __('Footer', 'primekit-addons'),
                'header' => __('Header', 'primekit-addons'),
                
            );
    
            // Display the label if it exists, otherwise show the raw value
            if (!empty($type_value) && isset($type_labels[$type_value])) {
                echo esc_html($type_labels[$type_value]);
            } else {
                echo esc_html__('Unknown Type', 'primekit-addons');
            }
        }
    }
    

    // Make the 'Type' column sortable
    public function make_columns_sortable($columns)
    {
        $columns['primekit_type'] = 'primekit_type';
        return $columns;
    }

    // Handle sorting by the 'Type' column
    public function sort_by_type_column($query)
    {
        if (!is_admin() || !$query->is_main_query()) {
            return;
        }

        if ('primekit_type' === $query->get('orderby')) {
            $query->set('meta_key', 'primekit_themebuilder_select');
            $query->set('orderby', 'meta_value');
        }
    }
}
