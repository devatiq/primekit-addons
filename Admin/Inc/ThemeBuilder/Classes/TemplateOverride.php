<?php
/**
 * TemplateOverride.php
 *
 * Template override class to handle overriding page templates on the frontend.
 *
 * @package PrimeKit/Admin/Inc/ThemeBuilder/Classes
 * @since 1.0.0
 */

namespace PrimeKit\Admin\Inc\ThemeBuilder\Classes;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
use PrimeKit\Admin\Inc\ThemeBuilder\ThemeBuilder;

/**
 * Class TemplateOverride
 *
 * This class is responsible for overriding page templates on the frontend.
 * It uses the hooks registered in the constructor to determine which template
 * should be used for the current page.
 *
 * @package PrimeKit/Admin/Inc/ThemeBuilder/Classes
 * @since 1.0.0
 */

class TemplateOverride
{

    public function __construct()
    {
        $this->register_hooks();
    }

    /**
     * Register the hooks for different template types.
     */
    public function register_hooks()
    {
        // Override different template types
        add_filter('template_include', array($this, 'override_single_template'));
        add_filter('page_template', array($this, 'override_page_template'));
        add_filter('404_template', array($this, 'override_404_template'));
        add_filter('search_template', array($this, 'override_search_template'));
        add_filter('archive_template', array($this, 'override_archive_template'));
        add_filter('woocommerce_single_product_template', array($this, 'override_shop_single_template'));
        add_filter('woocommerce_template_loader_files', array($this, 'override_shop_archive_template'));
    }

    /**
     * Override the single.php template for single posts.
     * 
     * If an Elementor template exists for the 'single_post' type, it will be used.
     * Otherwise, the default WordPress template will be used.
     * 
     * @param string $template The original template path.
     * 
     * @return string The path to the custom template or the original template.
     * 
     * @since 1.0.0
     */
    public function override_single_template($template)
    {
        global $post;
        // Ensure this only affects single posts (not pages)
        if (is_single() && 'post' === $post->post_type) {
            $template_id = ThemeBuilder::get_template_id('single_post');

            if ($template_id) {
                // Check if the custom template is built with Elementor
                if (\Elementor\Plugin::$instance->documents->get($template_id)->is_built_with_elementor()) {
                    return PRIMEKIT_TB_PATH . 'Inc/Templates/primekit-single.php';
                } else {
                    $custom_single_template = PRIMEKIT_TB_PATH . 'Inc/Templates/default-template.php';
                    if (file_exists($custom_single_template)) {
                        return $custom_single_template;
                    }
                }
            }
        }
        // Return the original template if no custom template is found
        return $template;
    }

    /**
     * Override the page.php template for single pages.
     * 
     * If an Elementor template exists for the 'single_page' type, it will be used.
     * Otherwise, the default WordPress template will be used.
     * 
     * @param string $page_template The original template path.
     * 
     * @return string The path to the custom template or the original template.
     * 
     * @since 1.0.0
     */
    public function override_page_template($page_template)
    {
        global $post;
        if (is_page() && 'page' === $post->post_type) {
            $template_id = ThemeBuilder::get_template_id('single_page');

            if ($template_id) {
                if (\Elementor\Plugin::$instance->documents->get($template_id)->is_built_with_elementor()) {
                    return PRIMEKIT_TB_PATH . 'Inc/Templates/primekit-page.php';
                } else {
                    $custom_single_template = PRIMEKIT_TB_PATH . 'Inc/Templates/default-template.php';
                    if (file_exists($custom_single_template)) {
                        return $custom_single_template;
                    }
                }
            }
        }

        return $page_template;
    }

    /**
     * Override the 404.php template.
     * 
     * If an Elementor template exists for the '404_page' type, it will be used.
     * Otherwise, the default WordPress template will be used.
     * 
     * @param string $template The original template path.
     * 
     * @return string The path to the custom template or the original template.
     * 
     * @since 1.0.0
     */
    public function override_404_template($template)
    {
        // Ensure this only affects the 404 page
        if (is_404()) {
            // Check if there's a custom template in `primekit_library` for '404_page'
            $template_id = ThemeBuilder::get_template_id('404_page');

            if ($template_id) {
                // Check if the custom template is built with Elementor
                if (\Elementor\Plugin::$instance->documents->get($template_id)->is_built_with_elementor()) {
                    return PRIMEKIT_TB_PATH . 'Inc/Templates/primekit-404.php';
                } else {
                    $custom_404_template = PRIMEKIT_TB_PATH . 'Inc/Templates/default-template.php';
                    if (file_exists($custom_404_template)) {
                        return $custom_404_template;
                    }
                }
            }
        }

        return $template;
    }


    /**
     * Override the search results template (search.php).
     * 
     * If an Elementor template exists for the 'search_page' type, it will be used.
     * Otherwise, the default WordPress template will be used.
     * 
     * @param string $template The original template path.
     * 
     * @return string The path to the custom template or the original template.
     * 
     * @since 1.0.0
     */
    public function override_search_template($template)
    {
        // Ensure this only affects the search results page
        if (is_search()) {
            // Check if there's a custom template in `primekit_library` for 'search_page'
            $template_id = ThemeBuilder::get_template_id('search_page');

            if ($template_id) {
                // Check if the custom template is built with Elementor
                if (\Elementor\Plugin::$instance->documents->get($template_id)->is_built_with_elementor()) {
                    // Load a blank template to allow Elementor to render its content
                    return PRIMEKIT_TB_PATH . 'Inc/Templates/primekit-search.php';
                } else {
                    // Fallback: Use a custom template if not built with Elementor
                    $custom_search_template = PRIMEKIT_TB_PATH . 'Inc/Templates/default-template.php';
                    if (file_exists($custom_search_template)) {
                        return $custom_search_template;
                    }
                }
            }
        }
        return $template;
    }


    /**
     * Override the archive template (archive.php).
     * 
     * If an Elementor template exists for the 'archive_page' type, it will be used.
     * Otherwise, the default WordPress template will be used.
     * 
     * @param string $template The original template path.
     * 
     * @return string The path to the custom template or the original template.
     * 
     * @since 1.0.0
     */
    public function override_archive_template($template)
    {
        global $post;

        // Ensure this only affects archive pages and skip the product archive
        if (is_archive() && !is_post_type_archive('product')) {
            $template_id = ThemeBuilder::get_template_id('archive_page');

            if ($template_id) {
                // Check if the custom template is built with Elementor
                if (\Elementor\Plugin::$instance->documents->get($template_id)->is_built_with_elementor()) {
                    return PRIMEKIT_TB_PATH . 'Inc/Templates/primekit-archive.php';
                } else {
                    $custom_archive_template = PRIMEKIT_TB_PATH . 'Inc/Templates/default-template.php';
                    if (file_exists($custom_archive_template)) {
                        return $custom_archive_template;
                    }
                }
            }
        }

        return $template;
    }


    /**
     * Override the WooCommerce single product template.
     * 
     * If an Elementor template exists for the 'shop_single' type, it will be used.
     * Otherwise, the default WooCommerce template will be used.
     * 
     * @param string $template The original template path.
     * 
     * @return string The path to the custom template or the original template.
     * 
     * @since 1.0.6
     */
    public function override_shop_single_template($template)
    {
        if (is_singular('product')) {
            $template_id = ThemeBuilder::get_template_id('shop_single');

            if ($template_id && \Elementor\Plugin::$instance->documents->get($template_id)->is_built_with_elementor()) {
                return PRIMEKIT_TB_PATH . 'Inc/Templates/primekit-shop-single.php';
            }
        }

        return $template;
    }

    /**
     * Override the WooCommerce shop archive template.
     * 
     * If an Elementor template exists for the 'shop_archive' type, it will be used.
     * Otherwise, the default WooCommerce template will be used.
     * 
     * @param array $templates The original template paths.
     * 
     * @return array The path to the custom template or the original template.
     * 
     * @since 1.0.6
     */
    public function override_shop_archive_template($templates)
    {
        if (is_post_type_archive('product') || is_product_category() || is_product_tag()) {
            $template_id = ThemeBuilder::get_template_id('shop_archive');

            if ($template_id && \Elementor\Plugin::$instance->documents->get($template_id)->is_built_with_elementor()) {
                $templates = [PRIMEKIT_TB_PATH . 'Inc/Templates/primekit-shop-archive.php'];
            }
        }

        return $templates;
    }


}