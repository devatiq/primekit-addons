<?php
/**
 * This file contains the class responsible for adding the Templates menu to the WP admin sidebar.
 *
 * @package PrimeKit
 * @subpackage Admin/Inc/Dashboard/Templates
 */

namespace PrimeKit\Admin\Inc\Dashboard\Templates;

class TemplatesMenu {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_templates_submenu']);
    }

    public function add_templates_submenu() {
        add_submenu_page(
            'primekit_home', // Parent slug
            esc_html__('Templates', 'primekit-addons'),     // Page title
            esc_html__('Templates', 'primekit-addons'),     // Menu title
            'manage_options', // Capability
            'primekit_templates', // Menu slug
            [$this, 'render_templates_page'] // Callback function
        );
    }

    public function render_templates_page() {
        $response = wp_remote_get('https://demo.primekitaddons.com/wp-json/primekit/v1/templates');
    
        if (is_wp_error($response)) {
            echo '<div class="notice notice-error"><p>Unable to fetch templates. Please try again later.</p></div>';
            return;
        }
    
        $templates = json_decode(wp_remote_retrieve_body($response), true);
    
        if (empty($templates)) {
            echo '<div class="notice notice-warning"><p>No templates found.</p></div>';
            return;
        }
    
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Templates', 'primekit-addons'); ?></h1>
            <p><?php esc_html_e('Browse available templates below.', 'primekit-addons'); ?></p>
    
            <div id="primekit-templates-content-wrapper" style="display: flex; flex-wrap: wrap; gap: 20px;">
                <?php foreach ($templates as $template) :
                    $template_id = $template['id'];
                    $details_response = wp_remote_get("https://demo.primekitaddons.com/wp-json/primekit/v1/templates/{$template_id}");
    
                    if (is_wp_error($details_response)) {
                        continue;
                    }
    
                    $template_details = json_decode(wp_remote_retrieve_body($details_response), true);
    
                    $title = esc_html($template['title']);
                    $thumbnail = esc_url($template['thumbnail']);
                    $download_url = esc_url($template_details['download_url'] ?? '#');
                    $demo_url = esc_url($template_details['demo_url'] ?? '#');
                ?>
                    <div class="primekit-single-template-item" style="border: 1px solid #ddd; padding: 10px; width: 220px; background: #fff;">
                        <div class="primekit-template-thumbnail" style="text-align: center;">
                            <img src="<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>" style="width: 100%; height: auto;">
                        </div>
                        <div class="primekit-template-footer" style="text-align: center; margin-top: 10px;">
                            <strong><?php echo $title; ?></strong><br><br>
                            <a href="<?php echo $download_url; ?>" class="button button-primary" target="_blank">
                                <?php esc_html_e('Download', 'primekit-addons'); ?>
                            </a>
                            <a href="<?php echo $demo_url; ?>" class="button" target="_blank">
                                <?php esc_html_e('Preview', 'primekit-addons'); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
    
}