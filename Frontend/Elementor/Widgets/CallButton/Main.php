<?php
namespace PrimeKit\Frontend\Elementor\Widgets\CallButton;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base
{

	public function get_name()
	{
		return 'primekit-call-button';
	}

	public function get_title()
	{
		return esc_html__('Sticky Call Button', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-tel-field primekit-addons-icon';
	}

	public function get_categories()
	{
		return ['primekit-category'];
	}

	public function get_keywords()
	{
		return ['prime', 'call', 'button', 'mobile'];
	}

	public function get_style_depends()
    {
    return ['elementor-icons'];
    }


	protected function register_controls()
	{
		//Template
		$this->start_controls_section(
			'primekit_sticky_call_button_content',
			[
				'label' => esc_html__('Button Content', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//icon switch
		$this->add_control(
			'primekit_sticky_call_button_show_icon',
			[
				'label' => esc_html__( 'Show Icon', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'primekit-addons' ),
				'label_off' => esc_html__( 'Hide', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

			//text switch
			$this->add_control(
				'primekit_sticky_call_button_show_text',
				[
					'label' => esc_html__( 'Show Text', 'primekit-addons' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'primekit-addons' ),
					'label_off' => esc_html__( 'Hide', 'primekit-addons' ),
					'return_value' => 'yes',
					'default' => 'label_off',
				]
			);

		//icon
		$this->add_control(
			'primekit_sticky_call_button_icon',
			[
				'label' => esc_html__( 'Icon', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-phone-alt',
					'library' => 'fa-solid',
				],
				'condition' =>[
					'primekit_sticky_call_button_show_icon' => 'yes',
				],
			]
		);

		//Text
		$this->add_control(
			'primekit_sticky_call_button_text',
			[
				'label' => esc_html__( 'Button Text', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Call Now', 'primekit-addons' ),
				'condition' =>[
					'primekit_sticky_call_button_show_text' => 'yes',
				],
			]
		);

		//Link

		$this->add_control(
			'primekit_sticky_call_button_link',
			[
				'label' => esc_html__( 'Button Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		//button style
		$this->start_controls_section(
			'primekit_sticky_call_button_style',
			[
				'label' => esc_html__('Button Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//width
		$this->add_responsive_control(
			'primekit_sticky_call_button_width',
			[
				'label' => esc_html__( 'Button Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%',],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-sticky-call-button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//height
		$this->add_responsive_control(
			'primekit_sticky_call_button_height',
			[
				'label' => esc_html__( 'Button Height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%',],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-sticky-call-button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Border Radius
		$this->add_responsive_control(
			'primekit_sticky_call_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default' => [
					'top' => 50,
					'right' => 50,
					'bottom' => 50,
					'left' => 50,
					'unit' => '%',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-sticky-call-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//bg color
		$this->add_control(
			'primekit_sticky_call_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#1e49e7',
				'selectors' => [
					'{{WRAPPER}} .primekit-sticky-call-button' => 'background-color: {{VALUE}}',
				],
			]
		);

		//bg hover color
		$this->add_control(
			'primekit_sticky_call_button_bg_hover_color',
			[
				'label' => esc_html__( 'Background Hover Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#973af5',
				'selectors' => [
					'{{WRAPPER}} .primekit-sticky-call-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Bottom position
		$this->add_responsive_control(
			'primekit_sticky_call_button_bot_pos',
			[
				'label' => esc_html__( 'Bottom Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%',],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-sticky-call-button-area' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Left position
		$this->add_responsive_control(
			'primekit_sticky_call_button_left_pos',
			[
				'label' => esc_html__( 'Left Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%',],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-sticky-call-button-area' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//end of sticky button style
		$this->end_controls_section();

		//Icon style
		$this->start_controls_section(
			'primekit_sticky_call_icon_style',
			[
				'label' => esc_html__('Icon Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'primekit_sticky_call_button_show_icon' => 'yes',
				],
			]
		);

		//Icon Size
		$this->add_responsive_control(
			'primekit_sticky_call_button_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-call-button-icon svg, {{WRAPPER}} .primekit-call-button-icon i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		//Icon color
		$this->add_control(
			'primekit_sticky_call_button_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-call-button-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}}',
				],
			]
		);

			//Icon color
			$this->add_control(
				'primekit_sticky_call_button_icon_hov_color',
				[
					'label' => esc_html__( 'Icon Hover Color', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#FBD9FF',
					'selectors' => [
						'{{WRAPPER}} .primekit-sticky-call-button-area:hover svg' => 'fill: {{VALUE}}; color: {{VALUE}}',
					],
				]
			);

		//end of icon style
		$this->end_controls_section();

		//Icon style
		$this->start_controls_section(
			'primekit_sticky_call_text_style',
			[
				'label' => esc_html__('Text Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'primekit_sticky_call_button_show_text' => 'yes',
				],
			]
		);

		//Icon Space
		$this->add_responsive_control(
			'primekit_sticky_call_button_text_space',
			[
				'label' => esc_html__( 'Text and Icon Space', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-call-button-text ' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Text color
		$this->add_control(
			'primekit_sticky_call_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-call-button-text' => 'color: {{VALUE}}',
				],
			]
		);

		//Text Hov color
		$this->add_control(
			'primekit_sticky_call_button_text_hov_color',
			[
				'label' => esc_html__( 'Text Hover Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FBD9FF',
				'selectors' => [
					'{{WRAPPER}} .primekit-sticky-call-button-area:hover .primekit-call-button-text' => 'color: {{VALUE}}',
				],
			]
		);

		//typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_sticky_call_button_text_typography',
				'selector' => '{{WRAPPER}} .primekit-call-button-text',
			]
		);

		//end of icon style
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