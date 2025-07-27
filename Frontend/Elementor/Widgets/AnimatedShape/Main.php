<?php
namespace PrimeKit\Frontend\Elementor\Widgets\AnimatedShape;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;


class Main extends Widget_Base
{
    public function get_name()
	{
		return 'primekit-animated-shape';
	}

	public function get_title()
	{
		return esc_html__('Animated Shape', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-shape primekit-addons-icon';
	}
	public function get_categories()
	{
		return ['primekit-category'];
	}
	public function get_keywords()
	{
		return ['prime', 'shape', 'animated'];
	}

    public function get_style_depends()
    {
        return ['primekit-shape-animation'];
    }

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_shape_settings',
            [
                'label' => esc_html__('Shape', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //shape type
        $this->add_control(
            'primekit_elementor_shape_type',
            [
                'label' => esc_html__('Shape Type', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'circle',
                'options' => [
                    'circle' => esc_html__('Circle', 'primekit-addons'),
                    'square' => esc_html__('Square', 'primekit-addons'),
                    'image' => esc_html__('Image', 'primekit-addons'),
                ],
            ]
        );
        //image shape
        $this->add_control(
            'primekit_elementor_shape_image',
            [
                'label' => esc_html__('Choose Image', 'primekit-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                
                'condition' => [
                    'primekit_elementor_shape_type' => 'image',
                ],
            ]
        );

         //image shape
         $this->add_control(
            'primekit_elementor_shape_image_alt',
            [
                'label' => esc_html__('Image Alt Text', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'PrimeKit Image',
                'condition' => [
                    'primekit_elementor_shape_type' => 'image',
                ],
            ]
        );

        //animation show/hide
        $this->add_control(
            'primekit_elementor_shape_animation',
            [
                'label' => esc_html__('Animation', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        //select animation
        $this->add_control(
            'primekit_elementor_shape_animation_effect',
            [
                'label' => esc_html__('Animation Type', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'PrimeSpin',
                'options' => [
                    'PrimexAxisMove' => esc_html__('X-Axis Move', 'primekit-addons'),
                    'PrimeyAxisMove' => esc_html__('Y-Axis Move', 'primekit-addons'),
                    'PrimetriAngleMove' => esc_html__('Triangle Move', 'primekit-addons'),
                    'PrimeSpin' => esc_html__('Spin', 'primekit-addons'),
                    'PrimeRotationMove' => esc_html__('Rotation Move', 'primekit-addons'),
                    'PrimeTilt' => esc_html__('Tilt', 'primekit-addons'),
                    'PrimeTimeLineAnimate' => esc_html__('Timeline Animate', 'primekit-addons'),
                    'PrimeSpinMove' => esc_html__('Spin Move', 'primekit-addons'),
                    'PrimeclockSpin' => esc_html__('Clockwise Spin', 'primekit-addons'),
                    'PrimeAntiClockSpin' => esc_html__('Anti-Clockwise Spin', 'primekit-addons'),
                    'PrimeRotating' => esc_html__('Rotating', 'primekit-addons'),
                ],
                'condition' => [
                    'primekit_elementor_shape_animation' => 'yes',
                ],
            ]
        );
                
        $this->end_controls_section();

        //Prime shape style
        $this->start_controls_section(
            'primekit_elementor_shape_style',
            [
                'label' => esc_html__('Shape Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_shape_type!' => 'image',
                ],
            ]
        );

        //shape border radius
        $this->add_responsive_control(
            'primekit_elementor_shape_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-shape-area .primekit-ele-shape' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //shape size
        $this->add_responsive_control(
            'primekit_elementor_shape_size',
            [
                'label' => esc_html__('Size', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                    'size' => 75,
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-shape-area .primekit-ele-shape' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //shape normal/hover tabs
        $this->start_controls_tabs('primekit_elementor_shape_style_tabs');

        //shape normal tab
        $this->start_controls_tab(
            'primekit_elementor_shape_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'primekit-addons'),
            ]
        );

        //shape background 
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'primekit_elementor_shape_background',
                'label' => esc_html__('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .primekit-shape-area .primekit-ele-shape',
            ]
        );

        //shape border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'primekit_elementor_shape_border',
                'selector' => '{{WRAPPER}} .primekit-shape-area .primekit-ele-shape',
            ]
        );

        $this->end_controls_tab();

        //shape hover tab
        $this->start_controls_tab(
            'primekit_elementor_shape_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'primekit-addons'),
            ]
        );

        //shape hover background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'primekit_elementor_shape_hover_background',
                'label' => esc_html__('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .primekit-shape-area:hover .primekit-ele-shape',
            ]
        );

        //shape hover border color
        $this->add_control(
            'primekit_elementor_shape_border_hover_color',
            [
                'label' => esc_html__('Border Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-shape-area:hover .primekit-ele-shape' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        //end of shape style
        $this->end_controls_section();

        //Prime shape image style
        $this->start_controls_section(
            'primekit_elementor_shape_image_style',
            [
                'label' => esc_html__('Image', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_shape_type' => 'image',
                ]
            ]
        );

        $this->add_responsive_control(
            'primekit_elementor_shape_image_width',
            [
                'label' => esc_html__('Width', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                    'size' => 150,
                ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-shape-area .primekit-shape-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Border settings
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'primekit_elementor_image_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-shape-area .primekit-shape-image img',
            ]
        );

        // Border Radius settings
        $this->add_responsive_control(
            'primekit_elementor_image_border_radius',
            [
                'label' => __('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-shape-area .primekit-shape-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'RenderView.php';
    }
}
