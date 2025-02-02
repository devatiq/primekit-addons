<?php
namespace PrimeKit\Frontend\Elementor\Widgets\ModernPostGrid;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base
{

	public function get_name()
	{
		return 'primekit-modern-post-grid';
	}

	public function get_title()
	{
		return esc_html__('Modern Post Grid', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-posts-grid primekit-addons-icon';
	}

	public function get_categories()
	{
		return ['primekit-category'];
	}

	public function get_keywords()
	{
		return ['prime', 'post', 'grid', 'modern', 'post grid', 'modern post grid', 'blog'];
	}

	public function get_script_depends()
	{
		return ['primekit-modern-posts'];
	}

	/**
	 * Get all available post types.
	 */
	protected function get_post_types()
	{
		$post_types = get_post_types(
			[
				'public' => true,
			],
			'objects'
		);
		$exclude = ['attachment']; // Post types to exclude

		$options = [];
		foreach ($post_types as $post_type) {
			if (!in_array($post_type->name, $exclude)) {
				$options[$post_type->name] = $post_type->label;
			}
		}
		return $options;
	}

	/**
	 * Get all available categories.
	 */
	protected function get_categories_list()
	{
		$categories = get_categories();
		$options = [];
		foreach ($categories as $category) {
			$options[$category->term_id] = $category->name;
		}
		return $options;
	}

	/**
	 * Get all available posts.
	 */
	protected function get_posts()
	{
		$posts = get_posts([
			'post_type' => 'post',
			'posts_per_page' => -1
		]);
		$options = [];
		foreach ($posts as $post) {
			$options[$post->ID] = $post->post_title;
		}
		return $options;
	}
	/**
	 * Register list widget controls.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'primekit_modern_post_grid_setting',
			[
				'label' => esc_html__('Settings', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// Add control for selecting grid style
		$this->add_control(
			'primekit_modern_post_grid_style',
			[
				'label' => esc_html__('Grid Layout', 'primekit-addons'),
				'description' => esc_html__('Select grid layout', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Layout 1', 'primekit-addons'),
					'style2' => esc_html__('Layout 2', 'primekit-addons'),
					'style3' => esc_html__('Layout 3', 'primekit-addons'),
					'style4' => esc_html__('Layout 4', 'primekit-addons'),
					'style5' => esc_html__('Layout 5', 'primekit-addons'),
					'style6' => esc_html__('Layout 6', 'primekit-addons'),
					'style7' => esc_html__('Layout 7', 'primekit-addons'),
					'style8' => esc_html__('Layout 8', 'primekit-addons'),
				],
			]
		);

		// Add control for selecting post types
		$this->add_control(
			'post_types',
			[
				'label' => esc_html__('Post Types', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => $this->get_post_types(),
				'default' => ['post'], // Default to 'post' type
				'description' => esc_html__('Select specific post types to display', 'primekit-addons'),
				//'label_block' => true,				
			]
		);

		// Add control for customizing the post display based on categories or specific posts
		$this->add_control(
			'customized_posts_selection',
			[
				'label' => esc_html__('Customize Post Display', 'primekit-addons'),
				'description' => esc_html__('Choose how to customize the posts displayed on your grid. You can select to display posts by categories or specific posts.', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'options' => [
					'' => esc_html__('None', 'primekit-addons'), // Default to no selection
					'categories' => esc_html__('Display by Categories', 'primekit-addons'),
					'specific_posts' => esc_html__('Display Specific Posts', 'primekit-addons'),
				],
				'condition' => [
					'post_types' => 'post',
				],
			]
		);

		// Add control for selecting categories
		$this->add_control(
			'get_categories',
			[
				'label' => esc_html__('Categories', 'primekit-addons'),
				'type' => Controls_Manager::SELECT2,
				'description' => esc_html__('Select specific categories to display', 'primekit-addons'),
				'multiple' => true,
				'options' => $this->get_categories_list(),
				'label_block' => true,
				'condition' => [
					'customized_posts_selection' => 'categories',
				],
			]
		);

		// Add control for selecting specific posts
		$this->add_control(
			'get_posts_list',
			[
				'label' => esc_html__('Display Specific Posts', 'primekit-addons'),
				'description' => esc_html__('Select specific posts to display', 'primekit-addons'),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_posts(),
				'label_block' => true,
				'condition' => [
					'customized_posts_selection' => 'specific_posts',
				],
			]
		);

		// Add control for ignoring sticky posts
		$this->add_control(
			'ignore_sticky_posts',
			[
				'label' => esc_html__('Ignore Sticky Posts', 'primekit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'primekit-addons'),
				'label_off' => esc_html__('No', 'primekit-addons'),
				'return_value' => 'true',
				'default' => 'true',
				'description' => esc_html__('Enable this option to ignore sticky posts in the post query.', 'primekit-addons'),
			]
		);
		// Add control for limiting the number of posts (max 4)
		$this->add_control(
			'post_limit_for_style2',
			[
				'label' => esc_html__('Number of Posts to Display', 'primekit-addons'),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
				'min' => 1,
				'max' => 4,
				'description' => esc_html__('Set the number of posts to display, maximum is 4.', 'primekit-addons'),
				'condition' => [
					'primekit_modern_post_grid_style' => 'style2',
				],
			]
		);
		// Add control for limiting the number of posts (max 4)
		$this->add_control(
			'post_limit',
			[
				'label' => esc_html__('Number of Posts to Display', 'primekit-addons'),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
				'min' => 1,
				'description' => esc_html__('Set the number of posts to display', 'primekit-addons'),
				'condition' => [
					'primekit_modern_post_grid_style!' => 'style2',
				]
			]
		);
		// Add control for displaying post info
		$this->add_control(
			'post_meta_switch',
			[
				'label' => esc_html__('Display Post Meta', 'primekit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'primekit-addons'),
				'label_off' => esc_html__('No', 'primekit-addons'),
				'return_value' => 'true',
				'default' => 'true',
				'description' => esc_html__('Enable this option to display post meta such as date, author, category and comments.', 'primekit-addons'),
				'condition' => [
					'post_types' => 'post',
				],
			]
		);
		// Add control for selecting post info to display
		$this->add_control(
			'post_meta_display',
			[
				'label' => esc_html__('Select meta to Display', 'primekit-addons'),
				'type' => Controls_Manager::SELECT2,
				'description' => esc_html__('Select which post meta (date, author, comments) should be displayed in the post card.', 'primekit-addons'),
				'multiple' => true,
				'options' => [
					'date' => esc_html__('Date', 'primekit-addons'),
					'author' => esc_html__('Author', 'primekit-addons'),
					'comments' => esc_html__('Comments', 'primekit-addons'),
				],
				'default' => ['date', 'author'],
				'label_block' => true,
				'condition' => [
					'post_meta_switch' => 'true',
					'post_types' => 'post',
				],
			]
		);

		// Add control for displaying category
		$this->add_control(
			'display_category',
			[
				'label' => esc_html__('Display Category', 'primekit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'primekit-addons'),
				'label_off' => esc_html__('No', 'primekit-addons'),
				'condition' => [
					'post_types' => 'post',
				],
				'return_value' => 'true',
				'default' => 'true',
				'description' => esc_html__('Enable this option to display the category in the post card.', 'primekit-addons'),
			]
		);

		$this->end_controls_section();//end after text style

		// Start style section
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		// Add control for item gap
		$this->add_responsive_control(
			'item_gap',
			[
				'label' => esc_html__('Item Gap', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-posts-grid-wrapper' => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .primekit-modren-posts-styl2-wrapper' => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .primekit-modern-post-style4-wrapper' => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .primekit-modern-post-style5-wrapper' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// Border control for item
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'label' => esc_html__('Item Border', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-modern-single-post-style4',
				'condition' => [
					'primekit_modern_post_grid_style' => ['style4', 'style5'],
				],
			]
		);
		// Border radius control for item
		$this->add_control(
			'item_border_radius',
			[
				'label' => esc_html__('Item Border Radius', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .primekit-modern-single-post-style4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'primekit_modern_post_grid_style' => ['style4', 'style5'],
				],
			]
		);
		// Padding control for item
		$this->add_control(
			'item_padding',
			[
				'label' => esc_html__('Item Padding', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .primekit-modern-single-post-style4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'primekit_modern_post_grid_style' => ['style4', 'style5'],
				],
			]
		);

		// Typography control for title
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Title Typography', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-modren-single-post-title h3, {{WRAPPER}} .primekit-modren-style2-post-title h3, {{WRAPPER}} .primekit-modren-single-post-title h3 a',
			]
		);
		// Color control for title
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-single-post-title h3 a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .primekit-modren-style2-post-title a' => 'color: {{VALUE}};',
				],
			]
		);
		// Color control for title
		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__('Title Hover Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-single-post-title h3:hover a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .primekit-modren-style2-post-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		// Control for icon size
		$this->add_control(
			'meta_icon_size',
			[
				'label' => esc_html__('Meta Icon Size', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-single-post-info li span' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .primekit-modren-style2-post-info span' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'post_meta_switch' => 'true',
				],
			]
		);
		// Color control for icon
		$this->add_control(
			'meta_icon_color',
			[
				'label' => esc_html__('Meta Icon Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-single-post-info li span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .primekit-modren-style2-post-info span' => 'color: {{VALUE}};',
				],
				'condition' => [
					'post_meta_switch' => 'true',
				],
			]
		);
		// Color control for info text
		$this->add_control(
			'meta_text_color',
			[
				'label' => esc_html__('Meta Text Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-single-post-info li a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .primekit-modren-style2-post-info a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'post_meta_switch' => 'true',
				],
			]
		);
		// Typography control for info text
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => esc_html__('Meta Typography', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-modren-single-post-info li a, {{WRAPPER}} .primekit-modren-style2-post-info a',
				'condition' => [
					'post_meta_switch' => 'true',
				],
			]
		);

		$this->end_controls_section();//end  style section


		// Start category style
		$this->start_controls_section(
			'category_style_section',
			[
				'label' => esc_html__('Category', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_category' => 'true',
					'post_types' => 'post',
				],
			]
		);

		$this->add_control(
			'category_random_color_switch',
			[
				'label' => esc_html__('Use Random Color?', 'primekit-addons'),
				'description' => esc_html__('Use Random Color for Category Background color', 'primekit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'primekit-addons'),
				'label_off' => esc_html__('No', 'primekit-addons'),
				'return_value' => 'true',
				'default' => 'false',
			]
		);

		// Typography control for info text
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'label' => esc_html__('Typography', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-modren-style2-post-cat a, {{WRAPPER}} .primekit-modern-sps4-category a',
			]
		);

		$this->add_control(
			'category_padding',
			[
				'label' => esc_html__('Padding', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-style2-post-cat a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .primekit-modern-sps4-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'category_border',
				'label' => esc_html__('Border', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-modren-style2-post-cat a, {{WRAPPER}} .primekit-modern-sps4-category a',
			]
		);

		$this->add_control(
			'category_border_radius',
			[
				'label' => esc_html__('Border Radius', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-style2-post-cat a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .primekit-modern-sps4-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin control
		$this->add_responsive_control(
			'category_margin',
			[
				'label' => esc_html__('Margin', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-style2-post-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .primekit-modern-sps4-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Start category style tabs
		$this->start_controls_tabs('style_tabs');

		// Start normal tab
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Normal', 'primekit-addons'),
			]
		);

		// Text color control
		$this->add_control(
			'category_text_color',
			[
				'label' => esc_html__('Text Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-style2-post-cat a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .primekit-modern-sps4-category a' => 'color: {{VALUE}};',
				],
			]
		);
		// Background color control
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'category_background',
				'label' => esc_html__('Background', 'primekit-addons'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .primekit-modren-style2-post-cat a, {{WRAPPER}} .primekit-modern-sps4-category a',
				'condition' => [
					'category_random_color_switch!' => 'true',
				],
			]
		);


		$this->end_controls_tab(); //end normal tab

		// Start hover tab
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__('Hover', 'primekit-addons'),
			]
		);

		// Text color control
		$this->add_control(
			'category_text_color_hover',
			[
				'label' => esc_html__('Text Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-style2-post-cat a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .primekit-modern-sps4-category a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		// Background color control
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'category_background_hover',
				'label' => esc_html__('Background', 'primekit-addons'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .primekit-modren-style2-post-cat a:hover, {{WRAPPER}} .primekit-modern-sps4-category a:hover',
				'condition' => [
					'category_random_color_switch!' => 'true',
				],
			]
		);
		$this->end_controls_tab(); //end hover tab

		$this->end_controls_tabs(); //end tabs

		$this->end_controls_section();//end style section


		// Start thumbnail style
		$this->start_controls_section(
			'thumbnail_style_section',
			[
				'label' => esc_html__('Thumbnail', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Thumbnail border radius
		$this->add_responsive_control(
			'thumbnail_border_radius',
			[
				'label' => esc_html__('Border Radius', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .primekit-modren-single-post .primekit-modren-single-post-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .primekit-modren-single-post-contents' => 'border-radius: 0 0 {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .primekit-modren-single-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .primekit-modren-posts-styl2-wrapper > .primekit-modren-style2-single-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .primekit-modren-style2-post-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .primekit-modern-post-style4-wrapper .primekit-modren-sps4-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .primekit-modern-post-style5-wrapper .primekit-modren-sps4-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); //end thumbnail style section

	}
	private function generate_random_color()
	{
		return sprintf('#%06X', wp_rand(0, 0xFFFFFF));
	}

	/**
	 * Render the widget output on the frontend.
	 */
	protected function render()
	{
		include 'renderview.php';
	}
}