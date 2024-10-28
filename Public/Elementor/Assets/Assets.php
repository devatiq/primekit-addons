<?php 
namespace PrimeKit\Public\Elementor\Assets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Elementor Assets
 */
class Assets
{   


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Init
     */
    public function init()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }    


    /**
     * Enqueue Scripts
     */
    public function enqueue_scripts()
    {
         //script
         wp_register_script('primekit-anim-text-main', PRIMKIT_ELEMENTOR_ASSETS . "/js/anim-text-script.js", array('jquery'), '1.0', true);
         wp_register_script('primekit-back-to-top', PRIMKIT_ELEMENTOR_ASSETS . "/js/back-to-top.js", array('jquery'), '1.0', true);
         wp_register_script('jquery-event-move', PRIMKIT_ELEMENTOR_ASSETS . "/js/jquery.event.move.js", array('jquery'), '1.0', true);
         wp_register_script('jquery-twentytwenty', PRIMKIT_ELEMENTOR_ASSETS . "/js/jquery.twentytwenty.js", array('jquery'), '1.0', true);
    }

    /**
     * Enqueue Styles
     */
    public function enqueue_styles()
    {
        wp_enqueue_style('primekit-elementor-style', PRIMKIT_ELEMENTOR_ASSETS . "/css/style.css");
        wp_enqueue_style('primekit-elementor-responsive', PRIMKIT_ELEMENTOR_ASSETS . "/css/responsive.css");
        wp_register_style('primekit-anim-text-style', PRIMKIT_ELEMENTOR_ASSETS . "/css/anim-text-style.css");
        if (!wp_style_is('twentytwenty')) {
            wp_register_style('twentytwenty', PRIMKIT_ELEMENTOR_ASSETS . "/css/twentytwenty.css");
        }

    }

}