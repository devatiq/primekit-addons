<?php
/**
 * Manager.php
 *
 * This file contains the Manager class, which is responsible for handling
 * the initialization of the required configurations and functionalities
 * for the PrimeKit Addons. It ensures the proper setup of the Elementor
 * Configuration and registration of the text domain.
 *
 * @package PrimeKit\Inc
 * @since 1.0.0
 */
namespace PrimeKit;

if (!defined('ABSPATH'))
  exit; // Exit if accessed directly


use PrimeKit\Public\Elementor\Configuration;

/**
 * The manager class for PrimeKit.
 *
 * This class handles the initialization of the required configurations and functionalities
 * for the PrimeKit Addons. The class is responsible for setting the Elementor Configuration
 * and registering the text domain.
 *
 * @package PrimeKit\Inc
 * @since 1.0.0
 */
class Manager{

  protected $Elementor_Config;

  /**
   * Constructor for the Manager class.
   *
   * This method initializes the PrimeKit Manager by calling the init method.
   *
   * @since 1.0.0
   */
  public function __construct()  {
    $this->init();
  }

  /**
   * Initiate the PrimeKit Manager
   *
   * This method sets the Elementor Configuration and registers the text domain.
   *
   * @since 1.0.0
   */
  public function init()  {
    $this->Elementor_Config = Configuration::instance();
    $this->register_textdomain();
  }


  /**
   * Register the text domain for translation.
   *
   * This method loads the plugin's translated strings from the specified directory.
   *
   * @since 1.0.0
   */
  protected function register_textdomain()  {
    load_plugin_textdomain('primekit-addons', false, dirname(plugin_basename(__DIR__, 2)) . '/languages');
  }

}