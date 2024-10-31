<?php
namespace PrimeKit\Admin\Assets;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


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
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_styles']);

        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);

    }


    /**
     * Enqueues CSS styles for the PrimeKit Admin.
     * 
     * This function enqueues the main stylesheet for the PrimeKit Admin.
     * 
     * @since 1.0.0
     */
    public function admin_enqueue_styles()
    {
        wp_enqueue_style('primekit-admin-style', PRIMEKIT_ADMIN_ASSETS . "/css/admin-style.css", array(), PRIMEKIT_VERSION);
    }


    /**
     * Enqueues JavaScript scripts for the PrimeKit Admin.
     *
     * This function enqueues the scripts for the "Available Widgets" page.
     *
     * @param string $hook_suffix The current admin page hook suffix.
     *
     * @since 1.0.0
     */
    public function admin_enqueue_scripts($hook_suffix)
    {
        // Check if we're on the "Available Widgets" submenu page
        if (isset($_GET['page']) && $_GET['page'] === 'primekit_available_widgets') {
            wp_enqueue_script(
                'primekit-available-widgets',
                PRIMEKIT_ADMIN_ASSETS . '/js/available-widgets.js',
                array(),
                '1.0.0',
                true
            );
            wp_localize_script('primekit-available-widgets', 'PrimeKitWidgetsSwitch', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('primekit_nonce')
            ));
        }

    }

}