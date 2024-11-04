<?php 

namespace PrimeKit\Frontend\Elementor\Widgets\FeturedImg;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-featured-image';
	}
	
	public function get_title()
	{
		return esc_html__('Featured Image', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-image primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-category'];
	}
	
	public function get_keywords()
	{
		return ['prime', 'featured', 'image', 'featured image'];
	}


	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		//Template
		$this->start_controls_section(
			'primekit-elementor-fearture-img',
			[
				'label' => esc_html__( 'Image Alignment', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Alignment
		$this->add_responsive_control(
			'primekit_feature_img_align',
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
					'{{WRAPPER}} .primekit-elementor-feat-img-area' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();

		//Style Section
		$this->start_controls_section(
            'primekit-elementor-fearture-img-style',
            [
                'label' => esc_html__('Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		//image Width
		$this->add_responsive_control(
            'primekit-elementor-fearture-img-size',
            [
                'label' => esc_html__('Image Width', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%'],
                'range' => [
					'px' => [
						'min' => 10,
						'max' => 1000,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-feat-img-area img' => 'width: {{SIZE}}{{UNIT}};',
				],
            
            ]
        );

		//image border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit-elementor-fearture-img-border',
				'selector' => '{{WRAPPER}} .primekit-elementor-feat-img-area img',
			]
		);

		//image border radius
		$this->add_control(
			'primekit-elementor-fearture-img-border-radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-feat-img-area img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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