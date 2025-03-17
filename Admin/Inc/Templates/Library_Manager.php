<?php
/**
 * Library Manager for PrimeKit Addons
 *
 * @package PrimeKit
 */

namespace PrimeKit\Admin\Inc\Templates;

use Elementor\Core\Common\Modules\Ajax\Module as Ajax;

defined('ABSPATH') || exit;

class Library_Manager
{
    protected static $source = null;

    public static function init()
    {
        add_action('elementor/editor/footer', [__CLASS__, 'print_template_views']);
        add_action('elementor/ajax/register_actions', [__CLASS__, 'register_ajax_actions']);

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

    public static function register_ajax_actions(Ajax $ajax)
    {
        $ajax->register_ajax_action('get_primekit_library_data', function ($data) {
            if (!current_user_can('edit_posts')) {
                throw new \Exception('Access Denied');
            }

            return self::get_library_data($data);
        });

        $ajax->register_ajax_action('get_primekit_template_data', function ($data) {
            if (!current_user_can('edit_posts')) {
                throw new \Exception('Access Denied');
            }

            return self::get_template_data($data);
        });
    }

    public static function get_library_data(array $args)
    {
        $source = self::get_source();
        return [
            'templates' => $source->get_items(),
            'tags'      => $source->get_tags(),
            'type_tags' => $source->get_type_tags(),
        ];
    }

    public static function get_template_data(array $args)
    {
        $source = self::get_source();
        return $source->get_data($args);
    }

 
   
    
}

Library_Manager::init();