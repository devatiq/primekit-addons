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
            <p><?php _e('List of available widgets for PrimeKit.', 'primekit-addons'); ?></p>
            <!-- Display the available widgets or other content here -->
        </div>
        <?php
    }
}