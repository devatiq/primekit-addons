<?php
/**
 * Library Manager
 *
 * This file contains the class that is responsible for managing the PrimeKit library
 * (Template Library). It handles the initialization of the library, printing the
 * template views, and registering the required AJAX actions.
 *
 * @package PrimeKit\Admin/Inc/Templates
 * @since 1.0.0
 */

namespace PrimeKit\Admin\Inc\Templates;

use Elementor\Core\Common\Modules\Ajax\Module as Ajax;

defined('ABSPATH') || exit;

/**
 * Class Library_Manager
 *
 * This class is responsible for managing the PrimeKit library (Template Library).
 * It handles the initialization of the library, printing the template views, and registering
 * the required AJAX actions.
 *
 * @package PrimeKit\Admin/Inc/Templates
 * @since 1.0.0
 *
 * @method static init() Initialize the library.
 * @method static print_template_views() Print the template views.
 * @method static register_ajax_actions() Register the required AJAX actions.
 */
class Library_Manager
{
    protected static $source = null;

    public static function init()
    {
        add_action('elementor/editor/footer', [__CLASS__, 'print_template_views']);
        add_action('elementor/ajax/register_actions', [__CLASS__, 'register_ajax_actions']);
    
        // Register AJAX action properly
        add_action('wp_ajax_get_primekit_library_data', [__CLASS__, 'get_primekit_library_data']);
        add_action('wp_ajax_nopriv_get_primekit_library_data', [__CLASS__, 'get_primekit_library_data']); // Allow non-logged-in users
    }
    

    public static function print_template_views()
    {
        include_once PRIMEKIT_TEMPLATE_PATH . 'TemplatesModal.php';
    }

    public static function enqueue_assets()
    {
        wp_enqueue_style(
            'primekit-template-library',
            PRIMEKIT_URL . 'assets/css/template-library.css',
            ['elementor-editor'],
            PRIMEKIT_VERSION
        );

        wp_enqueue_script(
            'primekit-template-library',
            PRIMEKIT_URL . 'assets/js/template-library.js',
            ['elementor-editor', 'jquery-hover-intent'],
            PRIMEKIT_VERSION,
            true
        );
    }

    public static function get_source()
    {
        if (is_null(self::$source)) {
            self::$source = new Library_Source();
        }

        return self::$source;
    }
    
    public static function get_primekit_library_data()
    {
        if (!current_user_can('edit_posts')) {
            wp_send_json_error(['message' => 'Access Denied']);
            wp_die();
        }
    
        // Fetch library data
        $library_data = self::get_library_data([]);
    
        // 🔍 Debug: Check if templates are received
        error_log(print_r($library_data, true)); // Log the response
    
        // Send JSON response
        wp_send_json_success($library_data);
        wp_die();
    }
    
    
    public static function register_ajax_actions(Ajax $ajax)
    {
        $ajax->register_ajax_action('get_primekit_library_data', function ($data) {
            if (!current_user_can('edit_posts')) {
                throw new \Exception('Access Denied');
            }
    
            return self::get_library_data($data);
        });
    }
    

    public static function get_library_data(array $args)
    {
        $source = self::get_source();
    
        $templates = $source->get_items();
        $tags = $source->get_tags();
        $type_tags = $source->get_type_tags();
    
        // Debugging: Log the retrieved data
        error_log("Retrieved Templates: " . print_r($templates, true));
        error_log("Retrieved Tags: " . print_r($tags, true));
        error_log("Retrieved Type Tags: " . print_r($type_tags, true));
    
        return [
            'templates' => (!empty($templates) ? $templates : []),
            'tags'      => (!empty($tags) ? $tags : []),
            'type_tags' => (!empty($type_tags) ? $type_tags : []),
        ];
    }
    

    public static function get_template_data(array $args)
    {
        $source = self::get_source();
        return $source->get_data($args);
    }
}

Library_Manager::init();