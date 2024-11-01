<?php
/**
 * Configuration class for PrimeKit Elementor Addons.
 *
 * This class handles the initialization and configuration of the PrimeKit Elementor Addons.
 * It ensures compatibility with the required Elementor version and manages the loading of 
 * required assets and functionalities.
 *
 * @package PrimeKit\Frontend\Elementor
 * @since 1.0.0
 */
namespace PrimeKit\Frontend\Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use PrimeKit\Frontend\Elementor\Inc\Functions;
use PrimeKit\Frontend\Elementor\Assets\Assets;

/**
 * Class Configuration
 *
 * This class handles the initialization and configuration of the PrimeKit Elementor Addons.
 * It ensures compatibility with the required Elementor version and manages the loading of 
 * required assets and functionalities.
 * 
 * @package PrimeKit\Frontend\Elementor
 * @since 1.0.0
 */
class Configuration{


    protected $functions;
    protected $assets;

    /**
     * plugin Version
     */

    public $version = '1.0.0';

    /**
     * Minimum Elementor Version
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.19.0';

    /**
     * Minimum PHP Version
     */
    const MINIMUM_PHP_VERSION = '8.0';

    /**
     * Instance
     */
    private static $_instance = null;

    /**
     * Ensures only one instance of the class is loaded or can be loaded.
     */
    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Perform some compatibility checks to make sure basic requirements are meet.
     */
    public function __construct()
    {

        // set the constants.
        $this->setConstants();

        if ($this->is_compatible()) {
            add_action('elementor/init', [$this, 'init']);
        } 

        //classes Initialization.
        $this->classes_init();
        
    }


    /**
     * Compatibility Checks
     */
    public function is_compatible()
    {

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return false;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return false;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return false;
        }

        return true;
    }

	/**
	 * setConstants.
	 */

     public function setConstants()
     {
         define('PRIMEKIT_ELEMENTOR_ASSETS', plugin_dir_url(__FILE__) . 'assets');
 
     }

    /**
     * Warning when the site doesn't have Elementor installed or activated.
     */
    public function admin_notice_missing_main_plugin()
    {
        // Verify the nonce if 'activate' is present in the URL
        if (isset($_GET['activate']) && check_admin_referer('activate-plugin_' . plugin_basename(__FILE__))) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            // translators: 1 Plugin name, 2 Elementor plugin name, 3 Required Elementor version
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'primekit-addons'),
            esc_html(PRIMEKIT_NAME),
            esc_html__('Elementor', 'primekit-addons'),
            esc_html(self::MINIMUM_ELEMENTOR_VERSION)
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post($message));
    }

    /**
     * Warning when the site doesn't have a minimum required Elementor version.
     */
    public function admin_notice_minimum_elementor_version()
    {
        // Verify the nonce if 'activate' is present in the URL
        if (isset($_GET['activate']) && check_admin_referer('activate-plugin_' . plugin_basename(__FILE__))) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            // translators: 1 Plugin name, 2 Elementor plugin name, 3 Required Elementor version
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'primekit-addons'),
            esc_html(PRIMEKIT_NAME),
            esc_html__('Elementor', 'primekit-addons'),
            self::MINIMUM_ELEMENTOR_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%s</p></div>', wp_kses_post($message));
    }

    /**
     * Warning when the site doesn't have a minimum required PHP version.
     */
    public function admin_notice_minimum_php_version()
    {

        // Verify the nonce if 'activate' is present in the URL
        if (isset($_GET['activate']) && check_admin_referer('activate-plugin_' . plugin_basename(__FILE__))) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'primekit-addons'),
            '<strong>' . PRIMEKIT_NAME . '</strong>',
            '<strong>' . esc_html__('PHP', 'primekit-addons') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post($message));
    }

    /**
     * Initializes the classes used by the plugin.
     *
     * This function instantiates the functions and assets classes.
     *
     * @since 1.0.0
     */
    public function classes_init(){
        
        $this->functions = new Functions();
        $this->assets = new Assets();
    }

    /**
     * Load the addons functionality only after Elementor is initialized.
     */
    public function init()
    {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }


  
    /**
     * Register all the widgets.
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     *
     * @return void
     */
    
    public function register_widgets($widgets_manager)
    {
        
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\AnimatedText\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\ArchiveTitle\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\AuthorBio\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\BackToTop\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\BeforeAfterImg\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\Blockquote\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\BlogGrid\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\BlogList\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\BlogPostFancy\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\BreadCrumb\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\BusinessHours\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\CardInfo\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\CatInfo\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\PageTitle\Main());
        $widgets_manager->register(new \PrimeKit\Frontend\Elementor\Widgets\PostTitle\Main());

    }



}