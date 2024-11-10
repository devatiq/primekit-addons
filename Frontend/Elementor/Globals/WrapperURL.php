<?php
namespace PrimeKit\Frontend\Elementor\Globals;

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

use Elementor\Element_Base;
use Elementor\Controls_Manager;

class WrapperURL {

    public function __construct() {
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'add_custom_wrapper_controls'], 10, 2);
        add_action('elementor/frontend/widget/before_render', [$this, 'apply_custom_wrapper_link'], 10);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function enqueue_scripts() {
        wp_enqueue_script(
            'primekit-wrapper-url',
            PRIMEKIT_ELEMENTOR_ASSETS . '/js/wrapper-url.js',
            ['jquery'],
            PRIMEKIT_VERSION,
            true
        );
    }

    public function add_custom_wrapper_controls(Element_Base $element, $args) {
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
                'options' => [ 'url', 'is_external'],
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'primekit-addons'),
                'description' => __('Add a custom link to wrap this widget.', 'primekit-addons'),
            ]
        );

        $element->end_controls_section();
    }

    public function apply_custom_wrapper_link(Element_Base $element) {
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