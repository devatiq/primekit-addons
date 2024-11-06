<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\WooCommerce\ProductCartIcon;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor List Widget.
 * @since 1.0.0
 */
class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-wc-cart-icon';
	}
	
	public function get_title()
	{
		return esc_html__('Cart Icon', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-cart-medium primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-wc-category'];
	}
	
	public function get_keywords()
	{
		return ['PrimeKit', 'product', 'cart'];
	}
	
	public function get_script_depends()
	{
		return ['primekit-cart-count-update'];
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
			'primekit_elementor_wc_product_cart_icon',
			[
				'label' => esc_html__( 'Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Icon Size
		$this->add_responsive_control(
			'primekit_elementor_wc_product_cart_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-icon .primekit-cart-contents .eicon-cart-solid' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Icon Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-icon .primekit-cart-contents .eicon-cart-solid' => 'color: {{VALUE}}',
				],
			]
		);

		//Icon Hover Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_icon_hov_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#873ff0',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-icon:hover .primekit-cart-contents .eicon-cart-solid' => 'color: {{VALUE}}',
				],
			]
		);

		//Counter
        $this->add_control(
            'primekit_elementor_wc_product_cart_count_switch',
            [
                'label' => esc_html__('Display Counter?', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		//Count BG Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_count_bg_color',
			[
				'label' => esc_html__( 'Counter BG Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#873ff0',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-icon .primekit-cart-contents .primekit-cart-contents-count' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_wc_product_cart_count_switch' => 'yes',
				],
			]
		);

		//Count BG Hover Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_count_bg_hover_color',
			[
				'label' => esc_html__( 'Counter BG Hover Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#005ab4',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-icon:hover .primekit-cart-contents .primekit-cart-contents-count' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_wc_product_cart_count_switch' => 'yes',
				],
			]
		);

		//Number Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_count_color',
			[
				'label' => esc_html__( 'Number Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-icon .primekit-cart-contents .primekit-cart-contents-count' => 'color: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_wc_product_cart_count_switch' => 'yes',
				],
			]
		);

		//Number Hover Color
		$this->add_control(
			'primekit_elementor_wc_product_cart_count_hov_color',
			[
				'label' => esc_html__( 'Number Hover Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-cart-icon:hover .primekit-cart-contents .primekit-cart-contents-count' => 'color: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_wc_product_cart_count_switch' => 'yes',
				],
			]
		);

		//Count Size
		$this->add_responsive_control(
				'primekit_elementor_wc_product_cart_count_size',
				[
					'label' => esc_html__( 'Counter Size', 'primekit-addons' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px'],
					'range' => [
						'px' => [
							'min' => 5,
							'max' => 60,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 20,
					],
					'selectors' => [
						'{{WRAPPER}} .primekit-elementor-wc-cart-icon .primekit-cart-contents .primekit-cart-contents-count' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'primekit_elementor_wc_product_cart_count_switch' => 'yes',
					],
				]
			);

		//Count font Size
		$this->add_responsive_control(
				'primekit_elementor_wc_product_cart_count_font_size',
				[
					'label' => esc_html__( 'Number Font Size', 'primekit-addons' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px'],
					'range' => [
						'px' => [
							'min' => 8,
							'max' => 40,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 12,
					],
					'selectors' => [
						'{{WRAPPER}} .primekit-elementor-wc-cart-icon .primekit-cart-contents .primekit-cart-contents-count' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'primekit_elementor_wc_product_cart_count_switch' => 'yes',
					],
				]
			);

		//Counter position
		$this->add_responsive_control(
				'primekit_elementor_wc_product_cart_count_pos',
				[
					'label' => esc_html__( 'Counter Position', 'primekit-addons' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px'],
					'range' => [
						'px' => [
							'min' => -30,
							'max' => 30,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => -10,
					],
					'selectors' => [
						'{{WRAPPER}} .primekit-elementor-wc-cart-icon .primekit-cart-contents .primekit-cart-contents-count' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'primekit_elementor_wc_product_cart_count_switch' => 'yes',
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