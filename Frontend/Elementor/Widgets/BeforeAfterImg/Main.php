<?php
namespace PrimeKit\Frontend\Elementor\Widgets\BeforeAfterImg;

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
		return 'primekit-before-after-image';
	}

	public function get_title()
	{
		return esc_html__('Before After Image', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-image-before-after';
	}
	public function get_categories()
	{
		return ['primekit-category'];
	}
	public function get_keywords()
	{
		return ['prime', 'before', 'after', 'image'];
	}


	public function get_style_depends()
	{
		return ['twentytwenty'];
	}

	public function get_script_depends()
	{
		return ['jquery-event-move', 'jquery-twentytwenty', 'primekit-before-after-script'];
	}

	/**
	 * Register list widget controls.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'primekit_elementor_before_after_image',
			[
				'label' => esc_html__('Before After Image', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Before Image
		$this->add_control(
			'primekit_elementor_before_img_upload',
			[
				'label' => esc_html__('Upload Before Image', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		//Before Alt Text
		$this->add_control(
			'primekit_elementor_before_img_alt',
			[
				'label' => esc_html__('Before Image Alt Text', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Before Image', 'primekit-addons'),
			]
		);

		//Before Image
		$this->add_control(
			'primekit_elementor_after_img_upload',
			[
				'label' => esc_html__('Upload After Image', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		//After Alt Text
		$this->add_control(
			'primekit_elementor_after_img_alt',
			[
				'label' => esc_html__('After Image Alt Text', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('After Image', 'primekit-addons'),
			]
		);

		$this->end_controls_section();//end image section

		$this->start_controls_section(
			'primekit_elementor_before_after_setting',
			[
				'label' => esc_html__('Widget Setings', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//orientation
		$this->add_responsive_control(
			'primekit_elementor_before_after_orientation',
			[
				'label' => esc_html__('Alignment', 'primekit-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => [
						'title' => esc_html__('Horizontal', 'primekit-addons'),
						'icon' => 'eicon-h-align-stretch',
					],
					'vertical' => [
						'title' => esc_html__('Vertical', 'primekit-addons'),
						'icon' => 'eicon-v-align-stretch',
					],
				],
			]
		);

		//Before image visibility
		$this->add_responsive_control(
			'primekit_elementor_before_img_visibility',
			[
				'label' => esc_html__('Before Image Visibility', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0.5,
				],
			]
		);

		//Overlay
		$this->add_control(
			'primekit_elementor_before_after_switch',
			[
				'label' => esc_html__('Hide Overlay?', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'overlay_on' => esc_html__('Show', 'primekit-addons'),
				'overlay_off' => esc_html__('Hide', 'primekit-addons'),
				'return_value' => 'true',
				'default' => 'overlay_off',
			]
		);

		//Before Label Text
		$this->add_control(
			'primekit_elementor_before_label_text',
			[
				'label' => esc_html__('Before Label Text', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Before', 'primekit-addons'),
			]
		);

		//After Label Text
		$this->add_control(
			'primekit_elementor_after_label_text',
			[
				'label' => esc_html__('After Label Text', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('After', 'primekit-addons'),
			]
		);

		//Move type
		$this->add_control(
			'primekit_elementor_before_after_handle_move',
			[
				'label' => __('Handle Move Type', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'on_swipe',
				'options' => [
					'on_hover' => __('On Hover', 'primekit-addons'),
					'on_click' => __('On Click', 'primekit-addons'),
					'on_swipe' => __('On Swipe', 'primekit-addons'),
				],
				'description' => __('Select handle movement type. Overlay does not work with On Hover.', 'primekit-addons'),
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


		$this->end_controls_section();//end label section

		//Style Section
		$this->start_controls_section(
			'primekit_elementor_before_after_style',
			[
				'label' => esc_html__('Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Handle Height
		$this->add_responsive_control(
			'primekit_elementor_after_handle_height',
			[
				'label' => esc_html__('Handle Height', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 150,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 38,
				],
				'selectors' => [
					'{{WRAPPER}} #primekit-before-after-container .twentytwenty-handle' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Handle Height
		$this->add_responsive_control(
			'primekit_elementor_after_handle_width',
			[
				'label' => esc_html__('Handle width', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 150,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 38,
				],
				'selectors' => [
					'{{WRAPPER}} #primekit-before-after-container .twentytwenty-handle' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Margin top
		$this->add_responsive_control(
			'primekit_elementor_after_handle_margin_top',
			[
				'label' => esc_html__('Top Position', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -22,
				],
				'selectors' => [
					'{{WRAPPER}} #primekit-before-after-container .twentytwenty-handle' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Margin top
		$this->add_responsive_control(
			'primekit_elementor_after_handle_margin_left',
			[
				'label' => esc_html__('Left Position', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -22,
				],
				'selectors' => [
					'{{WRAPPER}} #primekit-before-after-container .twentytwenty-handle' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Border Color
		$this->add_control(
			'primekit_elementor_after_handle_color',
			[
				'label' => esc_html__('Handle Color', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} #primekit-before-after-container .twentytwenty-handle' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} #primekit-before-after-container .twentytwenty-handle:before, {{WRAPPER}} #primekit-before-after-container .twentytwenty-handle:after' => 'background: {{VALUE}}',
					'{{WRAPPER}} #primekit-before-after-container .twentytwenty-handle:before, {{WRAPPER}} #primekit-before-after-container .twentytwenty-handle:after' => 'background: {{VALUE}}',
					'{{WRAPPER}} #primekit-before-after-container .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}}',
					'{{WRAPPER}} #primekit-before-after-container .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();//end style section

		//Label Style Section
		$this->start_controls_section(
			'primekit_elementor_before_after_label_style',
			[
				'label' => esc_html__('Label Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		//Label Color
		$this->add_control(
			'primekit_elementor_before_after_label_color',
			[
				'label' => esc_html__('Label Text Color', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} #primekit-before-after-container .twentytwenty-before-label:before, {{WRAPPER}} #primekit-before-after-container .twentytwenty-after-label:before' => 'color: {{VALUE}}',
				],
			]
		);

		//Label Color
		$this->add_control(
			'primekit_elementor_before_after_label_bg_color',
			[
				'label' => esc_html__('Label Background Color', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,.2)',
				'selectors' => [
					'{{WRAPPER}} #primekit-before-after-container .twentytwenty-before-label:before, {{WRAPPER}} #primekit-before-after-container .twentytwenty-after-label:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();//end label style section
	}

	/**
	 * Render the widget output on the frontend.
	 */
	protected function render()
	{
		include 'renderview.php';
	}
}