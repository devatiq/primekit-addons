<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\WooCommerce\ProductShortDesc;

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
		return 'primekit-wc-product-short-desc';
	}
	
	public function get_title()
	{
		return esc_html__('Product Short Description', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-product-description primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-wc-category'];
	}
	
	public function get_keywords()
	{
		return ['PrimeKit', 'product', 'summary', 'short', 'description'];
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
			'primekit_elementor_wc_product_short_desc',
			[
				'label' => esc_html__( 'Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Alignment
		$this->add_responsive_control(
			'primekit_elementor_wc_product_short_desc_align',
			[
				'label' => esc_html__( 'Alignment', 'primekit-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'primekit-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'primekit-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'primekit-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],				
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-short-desc' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_wc_product_short_desc_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#555555',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-product-short-desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_wc_product_short_desc_typography',
				'label' => esc_html__( 'Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-wc-product-short-desc',
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