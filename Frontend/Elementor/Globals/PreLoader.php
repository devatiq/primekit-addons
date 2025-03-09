<?php 

namespace PrimeKit\Frontend\Elementor\Globals;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Plugin;

class PreLoader {

    /**
     * Constructor
     */
    public function __construct() {
        // Hook into Elementor Kit Settings
        add_action('elementor/kit/register_tabs', [$this, 'register_site_settings'], 20);

        // Add Preloader HTML to the Frontend
        add_action('wp_footer', [$this, 'render_preloader']);

        // Enqueue Preloader Assets
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    /**
     * Register Preloader Site Settings in Elementor Kit
     */
    public function register_site_settings($kit) {
        // Ensure we are working with a valid kit object
        if (!is_object($kit)) {
            error_log('❌ PrimeKit Error: Elementor Kit not found.');
            return;
        }

        // Add a new Preloader Tab
        add_filter('elementor/kit/get_tabs', function($tabs) {
            $tabs['primekit-preloader'] = [
                'label' => esc_html__('Preloader', 'primekit-addons'),
                'icon'  => 'eicon-loading',
            ];
            return $tabs;
        });

        // Start Adding Controls
        try {
            $kit->start_controls_section(
                'primekit_preloader_section',
                [
                    'label' => esc_html__('Preloader Settings', 'primekit-addons'),
                    'tab'   => 'primekit-preloader',
                ]
            );

            // Enable Preloader Switch
            $kit->add_control(
                'primekit_enable_preloader',
                [
                    'label'        => esc_html__('Enable Preloader', 'primekit-addons'),
                    'type'         => Controls_Manager::SWITCHER,
                    'default'      => '',
                    'label_on'     => esc_html__('Yes', 'primekit-addons'),
                    'label_off'    => esc_html__('No', 'primekit-addons'),
                    'return_value' => 'yes',
                ]
            );

            $kit->end_controls_section();
        } catch (\Exception $e) {
            error_log('❌ PrimeKit Preloader: Error registering controls - ' . $e->getMessage());
        }
    }

    /**
     * Render Preloader HTML on the Frontend
     */
    public function render_preloader() {
        $kit = Plugin::$instance->kits_manager->get_active_kit_for_frontend();

        // ✅ Prevent errors if no kit is found
        if (!$kit || !is_object($kit)) {
            error_log('❌ PrimeKit Error: No active Elementor Kit found.');
            return;
        }

        $settings = $kit->get_settings('primekit_enable_preloader');

        if (!empty($settings) && $settings === 'yes') {
            echo '<div class="primekit-preloader">
                    <div class="primekit-preloader-spinner"></div>
                  </div>';
        }
    }

    /**
     * Enqueue Preloader Styles & Scripts
     */
    public function enqueue_assets() {
        $kit = Plugin::$instance->kits_manager->get_active_kit_for_frontend();

        // ✅ Prevent errors if no kit is found
        if (!$kit || !is_object($kit)) {
            return;
        }

        $settings = $kit->get_settings('primekit_enable_preloader');

        if (!empty($settings) && $settings === 'yes') {
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
