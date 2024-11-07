<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\WooCommerce\ProductCartPage;

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
		return 'primekit-wc-cart-page';
	}
	
	public function get_title()
	{
		return esc_html__('Cart Page', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-woo-cart primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-wc-category'];
	}
	
	public function get_keywords()
	{
		return ['PrimeKit', 'woo', 'cart'];
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
			'primekit_elementor_wc_product_cart_page_notice_style',
			[
				'label' => esc_html__( 'Notice Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Border Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_notice_border_color',
			[
				'label' => esc_html__( 'Border Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#6f45ed',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce-message' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce-message::before' => 'color: {{VALUE}}',
				],
			]
		);

		//Background Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_notice_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#f6f5f8',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce-message' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_notice_text_color',
			[
				'label' => esc_html__( 'Text Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce-message' => 'color: {{VALUE}}',
				],
			]
		);

		//typoghraphy
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_cart_page_notice_text_typography',
				'label' => esc_html__( 'Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce-message',
			]
		);

        $this->end_controls_section();

		//Cart Total
		$this->start_controls_section(
			'primekit_elementor_wc_product_cart_page_cart_total_style',
			[
				'label' => esc_html__( 'Cart Total Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//title typoghraphy
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_cart_page_cart_total_typography',
				'label' => esc_html__( 'Title Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce .cart-collaterals .cart_totals h2',
			]
		);

		//Title Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_cart_total_color',
			[
				'label' => esc_html__( 'Title Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce .cart-collaterals .cart_totals h2' => 'color: {{VALUE}}',
				],
			]
		);

		//Button Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_total_btn_color',
			[
				'label' => esc_html__( 'Button Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce a.button.alt' => 'color: {{VALUE}}',
				],
			]
		);

		//Button BG Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_total_btn_bg_color',
			[
				'label' => esc_html__( 'Button BG Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#6f45ed',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce a.button.alt' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Button Hover Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_total_btn_hov_color',
			[
				'label' => esc_html__( 'Button Hover Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce a.button.alt:hover' => 'color: {{VALUE}}',
				],
			]
		);

		//Button BG Hover Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_total_btn_bg_hov_color',
			[
				'label' => esc_html__( 'Button BG Hover Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#2d4de5',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce a.button.alt:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		//button typoghraphy
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_cart_page_total_btn_typography',
				'label' => esc_html__( 'Button Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce a.button.alt',
			]
		);

		//border radius
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_total_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
					'top' => 10,
					'right' => 10,
					'bottom' => 10,
					'left' => 10,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce a.button.alt' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		//Table Form Style
		$this->start_controls_section(
			'primekit_elementor_wc_product_cart_page_form_style',
			[
				'label' => esc_html__( 'Table Form Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Header Bg
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_form_header_bg_color',
			[
				'label' => esc_html__( 'Header BG Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#6f45ed',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce-cart-form thead' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce-cart-form thead th' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Header Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_form_header_color',
			[
				'label' => esc_html__( 'Header Text Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce-cart-form thead' => 'color: {{VALUE}}',
				],
			]
		);

		//border Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_page_form_border_color',
			[
				'label' => esc_html__( 'Table Border Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.08)',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce table.shop_table, {{WRAPPER}} .primekit-elementor-wc-cart-page .woocommerce table.shop_table td' => 'border-color: {{VALUE}}',
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