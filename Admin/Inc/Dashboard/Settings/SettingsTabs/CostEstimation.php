<?php

namespace PrimeKit\Admin\Inc\Dashboard\Settings\SettingsTabs;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class CostEstimation
{
    private $options;

    public function __construct()
    {
        $this->options = get_option('primekit_cost_estimation_options');
        // Set default values if not already set
        if (!$this->options) {
            $this->options = array(
                'cost_estimation_package_1' => 'Low',
                'cost_estimation_package_2' => 'Medium',
                'cost_estimation_package_3' => 'High',
            );
            update_option('primekit_cost_estimation_options', $this->options);
        }

        add_action('admin_init', [$this, 'register_settings']);
    }

    // Register Cost Estimation settings
    public function register_settings()
    {
        register_setting(
            'primekit_cost_estimation_options',
            'primekit_cost_estimation_options',
            [$this, 'sanitize']
        );

        add_settings_section(
            'cost_estimation_settings_section',
            esc_html__('Cost Estimation Settings', 'primekit-addons'),
            [$this, 'section_info'],
            'primekit_cost_estimation_settings'
        );

        // Add three fields for the packages
        add_settings_field(
            'cost_estimation_package_1',
            esc_html__('Package Name 1', 'primekit-addons'),
            [$this, 'cost_estimation_package_1_callback'],
            'primekit_cost_estimation_settings',
            'cost_estimation_settings_section'
        );

        add_settings_field(
            'cost_estimation_package_2',
            esc_html__('Package Name 2', 'primekit-addons'),
            [$this, 'cost_estimation_package_2_callback'],
            'primekit_cost_estimation_settings',
            'cost_estimation_settings_section'
        );

        add_settings_field(
            'cost_estimation_package_3',
            esc_html__('Package Name 3', 'primekit-addons'),
            [$this, 'cost_estimation_package_3_callback'],
            'primekit_cost_estimation_settings',
            'cost_estimation_settings_section'
        );
    }

    // Cost Estimation settings section description
    public function section_info()
    {
        echo esc_html__('Enter the names for the cost estimation packages below:', 'primekit-addons');
    }

    // Sanitize Cost Estimation settings, including nonce validation
    public function sanitize($input)
    {
        // Check for the nonce before processing the form
        if (!isset($_POST['primekit_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['primekit_nonce'])), 'primekit_save_settings')) {
            add_settings_error('primekit_cost_estimation_settings', 'primekit_nonce_error', esc_html__('Nonce verification failed', 'primekit-addons'), 'error');
            return $input; // Do not save the input if the nonce is invalid
        }

        // Sanitize each package name
        $new_input = array();
        if (isset($input['cost_estimation_package_1'])) {
            $new_input['cost_estimation_package_1'] = sanitize_text_field($input['cost_estimation_package_1']);
        }
        if (isset($input['cost_estimation_package_2'])) {
            $new_input['cost_estimation_package_2'] = sanitize_text_field($input['cost_estimation_package_2']);
        }
        if (isset($input['cost_estimation_package_3'])) {
            $new_input['cost_estimation_package_3'] = sanitize_text_field($input['cost_estimation_package_3']);
        }

        // Add a success message
        add_settings_error('primekit_cost_estimation_settings', 'primekit_cost_estimation_success', esc_html__('Settings saved successfully', 'primekit-addons'), 'updated');

        return $new_input;
    }

    // Callback for Package Name 1
    public function cost_estimation_package_1_callback()
    {
        printf(
            '<input type="text" class="primekit-full-width-input" id="cost_estimation_package_1" name="primekit_cost_estimation_options[cost_estimation_package_1]" value="%s" placeholder="%s"/>',
            isset($this->options['cost_estimation_package_1']) ? esc_attr($this->options['cost_estimation_package_1']) : '',
            esc_html__('Package Name 1', 'primekit-addons')
        );
    }

    // Callback for Package Name 2
    public function cost_estimation_package_2_callback()
    {
        printf(
            '<input type="text" class="primekit-full-width-input" id="cost_estimation_package_2" name="primekit_cost_estimation_options[cost_estimation_package_2]" value="%s" placeholder="%s"/>',
            isset($this->options['cost_estimation_package_2']) ? esc_attr($this->options['cost_estimation_package_2']) : '',
            esc_html__('Package Name 2', 'primekit-addons')
        );
    }

    // Callback for Package Name 3
    public function cost_estimation_package_3_callback()
    {
        printf(
            '<input type="text" class="primekit-full-width-input" id="cost_estimation_package_3" name="primekit_cost_estimation_options[cost_estimation_package_3]" value="%s" placeholder="%s"/>',
            isset($this->options['cost_estimation_package_3']) ? esc_attr($this->options['cost_estimation_package_3']) : '',
            esc_html__('Package Name 3', 'primekit-addons')
        );
    }
}