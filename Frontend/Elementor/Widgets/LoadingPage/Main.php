<?php
namespace PrimeKit\Frontend\Elementor\Widgets\LoadingPage;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base
{

	public function get_name()
	{
		return 'primekit-loading-screen';
	}

	public function get_title()
	{
		return esc_html__('Loading Screen Page', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-loading primekit-addons-icon';
	}

	public function get_categories()
	{
		return ['primekit-category'];
	}

	public function get_keywords()
	{
		return ['prime', 'load', 'screen'];
	}

	public function get_script_depends()
    {
        return ['primekit-loading-screen']; 
    }

	/**
	 * Register list widget controls.
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'primekit_loading_screen',
			[
				'label' => esc_html__('Screen Contents', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Test Mode
		$this->add_control(
			'primekit_loading_screen_test_switch',
			[
				'label' => esc_html__( 'Test Mode?', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'primekit-addons' ),
				'label_off' => esc_html__( 'Off', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		//Note
		$this->add_control(
			'primekit_loading_screen_notice',
			[
				'type' => \Elementor\Controls_Manager::NOTICE,
				'notice_type' => 'warning',
				'dismissible' => false,
				'content' => esc_html__( 'Once the design is completed, make sure to turn off test mode switch. ', 'primekit-addons' ),
			]
		);

		//Image Switch
		$this->add_control(
			'primekit_loading_screen_img_switch',
			[
				'label' => esc_html__( 'Display Image?', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'primekit-addons' ),
				'label_off' => esc_html__( 'No', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		//Text Switch
		$this->add_control(
			'primekit_loading_screen_text_switch',
			[
				'label' => esc_html__( 'Display Text?', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'primekit-addons' ),
				'label_off' => esc_html__( 'No', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		//Bar Switch
		$this->add_control(
			'primekit_loading_screen_bar_switch',
			[
				'label' => esc_html__( 'Display Loading bar?', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'primekit-addons' ),
				'label_off' => esc_html__( 'No', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		//image
		$this->add_control(
			'primekit_loading_screen_image',
			[
				'label' => esc_html__( 'Choose Image', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
                    'primekit_loading_screen_img_switch' => 'yes',
                ],
			]
		);

		//Loading text
		$this->add_control(
			'primekit_loading_screen_text',
			[
				'label' => esc_html__( 'Text', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Loading..', 'primekit-addons' ),
				'condition' => [
                    'primekit_loading_screen_text_switch' => 'yes',
                ],
			]
		);

		//PrimeKit Notice
		$this->add_control(
			'primekit_elementor_addons_notice',
			[
				'type' => \Elementor\Controls_Manager::NOTICE,
				'notice_type' => 'warning',
				'dismissible' => false,
				'heading' => esc_html__('Created by PrimeKit', 'primekit-addons'),
				'content' => esc_html__('This amazing widget is built with PrimeKit Addons, making it super easy to create beautiful and functional designs.', 'primekit-addons'),
			]
		);

		$this->end_controls_section();

		//Loading screen style
		$this->start_controls_section(
			'primekit_elementor_loading_screen_style',
			[
				'label' => esc_html__('Screen Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'primekit_elementor_loading_screen_bg',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} #primekit-loading-screen',
			]
		);

		$this->end_controls_section();

		//Loading screen image style
		$this->start_controls_section(
			'primekit_elementor_loading_screen_img_style',
			[
				'label' => esc_html__('Image Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'primekit_loading_screen_img_switch' => 'yes',
                ],
			]
		);

		$this->add_control(
			'primekit_elementor_loading_screen_img_width',
			[
				'label' => esc_html__( 'Image Width', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 180,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-loading-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_loading_screen_img_space',
			[
				'label' => esc_html__( 'Bottom Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-loading-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_loading_screen_img_border',
				'selector' => '{{WRAPPER}} .primekit-loading-image',
			]
		);

		$this->add_control(
			'primekit_elementor_loading_screen_img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-loading-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		
		$this->end_controls_section();

		//Loading screen text style
		$this->start_controls_section(
			'primekit_elementor_loading_screen_text_style',
			[
				'label' => esc_html__('Text Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'primekit_loading_screen_text_switch' => 'yes',
                ],
			]
		);

		$this->add_control(
			'primekit_loading_screen_text_color',
			[
				'label' => esc_html__('Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-loading-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_loading_screen_text_typography',
				'label' => esc_html__('Typography', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-loading-text',
			]
		);

		$this->add_control(
			'primekit_elementor_loading_screen_text_space',
			[
				'label' => esc_html__( 'Bottom Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-loading-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Loading screen bar style
		$this->start_controls_section(
			'primekit_elementor_loading_screen_bar_style',
			[
				'label' => esc_html__('Bar Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'primekit_loading_screen_bar_switch' => 'yes',
                ],
			]
		);

		$this->add_control(
			'primekit_elementor_loading_screen_bar_width',
			[
				'label' => esc_html__( 'Bar Width', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 180,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-loading-bar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_loading_screen_bar_height',
			[
				'label' => esc_html__( 'Bar Height', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-loading-bar' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_loading_screen_bar_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-loading-bar' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_loading_screen_bar_bg',
			[
				'label' => esc_html__('Bar Background', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#F5DFF6',
				'selectors' => [
					'{{WRAPPER}} .primekit-loading-bar' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_loading_screen_circle_size',
			[
				'label' => esc_html__( 'Bar Circle Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-buffer-circle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_loading_screen_circle_space',
			[
				'label' => esc_html__( 'Bar Circle Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-buffer-circle' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_loading_screen_circle_bg',
			[
				'label' => esc_html__('Circle Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#007bff',
				'selectors' => [
					'{{WRAPPER}} .primekit-buffer-circle' => 'background-color: {{VALUE}}',
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
		include 'renderview.php';
	}
}