<?php 
namespace PrimeKit\Admin\Inc\Dashboard\AvailableWidgets;

//don't load this file directly
if (!defined('ABSPATH')) {
    exit;
}

use PrimeKit\Admin\Inc\Dashboard\AvailableWidgets\PrimeKitWidgets;
/**
 * WooCommerceTab class
 * Handles the rendering of the WooCommerce widgets.
 *
 * @package PrimeKit\Admin\Inc\Dashboard\AvailableWidgets
 * @since 1.0.0
 */
class WooCommerceTab
{

    /**
     * Generates a complete demo URL by appending the given path to the base domain.
     *
     * @param string $path The specific path to append to the demo domain URL.
     * @return string The fully constructed demo URL.
     */
    public static function demo_url($path)
    {
        $domain = 'https://demo.primekitaddons.com/';
        return $domain . $path;
    }

    /**
     * Renders the WooCommerce widgets.
     *
     * @since 1.0.0
     */
    public static function primekit_woocommerce_widgets_display()
    {
        // Add to cart.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_add_to_cart_icon_field',
            esc_html__('Add to cart', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-add-to-cart-elementor-widget/')
        );
        // Cart Icon.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_product_cart_icon_field',
            esc_html__('Cart Icon', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/product-cart-icon-elementor-widget/')
        );
        // Cart Page.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_cart_page_field',
            esc_html__('Cart Page', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-custom-cart-page-elementor-widget/')
        );
        // Checkout Page.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_checkout_page_field',
            esc_html__('Checkout Page', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-custom-checkout-page-elementor-widget/')
        );
        // Product Image.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_product_img_field',
            esc_html__('Product Image', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-product-image-elementor-widget/')
        );
        // Product Meta.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_product_meta_field',
            esc_html__('Product Meta', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-product-meta-elementor-widget/')
        );
        // Product Price.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_product_price_field',
            esc_html__('Product Price', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-product-pricing-elementor-widget/')
        );
        // Related Products.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_product_related_field',
            esc_html__('Related Products', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-related-product-elementor-widget/')
        );
        // Short Description.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_product_short_desc_field',
            esc_html__('Short Description', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-product-short-description-elementor-widget/')
        );
        // Product Tabs.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_product_tabs_field',
            esc_html__('Product Tabs', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-product-tabs-elementor-widget/')
        );
        // Product Title.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_product_title_field',
            esc_html__('Product Title', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-product-title-elementor-widget/')
        );
        // Product Bread Crumb.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_product_bread_crumb_field',
            esc_html__('Product Bread Crumb', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-breadcrumb-elementor-widget/')
        );
        // My Account.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wc_my_account_field',
            esc_html__('My Account', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/woocommerce-my-account-elementor-widget/')
        );
    }
}