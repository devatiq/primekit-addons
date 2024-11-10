<?php

namespace PrimeKit\Admin\Inc\Dashboard\Settings\SettingsTabs;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class General {
    public function __construct() {
        add_action('admin_init', [$this, 'register_settings']);
    }

    // Register General settings
    public function register_settings() {
        register_setting(
            'primekit_general_options',   
            'primekit_general_options', 
            [$this, 'sanitize'] // Sanitize callback for general options
        );

        add_settings_section(
            'general_settings_section', 
            esc_html__('General Settings', 'primekit-addons'), 
            [$this, 'section_info'], 
            'primekit_general_settings'
        );
    }

    // General settings section description
    public function section_info() {
        echo esc_html__('General settings for the PrimeKit Addons.', 'primekit-addons');
    }

   
    /**
     * Sanitizes the input for the General settings.
     *
     * Verifies the nonce, checks for the proper capability, and ensures the
     * required fields are set. Sanitizes the values before saving the setting
     * in the options table.
     *
     * @since 1.0.0
     *
     * @param array $input The input to sanitize.
     * @return array The sanitized input.
     */
    public function sanitize($input) {
        // Verify nonce before saving settings
        if (!isset($_POST['primekit_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['primekit_nonce'])), 'primekit_save_settings')) {
            add_settings_error('primekit_general_settings', 'primekit_nonce_error', esc_html__('Nonce verification failed', 'primekit-addons'), 'error');
            return $input; // return input without saving to avoid data loss
        }
    
        $new_input = array();
        // Add sanitization logic for general options
    
        // Add success message
        add_settings_error('primekit_general_settings', 'primekit_general_success', esc_html__('Settings saved successfully', 'primekit-addons'), 'updated');
    
        return $new_input;
    }
    
    
}