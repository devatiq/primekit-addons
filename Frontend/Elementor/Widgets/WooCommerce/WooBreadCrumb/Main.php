<?php
namespace PrimeKit\Frontend\Elementor\Widgets\WooCommerce\WooBreadCrumb;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-product-bread-crumb';
	}
	
	public function get_title()
	{
		return esc_html__('Product Breadcrumb', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-product-breadcrumbs primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-wc-category'];
	}
	
	public function get_keywords()
	{
		return ['PrimeKit', 'product', 'crumb', 'breadcrumb'];
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
			'primekit-elementor-product-bread-crumb',
			[
				'label' => esc_html__( 'Alignment', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		//Alignment
		$this->add_responsive_control(
			'primekit_wc_elementor_product_bread_crumb_align',
			[
				'label' => esc_html__( 'Alignment', 'primekit-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
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
					'{{WRAPPER}} .primekit-elementor-product-bread-crumb-area' => 'text-align: {{VALUE}}',
				],
			]
		);
		

		$this->end_controls_section();

        //section title style
		
        $this->start_controls_section(
            'primekit_wc_elementor_product_bread_crumb_style',
            [
                'label' => esc_html__('Crumb Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'primekit_wc_elementor_product_bread_crumb_text_color',
			[
				'label' => esc_html__( 'Text Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#bbbcbd',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-product-bread-crumb-area' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'primekit_wc_elementor_product_bread_crumb_link_color',
			[
				'label' => esc_html__( 'Link Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#bbbcbd',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-product-bread-crumb-area a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'primekit_wc_elementor_product_bread_crumb_link_hover_color',
			[
				'label' => esc_html__( 'Link Hover Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#5D5AED',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-product-bread-crumb-area a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_wc_elementor_product_bread_crumb_typography',
				'label' => esc_html__( 'Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-product-bread-crumb-area',
			]
		);

		//end of breadcrumb style
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