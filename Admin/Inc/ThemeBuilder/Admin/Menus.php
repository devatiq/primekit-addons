<?php
/**
 * Menus.php
 *
 * This file contains the Menus class, which is responsible for adding
 * the custom meta box to the Theme Builder page and saving the meta box data.
 *
 * @package PrimeKit\Admin\Inc\ThemeBuilder\Admin
 * @since 1.0.0
 */

namespace PrimeKit\Admin\Inc\ThemeBuilder\Admin;

if (!defined('ABSPATH'))
    exit;

/**
 * Class Menus
 * 
 * Handles the addition of the custom meta box to the Theme Builder page and saving the meta box data.
 * 
 * @package PrimeKit\Admin\Inc\ThemeBuilder\Admin
 * @since 1.0.0
 */
class Menus
{

    public function __construct()
    {
      //  add_action('admin_menu', array($this, 'modify_theme_builder_menu'), 11);
        add_action('admin_menu', array($this, 'add_themebuilder_submenu'));
    }

    /**
     * Adds the Theme Builder submenu to the PrimeKit menu.
     * 
     * This function adds a new submenu page to the PrimeKit menu, linking to the
     * post type 'primekit_library' (Theme Builder).
     * 
     * @return void
     * 
     * @since 1.0.0
     */
    public function add_themebuilder_submenu()
    {
        
        add_submenu_page(
            'primekit_home',                   // Parent slug
            __('Theme Builder', 'primekit-addons'), // Page title
            __('Theme Builder', 'primekit-addons'), // Menu title
            'manage_options',                       // Capability
            'edit.php?post_type=primekit_library'   // Menu slug (linking to post type)
        );
    }

    /**
     * Modifies the Theme Builder menu.
     * 
     * This function removes the default Theme Builder menu and modifies the
     * submenu page to be the default page for the post type 'primekit_library'.
     * 
     * @return void
     * 
     * @since 1.0.0
     */
    public function modify_theme_builder_menu()
    {
        global $submenu;


       // remove_menu_page('edit.php?post_type=primekit_library');

    

        if (isset($submenu['primekit_home'])) {
            foreach ($submenu['primekit_home'] as $key => $menu_item) {
                if ($menu_item[2] === 'edit.php?post_type=primekit_library') {
                    $current_file = basename($_SERVER['PHP_SELF']);
                    if ($current_file === 'post-new.php' && isset($_GET['post_type']) === 'primekit_library') {
                        // Highlight the new submenu as active when adding a new post
                        $submenu['primekit_home'][$key][4] = 'current';
                    } elseif ($current_file === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'primekit_library') {
                        // Highlight the new submenu as active when on the edit posts screen
                        $submenu['primekit_home'][$key][4] = 'current';
                    }
                }
            }
        }
    }
}