<?php

namespace PrimeKit;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

class PrimeKitAddonsPack
{
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

		if ($this->is_compatible()) {
			add_action('elementor/init', [$this, 'init']);
		}
		// set the constants first
		$this->setConstants();

		// Register the custom autoloading function.
		spl_autoload_register([$this, 'autoload']);

		// register the activation
		register_activation_hook(__FILE__, [$this, 'activate']);

		// registser the deactivation
		register_deactivation_hook(__FILE__, [$this, 'deactivate']);

		// Hook into WordPress after theme setup
		add_action('after_setup_theme', array($this, 'primekit_elementor_custom_thumbnail_size'));

		// Add extranal file for extra functionality
		$this->include_external_file();

	}

	// Register a custom thumbnail size
	function primekit_elementor_custom_thumbnail_size()
	{
		// Register a custom thumbnail size
		add_image_size('primekit-elementor-post', 635, 542, true);
		add_image_size('primekit_blog_list_thumb', 600, 450, true);
		add_image_size('primekit_blog_grid_thumb', 900, 600, true);
		add_image_size('primekit_square_img', 800, 800, true);
	}

	// Add extranal file for extra functionality
	public function include_external_file()
	{
		require_once primekit_path . '/includes/widgets/primekit-widgets-functions.php';
	}

	/**
	 * setConstants.
	 */

	public function setConstants()
	{
		define('primekit_version', $this->version);
		define('primekit_name', esc_html__('PrimeKit Addons and Templates for Elementor', 'primekit-addons'));

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
    esc_html(primekit_name),
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
			esc_html(primekit_name),
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
			'<strong>' . primekit_name . '</strong>',
			'<strong>' . esc_html__('PHP', 'primekit-addons') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post($message));
	}

	/**
	 * Load the addons functionality only after Elementor is initialized.
	 */
	public function init()
	{
		add_action('elementor/widgets/register', [$this, 'register_widgets']);
	}

	/**
	 * function that runs on plugin activation
	 */
	public function activate()
	{
		// flush rewrite rules
		flush_rewrite_rules();

		$isInstalled = get_option('primekit_installed');

		if (!$isInstalled) {
			update_option('primekit_installed', time());
		}

		update_option('primekit_version', primekit_version);
	}

	/**
	 * function that runs on plugin deactivation
	 */
	public function deactivate()
	{
		// Flush reqrite rules
		flush_rewrite_rules();
	}

	// autoload files for load classes dynamically
	public function autoload($class_name)
	{
		$base_namespace = 'PrimeKit\\Includes\\Widgets\\';

		if (strpos($class_name, $base_namespace) === 0) {
			$relative_class_name = substr($class_name, strlen($base_namespace));
			$file_path = primekit_path . '/includes/widgets/' . str_replace('\\', '/', $relative_class_name) . '.php';

			if (file_exists($file_path)) {
				require $file_path;
			}
		}
	}

	/**
	 * Register Widgets
	 */
	public function register_widgets($primekit_widgets_manager)
	{
		require_once primekit_path . '/includes/widgets/primekit-base-widgets.php';
		require_once primekit_path . '/includes/primekit-addons-widgets.php';

	}



}