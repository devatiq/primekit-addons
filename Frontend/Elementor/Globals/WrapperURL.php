<?php
/**
 * Adds a custom URL to Elementor's wrapper
 *
 * @since 1.0.3
 * @package PrimeKit
 */
namespace PrimeKit\Frontend\Elementor\Globals;

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

use Elementor\Element_Base;
use Elementor\Controls_Manager;

/**
 * Adds a custom URL to Elementor's wrapper.
 *
 * Adds a new control to the Style section of the common element in Elementor allowing
 * users to add a custom URL to the wrapper of the element.
 *
 * @since 1.0.3
 *
 * @property string $post_type The post type of the element.
 * @property int    $post_id   The post ID of the element.
 */
class WrapperURL
{

    /**
     * WrapperURL constructor.
     *
     * Initializes the WrapperURL class by adding necessary actions
     * to integrate custom wrapper controls into Elementor. Hooks are
     * added for inserting custom controls, applying a custom wrapper link,
     * and enqueuing required scripts for functionality.
     *
     * @since 1.0.3
     */
    public function __construct()
    {
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'add_custom_wrapper_controls'], 10, 2);
        add_action('elementor/frontend/widget/before_render', [$this, 'apply_custom_wrapper_link'], 10);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    /**
     * Enqueues the JavaScript file for the custom wrapper URL functionality.
     *
     * Uses the WordPress wp_enqueue_script function to include the JavaScript file
     * for the custom wrapper URL functionality.
     *
     * @since 1.0.3
     * @access public
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'primekit-wrapper-url',
            PRIMEKIT_ELEMENTOR_ASSETS . '/js/wrapper-url.js',
            ['jquery'],
            PRIMEKIT_VERSION,
            true
        );
    }

    /**
     * Adds a custom wrapper link control to the Elementor widget.
     *
     * Hooks into the elementor/element/common/_section_style/after_section_end action
     * to add a new control section with a URL control for adding a custom wrapper link.
     *
     * @since 1.0.3
     *
     * @param Element_Base $element The current Elementor widget.
     * @param array        $args    Elementor arguments.
     */
    public function add_custom_wrapper_controls(Element_Base $element, $args)
    {
        $element->start_controls_section(
            'primekit_section_custom_wrapper_link',
            [
                'label' => __('PrimeKit Wrapper Link', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $element->add_control(
            'primekit_custom_wrapper_link',
            [
                'label' => __('Wrapper Link', 'primekit-addons'),
                'type' => Controls_Manager::URL,
                'options' => ['url', 'is_external'],
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'primekit-addons'),
                'description' => __('Add a custom link to wrap this widget.', 'primekit-addons'),
            ]
        );

        $element->end_controls_section();
    }

    /**
     * Applies the custom wrapper link control to the element.
     *
     * Hooks into the elementor/frontend/widget/before_render action to check if a custom
     * wrapper link has been set for the widget. If it has, it adds the relevant attributes
     * to the element's wrapper.
     *
     * @since 1.0.3
     *
     * @param Element_Base $element The current Elementor widget.
     */
    public function apply_custom_wrapper_link(Element_Base $element)
    {
        $settings = $element->get_settings_for_display();

        if (!empty($settings['primekit_custom_wrapper_link']['url'])) {
            $link_data = [
                'url' => $settings['primekit_custom_wrapper_link']['url'],
                'is_external' => $settings['primekit_custom_wrapper_link']['is_external'],
                'nofollow' => $settings['primekit_custom_wrapper_link']['nofollow']
            ];

            $element->add_render_attribute('_wrapper', [
                'class' => 'primekit-custom-elementor-widget-link',
                'data-primekit-link-settings' => wp_json_encode($link_data)
            ]);
        }
    }
}