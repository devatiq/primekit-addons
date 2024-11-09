<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\WooCommerce\ProductTabs;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Elementor List Widget.
 * @since 1.0.0
 */
class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-wc-product-tabs';
	}
	
	public function get_title()
	{
		return esc_html__('Product Tabs', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-product-tabs primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-wc-category'];
	}
	
	public function get_keywords()
	{
		return ['PrimeKit', 'product', 'tabs'];
	}
	
	public function get_style_depends()
	{
		return ['primekit-woocommerce-style'];
	}
	
	/**
	 * Register list widget controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'primekit_elementor_wc_product_tabs_style',
			[
				'label' => esc_html__( 'Tabs Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Notice
		$this->add_control(
			'primekit_wc_style_warning',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__("Sometimes, the appearance of this widget might be influenced by the theme and other plugins you're using. If you're having trouble with how it looks, a good first step is to try using a simpler theme and turning off any related plugins.", 'primekit-addons'),
				'content_classes' => 'primekit-elementor-wc-product-tabs-info-message',
			]
		);

		//Typoghraphy
		$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'primekit_elementor_wc_product_tabs_typography',
					'label' => esc_html__( 'Typography', 'primekit-addons' ),
					'selector' => '{{WRAPPER}} .primekit-elementor-wc-product-tabs ul.tabs li a',
				]
			);

		$this->start_controls_tabs(
			'primekit_elementor_wc_product_tabs_style_tabs'
		);

		$this->start_controls_tab(
			'primekit_elementor_wc_product_tabs_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'primekit-addons' ),
			]
		);

		//Tabs Color
		$this->add_control(
			'primekit_elementor_wc_product_tabs_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-tabs ul.tabs li a' => 'color: {{VALUE}}',
				],
			]
		);

		//Background Color
		$this->add_control(
			'primekit_elementor_wc_product_tabs_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#f5f5f5',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-tabs ul.tabs li a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'primekit_elementor_wc_product_tabs_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'primekit-addons' ),
			]
		);

		//Tabs Hover Color
		$this->add_control(
			'primekit_elementor_wc_product_tabs_hover_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-tabs ul.tabs li:hover a' => 'color: {{VALUE}}',
				],
			]
		);

		//Hover Background Color
		$this->add_control(
			'primekit_elementor_wc_product_tabs_bg_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#eeeeee',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-tabs ul.tabs li:hover a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'primekit_elementor_wc_product_tabs_style_active_tab',
			[
				'label' => esc_html__( 'Active', 'primekit-addons' ),
			]
		);

		//Tabs Active Color
		$this->add_control(
			'primekit_elementor_wc_product_tabs_active_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-tabs ul.tabs li.active a' => 'color: {{VALUE}}',
				],
			]
		);

		//Active Background Color
		$this->add_control(
			'primekit_elementor_wc_product_tabs_bg_active_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-tabs ul.tabs li.active a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();


		$this->start_controls_section(
			'primekit_elementor_wc_product_tabs_panel_style',
			[
				'label' => esc_html__( 'Panel Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Title Typoghraphy
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_panel_title_typography',
				'label' => esc_html__( 'Title Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-product-tabs .woocommerce-Tabs-panel h2',
			]
		);

		//Panel Title Color
		$this->add_control(
			'primekit_elementor_wc_product_tabs_panel_title_color',
			[
				'label' => esc_html__( 'Title Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-tabs .woocommerce-Tabs-panel h2' => 'color: {{VALUE}}',
				],
			]
		);

		//Content Typoghraphy
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_panel_content_typography',
				'label' => esc_html__( 'Content Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-product-tabs .woocommerce-Tabs-panel',
			]
		);

		//Content Color
		$this->add_control(
			'primekit_elementor_wc_product_tabs_panel_content_color',
			[
				'label' => esc_html__( 'Content Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-tabs .woocommerce-Tabs-panel' => 'color: {{VALUE}}',
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