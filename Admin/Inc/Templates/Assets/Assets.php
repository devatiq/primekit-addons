<?php
/**
 * Assets.php
 *
 * This file contains the Assets class, which handles the initialization and configuration of the PrimeKit Admin Assets.
 * It ensures the proper loading of required assets such as CSS and JavaScript files for the PrimeKit Admin plugin.
 *
 * @package PrimeKit\Admin\Inc\Templates\Assets
 * @since 1.0.5
 */
namespace PrimeKit\Admin\Inc\Templates\Assets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


/**
 * Handles the initialization and configuration of the PrimeKit Admin Assets.
 * This class ensures the proper loading of required assets such as CSS and JavaScript files.
 *
 * @package PrimeKit\Admin\Inc\Templates\Assets
 * @since 1.0.5
 */
class Assets
{


    /**
     * Constructor for the Assets class.
     *
     * Sets up the necessary actions to enqueue scripts and styles 
     * for the Elementor editor within the PrimeKit Admin.
     *
     * @since 1.0.5
     */

    public function __construct()
    {
        add_action('elementor/editor/after_enqueue_scripts', array($this, 'template_editor_scripts'));
        add_action('elementor/editor/after_enqueue_scripts', array($this, 'template_editor_styles'));


        add_action('wp_ajax_primekit_fetch_template', [$this, 'primekit_fetch_template_data']);
        add_action('wp_ajax_nopriv_primekit_fetch_template', [$this, 'primekit_fetch_template_data']);
    }


    /**
     * Enqueues JavaScript script for the Elementor editor.
     *
     * This function enqueues the JavaScript file necessary for adding custom 
     * button functionality in the Elementor editor for the PrimeKit Admin.
     *
     * @since 1.0.5
     */

    public function template_editor_scripts()
    {

        // Enqueue external micromodal JS
        wp_enqueue_script('micromodal-js', PRIMEKIT_TB_ASSETS . 'js/micromodal.min.js', ['jquery'], PRIMEKIT_VERSION, true );

      //  wp_enqueue_script('primekit-elementor-template', PRIMEKIT_TEMPLATE_ASSETS . '/js/elementor-template-btn.js', ['jquery', 'elementor-editor'], PRIMEKIT_VERSION, true);
        wp_enqueue_script('primekit-namespace', PRIMEKIT_TEMPLATE_ASSETS . '/js/namespace.js', ['jquery'], PRIMEKIT_VERSION, true);
        wp_enqueue_script('primekit-templates', PRIMEKIT_TEMPLATE_ASSETS . '/js/templates.js', ['jquery', 'elementor-editor'], PRIMEKIT_VERSION, true);
        
        wp_localize_script('primekit-templates', 'primekitAjax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('primekit_nonce')
        ]);

    }

    /**
     * Enqueues CSS stylesheet for the Elementor editor.
     *
     * This function enqueues the CSS file necessary for adding custom 
     * button styles in the Elementor editor for the PrimeKit Admin.
     *
     * @since 1.0.5
     */
    public function template_editor_styles()
    {
        // Enqueue CSS for modal
        wp_enqueue_style( 'primekit-theme-builder-modal', PRIMEKIT_TB_ASSETS . 'css/modal.css', [], PRIMEKIT_VERSION);

        
        wp_enqueue_style('primekit-elementor-template', PRIMEKIT_TEMPLATE_ASSETS . '/css/elementor-template-btn.css', [], PRIMEKIT_VERSION);
    }

    public function primekit_fetch_template_data() {
        header("Content-Type: application/json"); // Ensure JSON response
    
        // ✅ Support both GET and POST requests
        $template_id = isset($_REQUEST['template_id']) ? sanitize_text_field($_REQUEST['template_id']) : '';
    
        if (empty($template_id)) {
            wp_send_json_error("❌ Missing template ID.");
            return;
        }
    
        $api_url = "https://demo.primekitaddons.com/PrimeKitTemplates/Templates/v1/{$template_id}.json";
    
        $response = wp_remote_get($api_url);
    
        if (is_wp_error($response)) {
            wp_send_json_error("❌ Error fetching template.");
            return;
        }
    
        $body = wp_remote_retrieve_body($response);
        $decoded_body = json_decode($body, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            wp_send_json_error("❌ Invalid JSON response from API.");
            return;
        }
    
        wp_send_json_success($decoded_body);
    }
}
