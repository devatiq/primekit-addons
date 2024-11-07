<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\WooCommerce\ProductMeta;

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
		return 'primekit-wc-product-meta';
	}
	
	public function get_title()
	{
		return esc_html__('Product Meta', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-product-meta primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-wc-category'];
	}
	
	public function get_keywords()
	{
		return ['PrimeKit', 'product', 'meta'];
	}
	
	public function get_style_depends()
	{
		return ['primekit-woocommerce-style'];
	}
	

	/**
	 * Register list widget controls.
	 */
	protected function register_controls() {
		//Template
		$this->start_controls_section(
			'primekit_elementor_wc_product_meta',
			[
				'label' => esc_html__( 'Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//SKU
        $this->add_control(
            'primekit_elementor_wc_product_meta_sku_switch',
            [
                'label' => esc_html__('Display SKU?', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		//Category
        $this->add_control(
            'primekit_elementor_wc_product_meta_category_switch',
            [
                'label' => esc_html__('Display Category?', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		//Tags
        $this->add_control(
            'primekit_elementor_wc_product_meta_tags_switch',
            [
                'label' => esc_html__('Display Tags?', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		//Divider
        $this->add_control(
            'primekit_elementor_wc_product_meta_div_switch',
            [
                'label' => esc_html__('Display Divider?', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		//SKU Color
		$this->add_control(
			'primekit_elementor_wc_product_meta_sku_color',
			[
				'label' => esc_html__( 'SKU Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-meta .primekit-product-sku' => 'color: {{VALUE}}',
				],

				'condition' => [
					'primekit_elementor_wc_product_meta_sku_switch' => 'yes',
				],
			]
		);

		//SKU typoghraphy
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_meta_sku_typography',
				'label' => esc_html__( 'SKU Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-product-meta .primekit-product-sku',
				'condition' => [
					'primekit_elementor_wc_product_meta_sku_switch' => 'yes',
				],
			]
		);

		//Category Color
		$this->add_control(
			'primekit_elementor_wc_product_meta_cat_color',
			[
				'label' => esc_html__( 'Category Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-meta .primekit-product-categories, {{WRAPPER}} .primekit-elementor-wc-product-meta .primekit-product-categories a' => 'color: {{VALUE}}',
				],

				'condition' => [
					'primekit_elementor_wc_product_meta_category_switch' => 'yes',
				],
			]
		);

		//Category typoghraphy
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_meta_cat_typography',
				'label' => esc_html__( 'Category Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-product-meta .primekit-product-categories',
				'condition' => [
					'primekit_elementor_wc_product_meta_category_switch' => 'yes',
				],
			]
		);

		//Tags Color
		$this->add_control(
			'primekit_elementor_wc_product_meta_tag_color',
			[
				'label' => esc_html__( 'Tags Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-meta .primekit-product-tags, {{WRAPPER}} .primekit-elementor-wc-product-meta .primekit-product-tags a' => 'color: {{VALUE}}',
				],

				'condition' => [
					'primekit_elementor_wc_product_meta_tags_switch' => 'yes',
				],
			]
		);

		//Tags typoghraphy
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_meta_tag_typography',
				'label' => esc_html__( 'Tags Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-product-meta .primekit-product-tags',
				'condition' => [
					'primekit_elementor_wc_product_meta_tags_switch' => 'yes',
				],
			]
		);

		//Tags Color
		$this->add_control(
			'primekit_elementor_wc_product_meta_div_color',
			[
				'label' => esc_html__( 'Divider Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#e6e6e6',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-meta .primekit-meta-divider' => 'background-color: {{VALUE}}',
				],

				'condition' => [
					'primekit_elementor_wc_product_meta_div_switch' => 'yes',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_wc_product_meta_div_space',
			[
				'label' => esc_html__( 'Divider Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-meta .primekit-meta-divider' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
				],

				'condition' => [
					'primekit_elementor_wc_product_meta_div_switch' => 'yes',
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