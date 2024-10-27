<?php
/*
Plugin Name: PrimeKit Addons and Templates
Plugin URI: https://primekitaddons.com/
Description: The Elementor Custom Widgets plugin is built to enhance your website’s look and performance.
Version: 1.0.0
Author: supreoxltd
Author URI: https://supreox.com/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: primekit-addons
Domain Path: /languages
Elementor tested up to: 3.24.7
Elementor Pro tested up to: 3.24.7
Requires Plugins: elementor
*/

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

if (!function_exists('primekit_addons_general_init')) {
    function primekit_addons_general_init()
    {
        // Define constants
        define('primekit_file', __FILE__);
        define('primekit_path', dirname(primekit_file));
        define('primekit_inc', primekit_path . '/includes');
        define('primekit_Admin', primekit_inc . '/admin');
        define('primekit_url', plugins_url('', primekit_file));
        define('primekit_assets', primekit_url . '/assets');

        //loading main file
        if (!class_exists('PrimeKitAddonsPack')) {
            require_once 'primekit-main-class.php';
            \primekit\PrimeKitAddonsPack::instance();
        }

        //load text-domain
        load_plugin_textdomain('primekit-addons', false, dirname(plugin_basename(primekit_file)) . '/languages/');
    }
}
add_action('plugins_loaded', 'primekit_addons_general_init');

//Load style and scripts
if (!function_exists('primekit_elementor_enqueue')) {
    function primekit_elementor_enqueue()
    {
        wp_enqueue_style('primekit-elementor-style', primekit_assets . "/css/style.css");
        wp_enqueue_style('primekit-elementor-responsive', primekit_assets . "/css/responsive.css");
        wp_register_style('primekit-anim-text-style', primekit_assets . "/css/anim-text-style.css");
        if (!wp_style_is('twentytwenty')) {
            wp_register_style('twentytwenty', primekit_assets . "/css/twentytwenty.css");
        }

        //script
        wp_register_script('primekit-anim-text-main', primekit_assets . "/js/anim-text-script.js", array('jquery'), '1.0', true);
        wp_register_script('primekit-back-to-top', primekit_assets . "/js/back-to-top.js", array('jquery'), '1.0', true);
        wp_register_script('jquery-event-move', primekit_assets . "/js/jquery.event.move.js", array('jquery'), '1.0', true);
        wp_register_script('jquery-twentytwenty', primekit_assets . "/js/jquery.twentytwenty.js", array('jquery'), '1.0', true);

    }
}
add_action('wp_enqueue_scripts', 'primekit_elementor_enqueue');


//add PrimeKit Elementor Category
if (!function_exists('primekit_addons_widget_categories')) {
    function primekit_addons_widget_categories($elements_manager)
    {
        $elements_manager->add_category(
            'primekit-category',
            [
                'title' => esc_html__('PrimeKit Elements', 'primekit-addons'),
                'icon' => 'eicon-kit-plugins',
            ]
        );
    }
}
add_action('elementor/elements/categories_registered', 'primekit_addons_widget_categories');


//Get Plugin Info
function primekit_addons_plugin_info()
{
    // Ensure the function is available
    if (!function_exists('get_plugin_data')) {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }

    $plugin_file_path = primekit_path . '/primekit-addons.php';
    if (file_exists($plugin_file_path)) {
        $plugin_data = get_plugin_data($plugin_file_path);
        $plugin_info = [
            'Name' => $plugin_data['Name'],
            'Version' => $plugin_data['Version'],
            'Author' => $plugin_data['Author'],
            'PluginURI' => $plugin_data['PluginURI'],
            'AuthorURI' => $plugin_data['AuthorURI'],
            'Description' => $plugin_data['Description']
        ];
    } else {
        $plugin_info = [
            'Name' => esc_html__('Plugin Name Not Found', 'primekit-addons'),
            'Version' => esc_html__('Plugin Version Not Found', 'primekit-addons'),
            'Author' => esc_html__('Author Not Found', 'primekit-addons'),
            'PluginURI' => esc_html__('Plugin URI Not Found', 'primekit-addons'),
            'AuthorURI' => esc_html__('Author URI Not Found', 'primekit-addons'),
            'Description' => esc_html__('Description Not Found', 'primekit-addons')
        ];
    }

    return $plugin_info;
}