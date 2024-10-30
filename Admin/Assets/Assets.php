<?php 
namespace PrimeKit\Admin\Assets;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * Assets class
 * Handles the initialization and configuration of the PrimeKit Admin.
 * It ensures the proper setup of the required configurations and functionalities
 * for the PrimeKit Admin.
 *
 * @package PrimeKit\Admin
 * @since 1.0.0
 */
class Assets
{
    /**
     * Assets constructor.
     *
     * Initializes the Assets by setting constants and initiating configurations
     * necessary for the PrimeKit Admin setup.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_assets']);
        
    }

    /**
     * Enqueues and registers CSS and JavaScript assets for the PrimeKit Admin.
     *
     * This method hooks into the WordPress 'admin_enqueue_scripts' action
     * to enqueue the necessary styles and scripts for the PrimeKit Admin.
     *
     * @since 1.0.0
     */
    public function admin_enqueue_assets() {
        wp_enqueue_style('primekit-admin-style', PRIMEKIT_ADMIN_ASSETS . "/css/admin-style.css", array(), PRIMEKIT_VERSION);
    }

 
}