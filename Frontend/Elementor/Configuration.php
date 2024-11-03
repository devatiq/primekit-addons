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
         define('PRIMEKIT_ELEMENTOR_ASSETS', plugin_dir_url(__FILE__) . 'Assets');         
         define('PRIMEKIT_ELEMENTOR_PATH', plugin_dir_path(__FILE__));
 
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
        
        $namespace_base = '\PrimeKit\Frontend\Elementor\Widgets\\';

        $widgets = [
            'primekit_shape_anim_widget_field' => 'AnimatedShape\Main',
            'primekit_anim_text_widget_field' => 'AnimatedText\Main',
            'primekit_archive_title_field' => 'ArchiveTitle\Main',
            'primekit_author_bio_widget_field' => 'AuthorBio\Main',
            'primekit_back_top_widget_field' => 'BackToTop\Main',
            'primekit_before_after_widget_field' => 'BeforeAfterImg\Main',
            'primekit_blockquote_widget_field' => 'Blockquote\Main',
            'primekit_blog_grid_widget_field' => 'BlogGrid\Main',
            'primekit_blog_list_widget_field' => 'BlogList\Main',
            'primekit_blog_fancy_widget_field' => 'BlogPostFancy\Main',
            'primekit_breadcrumb_widget_field' => 'BreadCrumb\Main',
            'primekit_business_hours_field' => 'BusinessHours\Main',
            'primekit_card_info_widget_field' => 'CardInfo\Main',
            'primekit_cat_list_widget_field' => 'CatInfo\Main',
            'primekit_circular_skill_widget_field' => 'CircularSkills\Main',
            'primekit_icon_box_widget_field' => 'IconBox\Main',
            'primekit_page_title_widget_field' => 'PageTitle\Main',
            'primekit_post_title_widget_field' => 'PostTitle\Main',
            'primekit_site_logo_widget_field' => 'SiteLogo\Main',
            'primekit_site_title_tagline_field' => 'SiteTitle\Main',
            'primekit_testi_caro_widget_field' => 'Testimonials\Main',
            'primekit_wp_menu_widget_field' => 'WpMenu\Main',
            'primekit_posts_slider_field' => 'PostsSlider\Main',
            'primekit_template_slider_field' => 'TemplateSlider\Main',
            'primekit_modern_post_grid_field' => 'ModernPostGrid\Main',
            'primekit_blog_fancy_widget_field' => 'BlogFancy\Main',
        ];
        
        foreach ($widgets as $option_name => $widget_class) {
            $is_enabled = get_option($option_name, 1); // Get the option value (default to enabled)
            
            if ($is_enabled) {
                $full_class_name = $namespace_base . $widget_class; // Combine base namespace with class path
                $widgets_manager->register(new $full_class_name());
            }
        }
        
        

    }



}