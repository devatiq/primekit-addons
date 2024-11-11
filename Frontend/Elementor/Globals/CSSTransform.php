<?php
/**
 * PrimeKit
 *
 * @package PrimeKit
 * @subpackage PrimeKit/Frontend/Elementor/Globals
 *
 * @since 1.0.3
 */
namespace PrimeKit\Frontend\Elementor\Globals;

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

use Elementor\Element_Base;
use Elementor\Controls_Manager;

/**
 * Class CSSTransform
 *
 * This class is responsible for handling CSS transformations within the Elementor environment.
 * It initializes the required actions to enable CSS transformations for common elements.
 *
 * @package PrimeKit\Frontend\Elementor\Globals
 * @since 1.0.3
 */
class CSSTransform
{

    /**
     * CSSTransform constructor.
     *
     * Initializes the class by calling the init method to set up actions
     * necessary for enabling CSS transformations within the Elementor environment.
     *
     * @since 1.0.3
     */
    public function __construct()
    {
        self::init();
    }

    /**
     * Initializes the class by setting up the necessary actions to enable
     * CSS transformations within the Elementor environment.
     *
     * The init method hooks into the `elementor/element/common/_section_style/after_section_end` action
     * to register the PrimeKit CSS Transform options within the Elementor environment.
     *
     * @since 1.0.3
     * @access public
     */
    public static function init()
    {
        add_action('elementor/element/common/_section_style/after_section_end', [__CLASS__, 'register'], 1);
    }

    /**
     * Registers the PrimeKit CSS Transform controls.
     *
     * @since 1.0.3
     * @param Element_Base $element The Elementor element.
     * @access public
     */
    public static function register(Element_Base $element)
    {
        $element->start_controls_section(
            'primekit_section_css_transform',
            [
                'label' => __('PrimeKit CSS Transform', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'primekit_transform_fx',
            [
                'label' => __('Enable', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'prefix_class' => 'primekit-css-transform-',
            ]
        );

        $element->start_controls_tabs(
            '_tabs_primekit_transform',
            [
                'condition' => [
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        // Normal tab
        $element->start_controls_tab(
            '_tab_primekit_transform_normal',
            [
                'label' => __('Normal', 'primekit-addons'),
                'condition' => [
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        // Translate
        $element->add_control(
            'primekit_transform_fx_translate_toggle',
            [
                'label' => __('Translate', 'primekit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            'primekit_transform_fx_translate_x',
            [
                'label' => __('Translate X', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_translate_toggle' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--primekit-tfx-translate-x: {{SIZE}}px;'
                ],
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_translate_y',
            [
                'label' => __('Translate Y', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_translate_toggle' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--primekit-tfx-translate-y: {{SIZE}}px;'
                ],
            ]
        );

        $element->end_popover();

        // Rotate
        $element->add_control(
            'primekit_transform_fx_rotate_toggle',
            [
                'label' => __('Rotate', 'primekit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'condition' => [
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        $element->start_popover();

        $element->add_control(
            'primekit_transform_fx_rotate_mode',
            [
                'label' => __('Mode', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'compact' => [
                        'title' => __('Compact', 'primekit-addons'),
                        'icon' => 'eicon-plus-circle',
                    ],
                    'loose' => [
                        'title' => __('Loose', 'primekit-addons'),
                        'icon' => 'eicon-minus-circle',
                    ],
                ],
                'default' => 'loose',
                'toggle' => false,
                'condition' => [
                    'primekit_transform_fx_rotate_toggle' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'primekit_transform_fx_rotate_hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_rotate_x',
            [
                'label' => __('Rotate X', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_rotate_toggle' => 'yes',
                    'primekit_transform_fx' => 'yes',
                    'primekit_transform_fx_rotate_mode' => 'loose'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--primekit-tfx-rotate-x: {{SIZE}}deg;'
                ],
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_rotate_y',
            [
                'label' => __('Rotate Y', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_rotate_toggle' => 'yes',
                    'primekit_transform_fx' => 'yes',
                    'primekit_transform_fx_rotate_mode' => 'loose'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--primekit-tfx-rotate-y: {{SIZE}}deg;'
                ],
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_rotate_z',
            [
                'label' => __('Rotate Z', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_rotate_toggle' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--primekit-tfx-rotate-z: {{SIZE}}deg;'
                ],
            ]
        );

        $element->end_popover();

        // Scale
        $element->add_control(
            'primekit_transform_fx_scale_toggle',
            [
                'label' => __('Scale', 'primekit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        $element->start_popover();

        $element->add_control(
            'primekit_transform_fx_scale_mode',
            [
                'label' => __('Mode', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'compact' => [
                        'title' => __('Compact', 'primekit-addons'),
                        'icon' => 'eicon-plus-circle',
                    ],
                    'loose' => [
                        'title' => __('Loose', 'primekit-addons'),
                        'icon' => 'eicon-minus-circle',
                    ],
                ],
                'default' => 'loose',
                'toggle' => false
            ]
        );

        $element->add_control(
            'primekit_transform_fx_scale_hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_scale_x',
            [
                'label' => __('Scale X', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 1
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => .1
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_scale_toggle' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--primekit-tfx-scale-x: {{SIZE}}; --primekit-tfx-scale-y: {{SIZE}};'
                ],
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_scale_y',
            [
                'label' => __('Scale Y', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 1
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => .1
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_scale_toggle' => 'yes',
                    'primekit_transform_fx' => 'yes',
                    'primekit_transform_fx_scale_mode' => 'loose',
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--primekit-tfx-scale-y: {{SIZE}};'
                ],
            ]
        );

        $element->end_popover();

        // Skew
        $element->add_control(
            'primekit_transform_fx_skew_toggle',
            [
                'label' => __('Skew', 'primekit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            'primekit_transform_fx_skew_x',
            [
                'label' => __('Skew X', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_skew_toggle' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--primekit-tfx-skew-x: {{SIZE}}deg;'
                ],
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_skew_y',
            [
                'label' => __('Skew Y', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_skew_toggle' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--primekit-tfx-skew-y: {{SIZE}}deg;'
                ],
            ]
        );

        $element->end_popover();

        $element->end_controls_tab();

        // Hover tab
        $element->start_controls_tab(
            'primekit_tab_primekit_transform_hover',
            [
                'label' => __('Hover', 'primekit-addons'),
                'condition' => [
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        // Translate Hover
        $element->add_control(
            'primekit_transform_fx_translate_toggle_hover',
            [
                'label' => __('Translate', 'primekit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            'primekit_transform_fx_translate_x_hover',
            [
                'label' => __('Translate X', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_translate_toggle_hover' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover' => '--primekit-tfx-translate-x-hover: {{SIZE}}px;'
                ],
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_translate_y_hover',
            [
                'label' => __('Translate Y', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_translate_toggle_hover' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover' => '--primekit-tfx-translate-y-hover: {{SIZE}}px;'
                ],
            ]
        );

        $element->end_popover();

        // Rotate Hover
        $element->add_control(
            'primekit_transform_fx_rotate_toggle_hover',
            [
                'label' => __('Rotate', 'primekit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'condition' => [
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            'primekit_transform_fx_rotate_x_hover',
            [
                'label' => __('Rotate X', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_rotate_toggle_hover' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover' => '--primekit-tfx-rotate-x-hover: {{SIZE}}deg;'
                ],
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_rotate_y_hover',
            [
                'label' => __('Rotate Y', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_rotate_toggle_hover' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover' => '--primekit-tfx-rotate-y-hover: {{SIZE}}deg;'
                ],
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_rotate_z_hover',
            [
                'label' => __('Rotate Z', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_rotate_toggle_hover' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover' => '--primekit-tfx-rotate-z-hover: {{SIZE}}deg;'
                ],
            ]
        );

        $element->end_popover();

        // Scale Hover
        $element->add_control(
            'primekit_transform_fx_scale_toggle_hover',
            [
                'label' => __('Scale', 'primekit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            'primekit_transform_fx_scale_x_hover',
            [
                'label' => __('Scale X', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 1
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => .1
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_scale_toggle_hover' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover' => '--primekit-tfx-scale-x-hover: {{SIZE}};'
                ],
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_scale_y_hover',
            [
                'label' => __('Scale Y', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 1
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => .1
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_scale_toggle_hover' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover' => '--primekit-tfx-scale-y-hover: {{SIZE}};'
                ],
            ]
        );

        $element->end_popover();

        // Skew Hover
        $element->add_control(
            'primekit_transform_fx_skew_toggle_hover',
            [
                'label' => __('Skew', 'primekit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'primekit_transform_fx' => 'yes',
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            'primekit_transform_fx_skew_x_hover',
            [
                'label' => __('Skew X', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_skew_toggle_hover' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover' => '--primekit-tfx-skew-x-hover: {{SIZE}}deg;'
                ],
            ]
        );

        $element->add_responsive_control(
            'primekit_transform_fx_skew_y_hover',
            [
                'label' => __('Skew Y', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'condition' => [
                    'primekit_transform_fx_skew_toggle_hover' => 'yes',
                    'primekit_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover' => '--primekit-tfx-skew-y-hover: {{SIZE}}deg;'
                ],
            ]
        );

        $element->end_popover();

        $element->end_controls_tab();

        $element->end_controls_tabs();

        $element->end_controls_section();
    }
}