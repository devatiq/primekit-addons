<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\WooCommerce\ProductTitle;

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
		return 'primekit-product-wc-title';
	}
	
	public function get_title()
	{
		return esc_html__('Product Title', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-product-title primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-wc-category'];
	}
	
	public function get_keywords()
	{
		return ['PrimeKit', 'product', 'title', 'product title'];
	}
	
	public function get_style_depends()
	{
		return ['primekit-woocommerce-style'];
	}
	

	protected function register_controls() {
		//Template
		$this->start_controls_section(
			'primekit_elementor_product_wc_title',
			[
				'label' => esc_html__( 'Settings', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		//Heading tag
        $this->add_control(
            'primekit_elementor_product_wc_title_tag',
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
			'primekit_elementor_product_wc_title_align',
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
					'{{WRAPPER}} .primekit-elementor-product-wc-title-area' => 'text-align: {{VALUE}}',
				],
			]
		);
		

		$this->end_controls_section();

        //Abc post title style
		
        $this->start_controls_section(
            'primekit_elementor_product_wc_title_style',
            [
                'label' => esc_html__('Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'primekit_elementor_product_wc_title_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#999999',
				'selectors' => [
					'{{WRAPPER}} .primekit-product-wc-title-tag' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_product_wc_title_typography',
				'label' => esc_html__( 'Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-product-wc-title-tag',
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