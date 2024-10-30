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
use PrimeKit\Admin\Inc\Dashboard\AvailableWidgets\AvailableWidgets;

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
    protected $AvailableWidgets;
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
        $this->AvailableWidgets = new AvailableWidgets();
    }

}