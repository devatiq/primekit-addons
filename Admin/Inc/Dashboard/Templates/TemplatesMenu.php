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
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Templates', 'primekit-addons'); ?></h1>
            <p><?php esc_html_e('Welcome to the Templates page.', 'primekit-addons'); ?></p>

            <!-- Template Content -->
            <div id="primekit-templates-content-wrapper">
                <!-- Template Item -->
                <div class="primekit-single-template-item">
                    <div class="primekit-template-thumbnail">
                        <img src="<?php echo esc_url(PRIMEKIT_ASSETS_URL . '/img/placeholder.png'); ?>" alt="Template Thumbnail">
                    </div>
                    <div class="primekit-template-footer">
                       <a href="<?php echo esc_url(PRIMEKIT_ASSETS_URL . '/img/placeholder.png'); ?>" class="button button-primary">
                            <?php esc_html_e('Download', 'primekit-addons'); ?>
                       </a>
                       <a href="<?php echo esc_url(PRIMEKIT_ASSETS_URL . '/img/placeholder.png'); ?>" class="button button-primary">
                            <?php esc_html_e('Preview', 'primekit-addons'); ?>
                       </a>
                    </div>
                </div><!-- /Template Item -->
            </div><!-- /Template Content -->
        </div>
        <?php
    }
}