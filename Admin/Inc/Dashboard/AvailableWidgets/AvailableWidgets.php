<?php 
namespace PrimeKit\Admin\Inc\Dashboard\AvailableWidgets;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class AvailableWidgets
{
    public function __construct()
    {
        // Hook to add the submenu
        add_action('admin_menu', [$this, 'add_widgets_submenu']);
    }

    public function add_widgets_submenu()
    {
        add_submenu_page(
            'primekit_settings',             // Parent slug (the top-level menu slug)
            __('Available Widgets', 'primekit-addons'), // Page title
            __('Available Widgets', 'primekit-addons'), // Menu title
            'manage_options',                // Capability
            'primekit_available_widgets',    // Submenu slug
            [$this, 'render_available_widgets_page']    // Callback function
        );
    }

    public function render_available_widgets_page()
    {
        ?>
        <div class="wrap">
            <h1><?php _e('Available Widgets', 'primekit-addons'); ?></h1>
    
            <h2 class="nav-tab-wrapper">
                <a href="#regular" class="nav-tab nav-tab-active"><?php _e('Regular', 'primekit-addons'); ?></a>
                <a href="#woocommerce" class="nav-tab"><?php _e('WooCommerce', 'primekit-addons'); ?></a>
            </h2>
    
            <div id="regular" class="tab-content">
                <h3><?php _e('Regular Widgets', 'primekit-addons'); ?></h3>
                <p><?php _e('List of regular widgets available in PrimeKit.', 'primekit-addons'); ?></p>
                <!-- Add content for regular widgets here -->
            </div>
    
            <div id="woocommerce" class="tab-content" style="display: none;">
                <h3><?php _e('WooCommerce Widgets', 'primekit-addons'); ?></h3>
                <p><?php _e('List of WooCommerce widgets available in PrimeKit.', 'primekit-addons'); ?></p>
                <!-- Add content for WooCommerce widgets here -->
            </div>
        </div>    
        <?php
    }
    
}