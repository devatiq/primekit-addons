<?php
namespace PrimeKit\Admin\Inc\ThemeBuilder\Classes;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Class PostTypes
 * 
 * Handles the creation of the Theme Builder custom post type.
 * 
 * @package PrimeKit\Admin\Inc\ThemeBuilder\Classes
 * @since 1.0.0
 */

class PostTypes {
    public function __construct()
    {
        add_action('init', array($this, 'create_themebuilder_cpt'));
    }

    /**
     * Creates the Theme Builder custom post type.
     *
     * @return void
     * @since 1.0.0
     */

    public function create_themebuilder_cpt()
    {
        $labels = array(
            'name' => _x('Theme Builder', 'Post Type General Name', 'primekit-addons'),
            'singular_name' => _x('Theme Builder', 'Post Type Singular Name', 'primekit-addons'),
            'menu_name' => _x('Theme Builder', 'Admin Menu text', 'primekit-addons'),
            'name_admin_bar' => _x('Theme Builder', 'Add New on Toolbar', 'primekit-addons'),
            'archives' => __('Theme Builder Archives', 'primekit-addons'),
            'attributes' => __('Theme Builder Attributes', 'primekit-addons'),
            'parent_item_colon' => __('Parent Theme Builder:', 'primekit-addons'),
            'all_items' => __('All Theme Builders', 'primekit-addons'),
            'add_new_item' => __('Add New Theme Builder', 'primekit-addons'),
            'add_new' => __('Add New', 'primekit-addons'),
            'new_item' => __('New Theme Builder', 'primekit-addons'),
            'edit_item' => __('Edit Theme Builder', 'primekit-addons'),
            'update_item' => __('Update Theme Builder', 'primekit-addons'),
            'view_item' => __('View Theme Builder', 'primekit-addons'),
            'view_items' => __('View Theme Builders', 'primekit-addons'),
            'search_items' => __('Search Theme Builders', 'primekit-addons'),
            'not_found' => __('Not found', 'primekit-addons'),
            'not_found_in_trash' => __('Not found in Trash', 'primekit-addons'),
            'featured_image' => __('Featured Image', 'primekit-addons'),
            'set_featured_image' => __('Set featured image', 'primekit-addons'),
            'remove_featured_image' => __('Remove featured image', 'primekit-addons'),
            'use_featured_image' => __('Use as featured image', 'primekit-addons'),
            'insert_into_item' => __('Insert into Theme Builder', 'primekit-addons'),
            'uploaded_to_this_item' => __('Uploaded to this Theme Builder', 'primekit-addons'),
            'items_list' => __('Theme Builder list', 'primekit-addons'),
            'items_list_navigation' => __('Theme Builder list navigation', 'primekit-addons'),
            'filter_items_list' => __('Filter Theme Builder list', 'primekit-addons'),
        );
        $args = array(
            'label' => __('Theme Builder', 'primekit-addons'),
            'description' => __('Custom Post Type for Theme Builder', 'primekit-addons'),
            'labels' => $labels,
            'supports' => array('title', 'elementor'),            
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => false,
            'show_in_admin_bar' => false,
            'show_in_nav_menus' => false,
            'can_export' => true,
            'has_archive' => false,
            'hierarchical' => false,
            'exclude_from_search' => true,
            'capability_type' => 'page',
            'menu_icon' => 'dashicons-layout', // Set an icon for your CPT
        );
        register_post_type('primekit_library', $args);
    }
}