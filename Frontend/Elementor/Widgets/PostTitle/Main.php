<?php
namespace PrimeKit\Frontend\Elementor\Widgets\PostTitle;

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
		return 'primekit-post-title';
	}

	public function get_title()
	{
		return esc_html__('Post Title', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-post-title primekit-addons-icon';
	}

	public function get_categories()
	{
		return ['primekit-category'];
	}

	public function get_keywords()
	{
		return ['prime', 'post', 'title', 'post title'];
	}


	/**
	 * Register list widget controls.
	 */
	protected function register_controls()
	{
		//Template
		$this->start_controls_section(
			'primekit-elementor-post_title',
			[
				'label' => esc_html__('Alignment', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		//Heading tag
		$this->add_control(
			'primekit_elementor_post_title_tag',
			[
				'label' => esc_html__('Heading Tag', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'h1',
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
			'primekit_elementor_post_title_align',
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
					'{{WRAPPER}} .primekit-elementor-post-title-area' => 'text-align: {{VALUE}}',
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

		//post title style

		$this->start_controls_section(
			'primekit_elementor_post_title_style',
			[
				'label' => esc_html__('Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'primekit_elementor_post_title_color',
			[
				'label' => esc_html__('Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#cccccc',
				'selectors' => [
					'{{WRAPPER}} .primekit-post-title-tag' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_post_title_typography',
				'label' => esc_html__('Typography', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-post-title-tag',
			]
		);

		//end of divider bg style
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