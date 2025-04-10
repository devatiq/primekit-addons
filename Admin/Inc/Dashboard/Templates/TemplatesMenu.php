<?php
/**
 * This file contains the class responsible for adding the Templates menu to the WP admin sidebar.
 *
 * @package PrimeKit
 * @subpackage Admin/Inc/Dashboard/Templates
 */

namespace PrimeKit\Admin\Inc\Dashboard\Templates;

class TemplatesMenu
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_templates_submenu']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_ajax_primekit_fetch_templates', [$this, 'fetch_templates']);
    }
    public function enqueue_scripts($hook)
    {
        if ($hook !== 'primekit_page_primekit_templates') {
            return;
        }

        wp_enqueue_script('primekit-templates-admin', PRIMEKIT_ADMIN_ASSETS . '/js/templates-admin.js', ['jquery'], null, true);

        wp_localize_script('primekit-templates-admin', 'PrimeKitTemplates', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('primekit_fetch_templates'),
        ]);
    }


    public function add_templates_submenu()
    {
        add_submenu_page(
            'primekit_home', // Parent slug
            esc_html__('Templates', 'primekit-addons'),     // Page title
            esc_html__('Templates', 'primekit-addons'),     // Menu title
            'manage_options', // Capability
            'primekit_templates', // Menu slug
            [$this, 'render_templates_page'] // Callback function
        );
    }

    public function render_templates_page()
    {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Templates', 'primekit-addons'); ?></h1>
            <p><?php esc_html_e('Browse available templates below.', 'primekit-addons'); ?></p>

            <div id="primekit-templates-content-wrapper" style="display:flex;flex-wrap:wrap;gap:20px;">
                <div class="loading" style="margin-top: 20px;"><?php esc_html_e('Loading templates...', 'primekit-addons'); ?>
                </div>
            </div>
            <div id="primekit-templates-pagination-wrapper" style="margin-top: 20px;"></div>

        </div>
        <?php
    }

    public function fetch_templates()
    {
        check_ajax_referer('primekit_fetch_templates', 'nonce');

        $page = isset($_POST['page']) ? absint($_POST['page']) : 1;
        $per_page = 10;

        $response = wp_remote_get('https://demo.primekitaddons.com/wp-json/primekit/v1/templates');

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Failed to fetch templates']);
        }

        $templates = json_decode(wp_remote_retrieve_body($response), true);

        $total_templates = count($templates);
        $total_pages = ceil($total_templates / $per_page);
        $offset = ($page - 1) * $per_page;

        $paged_templates = array_slice($templates, $offset, $per_page);

        $output = '';

        foreach ($paged_templates as $template) {
            $details_response = wp_remote_get("https://demo.primekitaddons.com/wp-json/primekit/v1/templates/{$template['id']}");
            if (is_wp_error($details_response))
                continue;

            $details = json_decode(wp_remote_retrieve_body($details_response), true);

            $output .= '<div class="primekit-single-template-item" style="border:1px solid #ddd;padding:10px;width:220px;background:#fff;">';
            $output .= '<div class="primekit-template-thumbnail" style="text-align:center;">';
            $output .= '<img src="' . esc_url($template['thumbnail']) . '" alt="' . esc_attr($template['title']) . '" style="width:100%;height:auto;">';
            $output .= '</div>';
            $output .= '<div class="primekit-template-footer" style="text-align:center;margin-top:10px;">';
            $output .= '<strong>' . esc_html($template['title']) . '</strong><br><br>';
            $output .= '<a href="' . esc_url($details['download_url'] ?? '#') . '" class="button button-primary" target="_blank">Download</a> ';
            $output .= '<a href="' . esc_url($details['demo_url'] ?? '#') . '" class="button" target="_blank">Preview</a>';
            $output .= '</div>';
            $output .= '</div>';
        }

        // Pagination UI
        $pagination_html = '<div class="primekit-pagination" style="margin-top: 20px; display: flex; gap: 10px;">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $is_active = ($i === $page) ? 'button-primary current-page' : '';
            $pagination_html .= '<button class="button primekit-page-btn ' . esc_attr($is_active) . '" data-page="' . esc_attr($i) . '">' . esc_html($i) . '</button>';
        }
        $pagination_html .= '</div>';


        wp_send_json_success([
            'html' => $output,
            'pagination' => $pagination_html,
            'current_page' => $page
        ]);
    }



}