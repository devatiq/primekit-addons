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
use PrimeKit\Admin\Inc\Templates\Markup\Modal;
use PrimeKit\Admin\Inc\Templates\Library_Source;
use PrimeKit\Admin\Inc\Templates\Library_Manager;

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
    protected $modal;
    protected $Library_Source;
    protected $Library_Manager;

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
        add_action('wp_ajax_primekit_get_template_content', [$this, 'primekit_get_template_content_handler']);
        add_action('wp_ajax_nopriv_primekit_get_template_content', [$this, 'primekit_get_template_content_handler']);
    }

    public function primekit_get_template_content_handler() {
        // Verify nonce
        if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'primekit_ajax_nonce')) {
            wp_send_json_error(['message' => 'Invalid security token.']);
            wp_die();
        }

        // Validate Request
        if (!isset($_POST['template_id'])) {
            wp_send_json_error(['message' => 'Template ID is missing.']);
            wp_die();
        }
    
        $template_id = sanitize_text_field($_POST['template_id']);
        $file_path = PRIMEKIT_TEMPLATE_PATH . "templates/{$template_id}.json";
    
        if (!file_exists($file_path)) {
            wp_send_json_error(['message' => "Template file not found: {$template_id}"]);
            wp_die();
        }
    
        $content = file_get_contents($file_path);
        $template_data = json_decode($content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            wp_send_json_error(['message' => 'Invalid template JSON format.']);
            wp_die();
        }

        wp_send_json_success(['content' => $template_data]);
        wp_die();
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
        $this->markup = new Modal();
        $this->Library_Source = new Library_Source();
        $this->Library_Manager = new Library_Manager();
        
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


    public function primekit_get_templates()
    {
        if (!current_user_can('edit_posts')) {
            wp_send_json_error('Unauthorized');
        }

        $templates = [
            [
                'id' => 1,
                'title' => 'Template 1',
                'thumbnail' => PRIMEKIT_TEMPLATE_ASSETS . '/img/template1.jpg',
            ],
            [
                'id' => 2,
                'title' => 'Template 2',
                'thumbnail' => PRIMEKIT_TEMPLATE_ASSETS . '/img/template2.jpg',
            ],
        ];

        wp_send_json_success($templates);
    }



    public function primekit_get_template_content_handler() {
        // Validate Request
        if (!isset($_POST['template_id'])) {
            wp_send_json_error(['message' => 'Template ID is missing.']);
            wp_die();
        }
    
        $template_id = sanitize_text_field($_POST['template_id']);
        $file_path = PRIMEKIT_TEMPLATE_PATH . "temp.json";
    
        if (!file_exists($file_path)) {
            wp_send_json_error(['message' => 'Template not found.']);
            wp_die();
        }
    
        $content = file_get_contents($file_path);
        if (json_last_error() !== JSON_ERROR_NONE) {
            wp_send_json_error(['message' => 'Invalid JSON format.']);
            wp_die();
        }
    
        wp_send_json_success(['content' => $content]);
        wp_die();
    }
    
    
    


}

