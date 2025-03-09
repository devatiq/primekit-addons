<?php
/**
 * PreLoader class for PrimeKit Elementor Addons.
 *
 * This class handles the preloader functionality and site settings integration.
 *
 * @package PrimeKit\Frontend\Elementor\Globals
 * @since 1.0.5
 */
namespace PrimeKit\Frontend\Elementor\Globals;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Core\Settings\Manager as SettingsManager;
use Elementor\Plugin;

/**
 * Class PreLoader
 *
 * Handles the preloader functionality and site settings integration.
 *
 * @package PrimeKit\Frontend\Elementor\Globals
 * @since 1.0.5
 */
class PreLoader {

    /**
     * Constructor
     */
    public function __construct() {
        // Register site settings
        add_action('elementor/init', [$this, 'register_site_settings']);
        
        // Add preloader to frontend
        add_action('wp_footer', [$this, 'render_preloader']);
        
        // Enqueue necessary scripts and styles
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    /**
     * Register site settings for preloader
     */
    public function register_site_settings() {
        add_action('elementor/kit/register_tabs', function() {
            Plugin::$instance->controls_manager->add_tab('primekit-preloader', esc_html__('Preloader', 'primekit-addons'));
        });

        add_action('elementor/element/kit/primekit-preloader/before_section_end', function($element) {
            $element->add_control(
                'primekit_enable_preloader',
                [
                    'label' => esc_html__('Enable Preloader', 'primekit-addons'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => esc_html__('Yes', 'primekit-addons'),
                    'label_off' => esc_html__('No', 'primekit-addons'),
                    'return_value' => 'yes',
                ]
            );
        });
    }

    /**
     * Render preloader HTML
     */
    public function render_preloader() {
        $kit = Plugin::$instance->kits_manager->get_active_kit_for_frontend();
        $settings = $kit->get_settings_for_display('primekit_enable_preloader');
        
        if ($settings === 'yes') {
            echo '<div class="primekit-preloader">
                    <div class="primekit-preloader-spinner"></div>
                  </div>';
        }
    }

    /**
     * Enqueue preloader assets
     */
    public function enqueue_assets() {
        $kit = Plugin::$instance->kits_manager->get_active_kit_for_frontend();
        $settings = $kit->get_settings_for_display('primekit_enable_preloader');
        
        if ($settings === 'yes') {
            wp_enqueue_style(
                'primekit-preloader',
                PRIMEKIT_ELEMENTOR_ASSETS . '/css/preloader.css',
                [],
                PRIMEKIT_VERSION
            );

            wp_enqueue_script(
                'primekit-preloader',
                PRIMEKIT_ELEMENTOR_ASSETS . '/js/preloader.js',
                ['jquery'],
                PRIMEKIT_VERSION,
                true
            );
        }
    }
}