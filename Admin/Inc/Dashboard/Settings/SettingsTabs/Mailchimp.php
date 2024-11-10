<?php

namespace PrimeKit\Admin\Inc\Dashboard\Settings\SettingsTabs;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Mailchimp {
    private $options;

    public function __construct() {
        $this->options = get_option('primekit_mailchimp_options');
        add_action('admin_init', [$this, 'register_settings']);
    }

    // Register Mailchimp settings
    public function register_settings() {
        register_setting(
            'primekit_mailchimp_options', 
            'primekit_mailchimp_options', 
            [$this, 'sanitize']
        );

        add_settings_section(
            'mailchimp_settings_section', 
            esc_html__('Mailchimp API Settings', 'primekit-addons'), 
            [$this, 'section_info'], 
            'primekit_mailchimp_settings'
        );

        add_settings_field(
            'mailchimp_api_key', 
            esc_html__('API Key', 'primekit-addons'), 
            [$this, 'mailchimp_api_key_callback'], 
            'primekit_mailchimp_settings', 
            'mailchimp_settings_section'
        );
    }

    // Mailchimp settings section description
    public function section_info() {
        echo esc_html__('Enter your Mailchimp API settings below:', 'primekit-addons');
    }

    // Sanitize Mailchimp settings
    public function sanitize($input) {
        // Verify nonce before saving settings
        if (!isset($_POST['primekit_nonce']) || !wp_verify_nonce($_POST['primekit_nonce'], 'primekit_save_settings')) {
            add_settings_error('primekit_mailchimp_settings', 'primekit_nonce_error', __('Nonce verification failed', 'primekit-addons'), 'error');
            return $input; // return input without saving to avoid data loss
        }
    
        $new_input = array();
        if (isset($input['mailchimp_api_key'])) {
            $new_input['mailchimp_api_key'] = sanitize_text_field($input['mailchimp_api_key']);
        }
    
        // Add success message
        add_settings_error('primekit_mailchimp_settings', 'primekit_mailchimp_success', esc_html__('Settings saved successfully', 'primekit-addons'), 'updated');
    
        return $new_input;
    }    

    // Mailchimp API key field
    public function mailchimp_api_key_callback() {
        printf(
            '<input type="text" class="primekit-full-width-input" id="mailchimp_api_key" name="primekit_mailchimp_options[mailchimp_api_key]" value="%s" />',
            isset($this->options['mailchimp_api_key']) ? esc_attr($this->options['mailchimp_api_key']) : ''
        );
    
        
        echo '<p class="description">' . sprintf(
            // Translators: %1$s and %2$s are HTML link tags that link to the Mailchimp API key page.
            esc_html__('Enter your Mailchimp API Key. You can get it %1$shere%2$s.', 'primekit-addons'),
            '<a href="https://us6.admin.mailchimp.com/account/api/" target="_blank">',
            '</a>'
        ) . '</p>';
    }
    
}