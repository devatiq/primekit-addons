<?php
/**
 * Adds a new control to the Advanced section of Elementor elements allowing users
 * to add a custom CSS code to the element.
 *
 * @since 1.0.3
 * @package PrimeKit
 */
namespace PrimeKit\Frontend\Elementor\Globals;

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

/**
 * Class CustomCSS
 *
 * This class provides functionality to add custom CSS to Elementor elements.
 * It registers a control in the Elementor editor that allows users to input
 * custom CSS for individual elements. The class also ensures that the custom
 * CSS is printed on both the frontend and the editor.
 *
 * @since 1.0.3
 * @package PrimeKit\Frontend\Elementor\Globals
 */
class CustomCSS
{

    /**
     * CustomCSS constructor.
     *
     * Initializes the class by calling the init method to set up actions
     * necessary for adding custom CSS functionality to Elementor elements.
     *
     * @since 1.0.3
     */
    public function __construct()
    {
        self::init();
    }

    /**
     * Initializes actions for adding custom CSS functionality to Elementor.
     *
     * Hooks into various Elementor actions to register custom CSS controls
     * and ensure that custom CSS is enqueued and printed both in the frontend
     * and in the Elementor editor.
     *
     * @since 1.0.3
     */
    public static function init()
    {
        add_action('elementor/element/common/_section_style/after_section_end', [__CLASS__, 'register'], 10);
        add_action('elementor/frontend/after_enqueue_styles', [__CLASS__, 'print_custom_css']);
        add_action('elementor/editor/after_enqueue_styles', [__CLASS__, 'print_custom_css']); // Added for editor mode
        add_action('elementor/editor/after_enqueue_scripts', [__CLASS__, 'enqueue_editor_assets']);
    }

    /**
     * Registers a control in the Elementor editor to allow users to input custom
     * CSS for individual elements.
     *
     * @since 1.0.3
     *
     * @param Element_Base $element The current Elementor element.
     */
    public static function register(Element_Base $element)
    {
        $element->start_controls_section(
            'primekit_section_custom_css',
            [
                'label' => __('PrimeKit Custom CSS', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'primekit_custom_css_notice',
            [
                'type' => Controls_Manager::NOTICE,
                'notice_type' => 'warning',
                'dismissible' => true,
                'heading' => esc_html__('Note:', 'primekit-addons'),
                'content' => esc_html__('You can add custom CSS for this specific widget. After adding CSS, reload the editor or check the result on the front end.', 'primekit-addons'),
            ]
        );

        $element->add_control(
            'primekit_custom_css',
            [
                'label' => __('Custom CSS', 'primekit-addons'),
                'type' => Controls_Manager::CODE,
                'language' => 'css',
                'rows' => 20,
            ]
        );

        $element->end_controls_section();
    }

    /**
     * Enqueues the custom CSS editor script for Elementor.
     *
     * Adds a JavaScript file to Elementor's editor to handle custom CSS input
     * for individual elements, ensuring the script is loaded with jQuery.
     *
     * @since 1.0.3
     */
    public static function enqueue_editor_assets()
    {
        wp_enqueue_script(
            'primekit-custom-css-editor',
            PRIMEKIT_ELEMENTOR_ASSETS . "/js/custom-css.js",
            ['jquery'],
            PRIMEKIT_VERSION,
            true
        );
    }

    /**
     * Prints custom CSS for Elementor elements on the frontend.
     *
     * This method is hooked into Elementor's frontend and editor hooks to print
     * custom CSS for Elementor elements. It retrieves the current post ID and
     * uses Elementor's API to get the elements associated with the post. It then
     * loops through the elements and uses a recursive function to add custom
     * CSS for each element. Finally, it prints a `<style>` block with the
     * concatenated CSS.
     *
     * @since 1.0.3
     */
    public static function print_custom_css()
    {
        $post_id = get_the_ID();
        if (!$post_id) {
            return;
        }

        $css = '';
        $document = Plugin::instance()->documents->get($post_id);
        if (!$document) {
            return;
        }

        $elements_data = $document->get_elements_data();

        foreach ($elements_data as $element_data) {
            self::add_custom_css_recursive($element_data, $css);
        }

        if (!empty($css)) {
            // Avoid printing duplicate style tags in live editor preview
            if (Plugin::$instance->editor->is_edit_mode()) {
                echo '<style id="primekit-custom-css-editor">' . wp_kses_post($css) . '</style>';
            } else {
                echo '<style id="primekit-custom-css">' . wp_kses_post($css) . '</style>';
            }
        }
    }

        /**
         * Adds custom CSS for an Elementor element recursively.
         *
         * This method loops through an Elementor element's data and adds any
         * custom CSS to a given string. It also recursively calls itself for
         * any child elements, ensuring all elements have their custom CSS added.
         *
         * @since 1.0.3
         *
         * @param array $element_data Elementor element data.
         * @param string $css         Custom CSS string to append to.
         *
         * @return void
         */
        private static function add_custom_css_recursive($element_data, &$css)
        {
            if (!empty($element_data['settings']['primekit_custom_css'])) {
                $element_id = $element_data['id'];
                $custom_css = $element_data['settings']['primekit_custom_css'];
        
                // Match all selectors and CSS blocks
                preg_match_all('/([^{]+)\{([^}]*)\}/', $custom_css, $matches, PREG_SET_ORDER);
        
                foreach ($matches as $match) {
                    $selectors = explode(',', trim($match[1]));
                    $rules = trim($match[2]);
        
                    foreach ($selectors as $selector) {
                        $selector = trim($selector);
                        if ($selector !== '') {
                            $css .= sprintf(
                                '.elementor-element.elementor-element-%s %s { %s }' . "\n",
                                $element_id,
                                $selector,
                                $rules
                            );
                        }
                    }
                }
            }
        
            if (!empty($element_data['elements'])) {
                foreach ($element_data['elements'] as $child_element) {
                    self::add_custom_css_recursive($child_element, $css);
                }
            }
        }
        
}