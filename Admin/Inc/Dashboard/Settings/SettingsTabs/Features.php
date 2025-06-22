<?php

namespace PrimeKit\Admin\Inc\Dashboard\Settings\SettingsTabs;

if (!defined('ABSPATH')) exit;

class Features {
    public function __construct() {
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function register_settings() {
        register_setting(
            'primekit_features_options',
            'primekit_features_options',
            [$this, 'sanitize']
        );

        add_settings_section(
            'features_settings_section',
            esc_html__('Features Settings', 'primekit-addons'),
            [$this, 'section_info'],
            'primekit_features_settings'
        );

        // Editor Importer
        add_settings_field(
            'enable_editor_template_import',
            esc_html__('Editor Importer', 'primekit-addons'),
            [$this, 'render_editor_checkbox'],
            'primekit_features_settings',
            'features_settings_section'
        );

        // Theme Builder
        add_settings_field(
            'enable_themebuilder_template_import',
            esc_html__('Theme Builder', 'primekit-addons'),
            [$this, 'render_themebuilder_checkbox'],
            'primekit_features_settings',
            'features_settings_section'
        );
    }

    public function section_info() {
        echo esc_html__('Enable or disable optional features for better editing experience.', 'primekit-addons');
    }

    public function render_editor_checkbox() {
        $options = get_option('primekit_features_options', []);
        $enabled = isset($options['enable_editor_template_import']) ? (bool)$options['enable_editor_template_import'] : false;
        ?>
        <label>
            <input type="checkbox"
                   name="primekit_features_options[enable_editor_template_import]"
                   value="1"
                   <?php checked($enabled); ?>>
            <?php esc_html_e('Enable Onclick Template Importer inside Elementor Editor.', 'primekit-addons'); ?>
        </label>
        <?php
    }

    public function render_themebuilder_checkbox() {
        $options = get_option('primekit_features_options', []);
        $enabled = isset($options['enable_themebuilder_template_import']) ? (bool)$options['enable_themebuilder_template_import'] : false;
        ?>
        <label>
            <input type="checkbox"
                   name="primekit_features_options[enable_themebuilder_template_import]"
                   value="1"
                   <?php checked($enabled); ?>>
            <?php esc_html_e('Enable Template Importer in Theme Builder interface.', 'primekit-addons'); ?>
        </label>
        <?php
    }

    public function sanitize($input) {
        // Check nonce manually (since we are not using a standard settings page submission)
        if (!isset($_POST['primekit_nonce']) ||
            !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['primekit_nonce'])), 'primekit_save_settings')) {
            add_settings_error(
                'primekit_features_settings',
                'primekit_nonce_error',
                esc_html__('Security check failed. Settings were not saved.', 'primekit-addons'),
                'error'
            );
            return get_option('primekit_features_options', []);
        }

        $new_input = [];
        $new_input['enable_editor_template_import'] = isset($input['enable_editor_template_import']) ? 1 : 0;
        $new_input['enable_themebuilder_template_import'] = isset($input['enable_themebuilder_template_import']) ? 1 : 0;

        add_settings_error(
            'primekit_features_settings',
            'primekit_features_success',
            esc_html__('Features settings saved successfully.', 'primekit-addons'),
            'updated'
        );

        return $new_input;
    }
}