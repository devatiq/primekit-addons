<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\WooCommerce\ProductImg;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class Main extends Widget_base {

	public function get_name()
	{
		return 'primekit-wc-featured-image';
	}
	
	public function get_title()
	{
		return esc_html__('Product Image', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-product-images primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-wc-category'];
	}
	
	public function get_keywords()
	{
		return ['PrimeKit', 'product', 'image', 'product image'];
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
            'primekit_elementor_wc_product_img_style',
            [
                'label' => esc_html__('Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		//Sales Flash
        $this->add_control(
            'primekit_elementor_wc_product_sales_switch',
            [
                'label' => esc_html__('Display Sales Flash?', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		//Sales Flash Size
		$this->add_responsive_control(
            'primekit_elementor_wc_product_sales_size',
            [
                'label' => esc_html__('Sales Flash Size', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
                'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-img-area span.onsale' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_wc_product_sales_switch' => 'yes',
				],
            ]
        );

		//Flash Typograhy
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_sales_typography',
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-product-img-area span.onsale',
				'condition' => [
					'primekit_elementor_wc_product_sales_switch' => 'yes',
				],
			]
		);

		//Flash Color
		$this->add_control(
			'primekit_elementor_wc_product_sales_color',
			[
				'label' => esc_html__( 'Flash Text Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-img-area span.onsale' => 'color: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_wc_product_sales_switch' => 'yes',
				],
			]
		);

		//Flash BG Color
		$this->add_control(
			'primekit_elementor_wc_product_sales_bg_color',
			[
				'label' => esc_html__( 'Flash BG Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6841ef',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-img-area span.onsale' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_wc_product_sales_switch' => 'yes',
				],
			]
		);

		//Sales Flash
        $this->add_control(
            'primekit_elementor_wc_product_zoom_icon_switch',
            [
                'label' => esc_html__('Display Magnify icon?', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
            'primekit_elementor_wc_product_img_single_style',
            [
                'label' => esc_html__('Product Image Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_img_border',
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-product-img-area .woocommerce-product-gallery__image img',
			]
		);

		$this->add_control(
			'primekit_elementor_wc_product_img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-img-area .woocommerce-product-gallery__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'primekit_elementor_wc_product_img_gallery_style',
            [
                'label' => esc_html__('Gallery Image Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_gal_img_border',
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-product-img-area .flex-control-nav.flex-control-thumbs li img',
			]
		);

		$this->add_control(
			'primekit_elementor_wc_product_gal_img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-img-area .flex-control-nav.flex-control-thumbs li img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    }

    /**
     * Render the widget output on the frontend.
	 * */

    protected function render()
    {
        include 'renderview.php';
    }
}