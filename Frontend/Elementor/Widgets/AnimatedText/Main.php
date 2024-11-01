<?php
namespace PrimeKit\Frontend\Elementor\Widgets\AnimatedText;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base
{


	public function get_name()
	{
		return 'primekit-anim-text';
	}

	public function get_title()
	{
		return esc_html__('Animated Text', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-animation-text primekit-addons-icon';
	}
	public function get_categories()
	{
		return ['primekit-category'];
	}
	public function get_keywords()
	{
		return ['prime', 'animated', 'text'];
	}
	public function get_style_depends()
	{
		return ['primekit-anim-text-style'];
	}

	public function get_script_depends()
	{
		return ['primekit-anim-text-main'];
	}


	/**
	 * Register list widget controls.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'primekit_elementor_anim_text_setting',
			[
				'label' => esc_html__('Contents', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Notice
		$this->add_control(
			'primekit_elementor_anim_text_notice',
			[
				'type' => \Elementor\Controls_Manager::NOTICE,
				'notice_type' => 'warning',
				'dismissible' => false,
				'heading' => esc_html__('Notice:', 'primekit-addons'),
				'content' => esc_html__('To view the full animation, please check in the front end', 'primekit-addons'),
			]
		);

		//Heading tag
		$this->add_control(
			'primekit_elementor_anim_text_tag',
			[
				'label' => esc_html__('Heading Tag', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => esc_html__('H1', 'primekit-addons'),
					'h2' => esc_html__('H2', 'primekit-addons'),
					'h3' => esc_html__('H3', 'primekit-addons'),
					'h4' => esc_html__('H4', 'primekit-addons'),
					'h5' => esc_html__('H5', 'primekit-addons'),
					'H6' => esc_html__('H6', 'primekit-addons'),
				],

			]
		);

		//Alignment
		$this->add_responsive_control(
			'primekit_elementor_anim_text_align',
			[
				'label' => esc_html__('Alignment', 'primekit-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'primekit-addons'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'primekit-addons'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'primekit-addons'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-anim-text-area' => 'text-align: {{VALUE}}',
				],
			]
		);

		//before text
		$this->add_control(
			'primekit_elementor_anim_text_before',
			[
				'label' => esc_html__('Before Text', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 3,
				'default' => esc_html__('PrimeKit Addons is', 'primekit-addons'),
			]
		);

		//after text
		$this->add_control(
			'primekit_elementor_anim_text_after',
			[
				'label' => esc_html__('After Text', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 3,
			]
		);

		//animated text
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'primekit_elementor_anim_text',
			[
				'label' => esc_html__('Text', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Animated Text', 'primekit-addons'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'primekit_elementor_anim_text_list',
			[
				'label' => esc_html__('Animated Text', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'primekit_elementor_anim_text' => esc_html__('Awesome', 'primekit-addons'),
					],
					[
						'primekit_elementor_anim_text' => esc_html__('Creative', 'primekit-addons'),
					],
					[
						'primekit_elementor_anim_text' => esc_html__('Powerful', 'primekit-addons'),
					],
					[
						'primekit_elementor_anim_text' => esc_html__('Flexible', 'primekit-addons'),
					],
				],
				'title_field' => '{{{ primekit_elementor_anim_text }}}',
			]
		);

		//Animation Type
		$this->add_control(
			'primekit_elementor_anim_text_type',
			[
				'label' => esc_html__('Animation Type', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'rotate-1',
				'options' => [
					'rotate-1' => esc_html__('Rotate 1', 'primekit-addons'),
					'letters rotate-2' => esc_html__('Rotate 2', 'primekit-addons'),
					'letters rotate-3' => esc_html__('Rotate 3', 'primekit-addons'),
					'letters type' => esc_html__('Typing', 'primekit-addons'),
					'loading-bar' => esc_html__('Loading Bar', 'primekit-addons'),
					'slide' => esc_html__('Slide', 'primekit-addons'),
					'clip' => esc_html__('Clip', 'primekit-addons'),
					'zoom' => esc_html__('Zoom', 'primekit-addons'),
					'letters scale' => esc_html__('Scale', 'primekit-addons'),
					'push' => esc_html__('Push', 'primekit-addons'),
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

		$this->end_controls_section();//end Anim Text contents

		//Before Text Style 
		$this->start_controls_section(
			'primekit_elementor_anim_text_before_style',
			[
				'label' => esc_html__('Before Text Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Color
		$this->add_control(
			'primekit_elementor_anim_text_before_color',
			[
				'label' => esc_html__('Before Text Color', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-anim-before-text' => 'color: {{VALUE}}',
				],
			]
		);

		//Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_anim_text_before_typography',
				'label' => esc_html__('Before Text Typography', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-anim-before-text',
			]
		);

		$this->end_controls_section();//end before text style

		//Anim Text Style 
		$this->start_controls_section(
			'primekit_elementor_anim_text_anim_style',
			[
				'label' => esc_html__('Animated Text Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Color
		$this->add_control(
			'primekit_elementor_anim_text_anim_color',
			[
				'label' => esc_html__('Animated Text Color', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#b238f6',
				'selectors' => [
					'{{WRAPPER}} .primekit-anim-texts b' => 'color: {{VALUE}}',
				],
			]
		);

		//Bar Color
		$this->add_control(
			'primekit_elementor_anim_text_anim_bar_color',
			[
				'label' => esc_html__('Animated Bar Color', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#1a47e9',
				'selectors' => [
					'{{WRAPPER}} .cd-headline.loading-bar .cd-words-wrapper::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_anim_text_type' => 'loading-bar',
				],
			]
		);

		//Clip Color
		$this->add_control(
			'primekit_elementor_anim_text_anim_clip_color',
			[
				'label' => esc_html__('Cursor Color', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#1a47e9',
				'selectors' => [
					'{{WRAPPER}} .cd-headline.clip .cd-words-wrapper::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_anim_text_type' => 'clip',
				],
			]
		);

		//Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_anim_text_anim_typography',
				'label' => esc_html__('Animated Text Typography', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-anim-texts b',
			]
		);

		//Space
		$this->add_responsive_control(
			'primekit_elementor_anim_text_anim_space',
			[
				'label' => esc_html__('Animated Text Gap', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-anim-before-text' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .primekit-anim-after-text' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();//end anim text style

		//After Text Style 
		$this->start_controls_section(
			'primekit_elementor_anim_text_after_style',
			[
				'label' => esc_html__('After Text Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Color
		$this->add_control(
			'primekit_elementor_anim_text_after_color',
			[
				'label' => esc_html__('After Text Color', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-anim-after-text' => 'color: {{VALUE}}',
				],
			]
		);

		//Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_anim_text_after_typography',
				'label' => esc_html__('After Text Typography', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-anim-after-text',
			]
		);

		$this->end_controls_section();//end after text style

	}

	/**
	 * Render the widget output on the frontend.
	 */
	protected function render()
	{
		include 'renderview.php';
	}
}