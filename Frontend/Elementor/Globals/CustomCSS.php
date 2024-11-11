<?php 
namespace PrimeKit\Frontend\Elementor\Globals;

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

class CustomCSS {

    public function __construct() {
        self::init();
    }

    public static function init() {
        add_action('elementor/element/common/_section_style/after_section_end', [__CLASS__, 'register'], 10);
        add_action('elementor/frontend/after_enqueue_styles', [__CLASS__, 'print_custom_css']);
        add_action('elementor/editor/after_enqueue_styles', [__CLASS__, 'print_custom_css']); // Added for editor mode
        add_action('elementor/editor/after_enqueue_scripts', [__CLASS__, 'enqueue_editor_assets']);
    }

    public static function register(Element_Base $element) {
        $element->start_controls_section(
            'primekit_section_custom_css',
            [
                'label' => __( 'PrimeKit Custom CSS', 'primekit-addons' ),
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
                'label' => __( 'Custom CSS', 'primekit-addons' ),
                'type' => Controls_Manager::CODE,
                'language' => 'css',
                'rows' => 20,
            ]
        );

        $element->end_controls_section();
    }

    public static function enqueue_editor_assets() {
        wp_enqueue_script(
            'primekit-custom-css-editor',
            PRIMEKIT_ELEMENTOR_ASSETS . "/js/custom-css.js", 
            ['jquery'],
            '1.0.0',
            true
        );
    }

    public static function print_custom_css() {
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
            echo '<style id="primekit-custom-css">' . $css . '</style>';
        }
    }

    private static function add_custom_css_recursive($element_data, &$css) {
        if (!empty($element_data['settings']['primekit_custom_css'])) {
            $element_id = $element_data['id'];
            $custom_css = $element_data['settings']['primekit_custom_css'];
            $css .= sprintf('.elementor-element.elementor-element-%s { %s } ', $element_id, $custom_css);
        }

        if (!empty($element_data['elements'])) {
            foreach ($element_data['elements'] as $child_element) {
                self::add_custom_css_recursive($child_element, $css);
            }
        }
    }
}