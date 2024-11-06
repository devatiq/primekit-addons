<?php
namespace PrimeKit\Frontend\Elementor\Widgets\PostContent;

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
		return 'primekit-post-content';
	}

	public function get_content()
	{
		return esc_html__('Post Contents', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-post-content primekit-addons-icon';
	}

	public function get_categories()
	{
		return ['primekit-category'];
	}

	public function get_keywords()
	{
		return ['prime', 'post', 'content', 'blog'];
	}


	/**
	 * Register list widget controls.
	 */
	protected function register_controls()
	{
		//Template
		$this->start_controls_section(
			'primekit_addons_post_content',
			[
				'label' => esc_html__('Alignment', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		//Alignment
		$this->add_responsive_control(
			'primekit_addons_post_content_align',
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
					'{{WRAPPER}} .primekit-elementor-post-content-area' => 'text-align: {{VALUE}}',
				],
			]
		);

		//PrimeKit Notice
		$this->add_control(
			'primekit_addons_addons_notice',
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
			'primekit_addons_post_content_style',
			[
				'label' => esc_html__('Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'primekit_addons_post_content_color',
			[
				'label' => esc_html__('Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#555555',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-post-content-area' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_addons_post_content_typography',
				'label' => esc_html__('Typography', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-elementor-post-content-area',
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