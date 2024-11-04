<?php 
/**
 * Assets.php
 *
 * This file contains the Assets class, which handles the initialization and configuration of the PrimeKit Elementor Assets.
 * It ensures the proper loading of required assets such as CSS and JavaScript files for the PrimeKit Elementor plugin.
 *
 * @package PrimeKit\Frontend\Elementor\Assets
 * @since 1.0.0
 */
namespace PrimeKit\Frontend\Elementor\Assets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Handles the initialization and configuration of the PrimeKit Elementor Assets.
 * This class ensures the proper loading of required assets such as CSS and JavaScript files.
 *
 * @package PrimeKit\Frontend\Elementor\Assets
 * @since 1.0.0
 */
class Assets{   

   
    /**
     * Constructor for the Assets class.
     *
     * Initializes the assets for the PrimeKit Elementor plugin by
     * calling the init() method.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->init();
    }
   
    /**
     * Initializes the assets for the PrimeKit Elementor plugin.
     *
     * This method hooks into the WordPress 'wp_enqueue_scripts' action
     * to enqueue necessary scripts and styles for the plugin.
     *
     * @return void
     */
    public function init()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);

        add_action('elementor/editor/before_enqueue_scripts', [$this, 'primekit_elementor_editor_assets']);
    }    


    
    /**
     * Registers JavaScript files for the PrimeKit Elementor plugin.
     *
     * This function registers various JavaScript files required
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {
         //script
         wp_register_script('primekit-anim-text-main', PRIMEKIT_ELEMENTOR_ASSETS . "/js/anim-text-script.js", array('jquery'), PRIMEKIT_VERSION, true);
         wp_register_script('primekit-back-to-top', PRIMEKIT_ELEMENTOR_ASSETS . "/js/back-to-top.js", array('jquery'), PRIMEKIT_VERSION, true);
         wp_register_script('jquery-event-move', PRIMEKIT_ELEMENTOR_ASSETS . "/js/jquery.event.move.js", array('jquery'), PRIMEKIT_VERSION, true);
         wp_register_script('jquery-twentytwenty', PRIMEKIT_ELEMENTOR_ASSETS . "/js/jquery.twentytwenty.js", array('jquery'), PRIMEKIT_VERSION, true);
         wp_register_script('primekit-jquery-appear', PRIMEKIT_ELEMENTOR_ASSETS . "/js/jquery.appear.js", array('jquery'), PRIMEKIT_VERSION, true);
         wp_register_script('primekit-circular-progress', PRIMEKIT_ELEMENTOR_ASSETS . "/js/circular-progress.js", array('jquery'), PRIMEKIT_VERSION, true);
         wp_register_script('primekit-circular-skills', PRIMEKIT_ELEMENTOR_ASSETS . "/js/primekit-circular-skills.js", array('jquery'), PRIMEKIT_VERSION, true);
         wp_register_script('primekit-wp-menu-js', PRIMEKIT_ELEMENTOR_ASSETS . "/js/primekit-wp-menu.js", array('jquery'), PRIMEKIT_VERSION, true);
         wp_register_script('primekit-swiper', PRIMEKIT_ELEMENTOR_ASSETS . "/js/swiper-bundle.min.js", array('jquery'), PRIMEKIT_VERSION, true);
         wp_register_script('primekit-testimonial', PRIMEKIT_ELEMENTOR_ASSETS . "/js/primekit-testimonial.js", array('jquery'), PRIMEKIT_VERSION, true);
        wp_register_script('primekit-template-slider', PRIMEKIT_ELEMENTOR_ASSETS . "/js/template-slider.js", array('jquery'), PRIMEKIT_VERSION, true);
        wp_register_script('primekit-posts-sliders', PRIMEKIT_ELEMENTOR_ASSETS . "/js/posts-sliders.js", array('jquery'), PRIMEKIT_VERSION, true);
        wp_register_script('primekit-mailchimp-newsletter', PRIMEKIT_ELEMENTOR_ASSETS . "/js/mailchimp-newsletter.js", array('jquery'), PRIMEKIT_VERSION, true);
        wp_register_script('primekit-before-after-script', PRIMEKIT_ELEMENTOR_ASSETS . "/js/before-after.js", array('jquery'), PRIMEKIT_VERSION, true);
        wp_register_script('primekit-cost-estimation', PRIMEKIT_ELEMENTOR_ASSETS . "/js/cost-estimation.js", array('jquery'), PRIMEKIT_VERSION, true);
        wp_register_script('primekit-count-down', PRIMEKIT_ELEMENTOR_ASSETS . "/js/count-down.js", array('jquery'), PRIMEKIT_VERSION, true);

        wp_localize_script('primekit-mailchimp-newsletter', 'PrimekitMailchimpAjax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('primekit_mailchimp_nonce'),
        ]);

    }

   
    /**
     * Enqueues and registers CSS styles for the PrimeKit Elementor plugin.
     *
     * This function enqueues the main stylesheet and the responsive stylesheet
     * for the PrimeKit Elementor plugin. Additionally, it registers the 
     * animation text style and the twentytwenty styles if not already registered.
     *
     * @since 1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style('primekit-elementor-style', PRIMEKIT_ELEMENTOR_ASSETS . "/css/style.css", array(), PRIMEKIT_VERSION);
        wp_enqueue_style('primekit-elementor-responsive', PRIMEKIT_ELEMENTOR_ASSETS . "/css/responsive.css", array(), PRIMEKIT_VERSION);
        wp_register_style('primekit-anim-text-style', PRIMEKIT_ELEMENTOR_ASSETS . "/css/anim-text-style.css", array(), PRIMEKIT_VERSION);
        if (!wp_style_is('twentytwenty')) {
            wp_register_style('twentytwenty', PRIMEKIT_ELEMENTOR_ASSETS . "/css/twentytwenty.css", array(), PRIMEKIT_VERSION);
        }
        wp_register_style('primekit-swiper', PRIMEKIT_ELEMENTOR_ASSETS . "/css/swiper-bundle.min.css", array(), PRIMEKIT_VERSION);
        wp_register_style('primekit-shape-animation', PRIMEKIT_ELEMENTOR_ASSETS . "/css/shape-animation.css", array(), PRIMEKIT_VERSION);
        wp_register_style('primekit-form-7-style', PRIMEKIT_ELEMENTOR_ASSETS . "/css/contact-form-7-style.css", array(), PRIMEKIT_VERSION);
        

    }

    /**
     * Enqueues the Elementor editor stylesheet for the PrimeKit Elementor plugin.
     *
     * @since 1.0.0
     */
    public function primekit_elementor_editor_assets() {
        wp_enqueue_style( 'primekit-elementor-editor', PRIMEKIT_ELEMENTOR_ASSETS . "/css/elementor-editor.css", array(), PRIMEKIT_VERSION, 'all' );              
       
              
    }

}