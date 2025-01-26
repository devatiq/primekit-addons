<?php
/**
 * PrimeKit Template Class
 *
 * This class is responsible for handling the initial setup of the theme.
 *
 * @package PrimeKit
 * @subpackage PrimeKit/Admin/Inc/Templates
 * @author SupreoX Limited
 * @since 1.0.5
 */
namespace PrimeKit\Admin\Inc\Templates;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use PrimeKit\Admin\Inc\Templates\Assets\Assets;
/**
 * Class Template
 *
 * The Template class is responsible for handling the initial setup of the theme within the PrimeKit package.
 * It performs necessary actions during the admin initialization process to ensure the theme setup is executed correctly.
 *
 * @package PrimeKit\Admin\Inc\Templates
 * @since 1.0.5
 */

class Templates
{

    protected $assets;

    /**
     * Initializes the PrimeKit Template class.
     *
     * This function sets up the PrimeKit Template by setting constants and initializing the classes used by the PrimeKit Template.
     *
     * @since 1.0.5
     */
    public function __construct()
    {
        $this->setConstants(); // Set the constants.
        $this->init_classes(); // Initialize the classes.
    }


    /**
     * Initializes the classes used by the PrimeKit Template.
     *
     * This function sets up the Assets class, which handles the initialization and configuration of the PrimeKit Template assets.
     *
     * @since 1.0.5
     */
    public function init_classes()
    {
        $this->assets = new Assets();
    }

    /**
     * Sets the constants for the PrimeKit Template.
     *
     * Defines the URL path for the PrimeKit Template assets directory.
     *
     * @since 1.0.5
     */
    public function setConstants()
    {
        define('PRIMEKIT_TEMPLATE_ASSETS', plugin_dir_url(__FILE__) . 'Assets');
        define('PRIMEKIT_TEMPLATE_PATH', plugin_dir_path(__FILE__));
    }
}
