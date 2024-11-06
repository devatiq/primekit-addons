<?php
/**
 * Elementor functions
 *
 * @package PrimeKit
 * @subpackage Public/Elementor/Inc
 */
namespace PrimeKit\Frontend\Elementor\Inc;

/**
 * don't call the file directly.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * This class is responsible for some helper functions and actions for the Elementor Addons.
 *
 * @package PrimeKit\Frontend\Elementor\Inc
 * @since 1.0.0
 */
class Functions {


    /**
     * Constructor for the Functions class.
     *
     * Initializes the PrimeKit Elementor category and hooks into the WordPress
     * 'after_setup_theme' action to register custom thumbnail sizes.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        //add PrimeKit Elementor Category
        add_action('elementor/elements/categories_registered', [$this, 'primekit_addons_widget_categories']);
        // Hook into WordPress after theme setup
        add_action('after_setup_theme', array($this, 'primekit_elementor_custom_thumbnail_size'));

        // Hook for AJAX submission for primekit mailchimp subscription widget
        add_action('wp_ajax_nopriv_primekit_mailchimp_subscribe', [$this, 'primekit_mailchimp_subscribe']);
        add_action('wp_ajax_primekit_mailchimp_subscribe', [$this, 'primekit_mailchimp_subscribe']);
    }


    /**
     * Registers PrimeKit Elementor category.
     *
     * @param \Elementor\Elements_Manager $elements_manager Elements manager instance.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function primekit_addons_widget_categories($elements_manager)
    {
        $elements_manager->add_category(
            'primekit-category',
            [
                'title' => esc_html__('PrimeKit Elements', 'primekit-addons'),
                'icon' => 'eicon-kit-plugins',
            ]
        );

        if($this->is_woocommerce_active()){ 
            $elements_manager->add_category(
                'primekit-wc-category',
                [
                    'title' => esc_html__('PrimeKit WooCommerce', 'primekit-addons'),
                    'icon' => 'eicon-woocommerce',
                ]
            );
        }


    }

    /**
     * Registers custom image sizes for use in Elementor widgets.
     *
     * This function defines several custom thumbnail sizes for displaying
     * images in Elementor widgets.
     *
     * @return void
     */
    public function primekit_elementor_custom_thumbnail_size()
    {
        // Register a custom thumbnail size
        add_image_size('primekit-elementor-post', 635, 542, true);
        add_image_size('primekit_blog_list_thumb', 600, 450, true);
        add_image_size('primekit_blog_grid_thumb', 900, 600, true);
        add_image_size('primekit_square_img', 800, 800, true);
    }




    public function primekit_mailchimp_subscribe()
    {
        // Check nonce for security
        check_ajax_referer('primekit_mailchimp_nonce', 'nonce');

        // Sanitize and validate form inputs
        $email = sanitize_email($_POST['email']);
        $fname = sanitize_text_field($_POST['fname'] ?? '');
        $lname = sanitize_text_field($_POST['lname'] ?? '');

        if (!is_email($email)) {
            wp_send_json_error(['message' => __('Invalid email address', 'primekit-addons')]);
        }

        // Fetch the Mailchimp API key
        $settings = get_option('primekit_mailchimp_options');
        $api_key = sanitize_text_field($settings['mailchimp_api_key'] ?? '');

        if (empty($api_key)) {
            wp_send_json_error(['message' => __('API key not configured', 'primekit-addons')]);
        }

        // Mailchimp API integration for subscription
        $data_center = substr($api_key, strpos($api_key, '-') + 1);
        $list_id = sanitize_text_field($_POST['mailchimp_list_id']);
        $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/';

        $body = json_encode([
            'email_address' => $email,
            'status' => 'subscribed',
            'merge_fields' => [
                'FNAME' => $fname,
                'LNAME' => $lname,
            ],
        ]);

        $response = wp_remote_post($url, [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode('user:' . $api_key),
                'Content-Type' => 'application/json',
            ],
            'body' => $body,
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => __('Subscription failed. Please try again.', 'primekit-addons')]);
        }

        $response_body = json_decode(wp_remote_retrieve_body($response));

        if (isset($response_body->status) && $response_body->status == 'subscribed') {
            wp_send_json_success(['message' => __('Subscription successful!', 'primekit-addons')]);
        } else {
            wp_send_json_error(['message' => __('Failed to subscribe.', 'primekit-addons')]);
        }
    }

    /**
     * Checks if WooCommerce is active.
     *
     * @return bool True if WooCommerce is active, false otherwise.
     */
    public static function is_woocommerce_active()
    {
        // Ensure the function `is_plugin_active` is available
        if (!function_exists('is_plugin_active')) {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }
        
        // Check if WooCommerce class exists and WooCommerce plugin is active
        return class_exists('WooCommerce') && is_plugin_active('woocommerce/woocommerce.php');
    }

}


