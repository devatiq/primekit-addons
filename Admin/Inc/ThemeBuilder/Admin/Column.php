<?php
/**
 * Column.php
 *
 * This file contains the Column class, which is responsible for adding
 * custom columns to the Theme Builder page and populating them with data.
 *
 * @package PrimeKit\Admin\Inc\ThemeBuilder\Admin
 * @since 1.0.0
 */

namespace PrimeKit\Admin\Inc\ThemeBuilder\Admin;

//don't load directly
if (!defined('ABSPATH')) exit;

/**
 * Class Column
 * 
 * Handles the addition of custom columns to the Theme Builder page and populating them with data.
 * 
 * @package PrimeKit\Admin\Inc\ThemeBuilder\Admin
 * @since 1.0.0
 */
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

    /**
     * Adds custom columns to the 'primekit_library' post type.
     * 
     * This function adds a new column for the 'Type' column and removes the default 'Title' column.
     * 
     * @param array $columns The existing columns.
     * 
     * @return array The modified columns.
     * 
     * @since 1.0.0
     */
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
    

    /**
     * Populates the custom columns with data from 'primekit_themebuilder_select'.
     * 
     * This function checks if the current column is the 'Type' column and displays
     * the corresponding template type label.
     * 
     * @param string $column The column name.
     * @param int $post_id The ID of the post.
     * 
     * @return void
     * 
     * @since 1.0.0
     */
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
                'shop_single' => __('Single Product', 'primekit-addons'),
                'shop_archive' => __('Shop Archive', 'primekit-addons'),
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
    

    /**
     * Makes the 'Type' column sortable.
     * 
     * This function adds the 'Type' column to the sortable columns array.
     * 
     * @param array $columns The existing sortable columns.
     * 
     * @return array The modified sortable columns.
     * 
     * @since 1.0.0
     */
    public function make_columns_sortable($columns)
    {
        $columns['primekit_type'] = 'primekit_type';
        return $columns;
    }

    /**
     * Handles sorting by the 'Type' column.
     * 
     * This function checks if the current query is the main query and if the
     * 'orderby' parameter is set to 'primekit_type'. If so, it sets the meta key
     * and order to sort by the 'primekit_themebuilder_select' meta field.
     * 
     * @param \WP_Query $query The current query.
     * 
     * @return void
     * 
     * @since 1.0.0
     */
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
