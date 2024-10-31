<?php 
/**
 * AdminManager.php
 *
 * This file contains the AdminManager class, which is responsible for handling the
 * initialization and configuration of the PrimeKit Admin.
 * It ensures the proper setup of the required configurations and functionalities
 * for the PrimeKit Admin.
 *
 * @package PrimeKit\Admin
 * @since 1.0.0
 */
namespace PrimeKit\Admin;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


use PrimeKit\Admin\Inc\Dashboard\Settings\Settings;
use PrimeKit\Admin\Assets\Assets;
use PrimeKit\Admin\Inc\Dashboard\AvailableWidgets\PrimeKitWidgets;

/**
 * Class AdminManager
 * Handles the initialization and configuration of the PrimeKit Admin.
 * It ensures the proper setup of the required configurations and functionalities
 * for the PrimeKit Admin.
 *
 * @package PrimeKit\Admin
 * @since 1.0.0
 */
class AdminManager
{
    protected $settings;
    protected $Assets;
    protected $PrimeKitWidgets;
    /**
     * AdminManager constructor.
     *
     * Initializes the AdminManager by setting constants and initiating configurations
     * necessary for the PrimeKit Admin setup.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->setConstants();
        $this->init();
        add_action('wp_ajax_primekit_save_widget_setting', [$this,'primekit_save_widget_setting']);
    }

    /**
     * Sets the constants for the PrimeKit Admin.
     *
     * Defines the URL path for the PrimeKit Admin assets directory.
     *
     * @since 1.0.0
     */
    public function setConstants()
    {
        define('PRIMEKIT_ADMIN_ASSETS', plugin_dir_url(__FILE__) . 'assets');
    }


    /**
     * Initializes the classes used by the PrimeKit Admin.
     *
     * This function instantiates the settings and assets classes.
     *
     * @since 1.0.0
     */
    public function init()
    {
        $this->settings = new Settings();    
        $this->Assets = new Assets();   
        $this->PrimeKitWidgets = new PrimeKitWidgets();
    }



        public function primekit_save_widget_setting()
        {
        check_ajax_referer('primekit_nonce', 'nonce'); // Verify nonce for security

        // Retrieve the checkbox name and value
        $widget_name = sanitize_text_field($_POST['widgetName']);
        $value = sanitize_text_field($_POST['value']);
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        // Save the setting in the options table
        update_option($widget_name, $value);

        wp_send_json_success('Setting saved.');
        wp_die();
        }

}