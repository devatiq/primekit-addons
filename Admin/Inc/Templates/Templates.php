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
        add_action('wp_ajax_primekit_get_templates', [$this, 'primekit_get_templates']);
        add_action('wp_ajax_primekit_get_template_content', [$this, 'primekit_get_template_content_handler']);
        add_action('wp_ajax_nopriv_primekit_get_template_content', [$this, 'primekit_get_template_content_handler']);
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



    public function primekit_get_template_content_handler()
    {
        // Validate the request
        if (!isset($_POST['template_id'])) {
            wp_send_json_error(['message' => 'Template ID is missing.']);
            wp_die();
        }

        $template_id = sanitize_text_field($_POST['template_id']);

        // Mock template content - Replace this with your actual logic to retrieve content
        $content = [
            'id' => $template_id,
            'content' => '<div class="primekit-template-section">This is a mock section for Template ID: ' . esc_html($template_id) . '</div>',
        ];

        wp_send_json_success(['content' => $content['content']]);
        wp_die();
    }


}
