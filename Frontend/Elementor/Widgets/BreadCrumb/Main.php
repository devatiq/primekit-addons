<?php
namespace PrimeKit\Frontend\Elementor\Widgets\BreadCrumb;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
	public function get_name()
	{
		return 'primekit-bread-crumb';
	}

	public function get_title()
	{
		return esc_html__('BreadCrumb', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-post-navigation primekit-addons-icon';
	}
	public function get_categories()
	{
		return ['primekit-category'];
	}
	public function get_keywords()
	{
		return ['prime', 'bread', 'crumb', 'breadcrumb'];
	}

	/**
	 * Register list widget controls.
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'primekit-elementor-bread-crumb',
			[
				'label' => esc_html__( 'Alignment', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Alignment
		$this->add_responsive_control(
			'primekit_elementor_bread_crumb_align',
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
					'{{WRAPPER}} .primekit-elementor-bread-crumb-area' => 'text-align: {{VALUE}}',
				],
			]
		);

		//PrimeKit Notice
		$this->add_control(
			'primekit_elementor_addons_notice',
			[
				'type' => \Elementor\Controls_Manager::NOTICE,
				'notice_type' => 'warning',
				'dismissible' => false,
				'heading' => esc_html__('Created by PrimeKit', 'primekit-addons'),
				'content' => esc_html__('This amazing widget is built with PrimeKit Addons, making it super easy to create beautiful and functional designs.', 'primekit-addons'),
			]
		);

		$this->end_controls_section();

        //Bread Crumb style
		
        $this->start_controls_section(
            'primekit_elementor_bread_crumb_style',
            [
                'label' => esc_html__('Crumb Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'primekit_elementor_bread_crumb_text_color',
			[
				'label' => esc_html__( 'Text Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#bbbcbd',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-bread-crumb-area' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'primekit_elementor_bread_crumb_link_color',
			[
				'label' => esc_html__( 'Link Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#bbbcbd',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-bread-crumb-area a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'primekit_elementor_bread_crumb_link_hover_color',
			[
				'label' => esc_html__( 'Link Hover Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#5D5AED',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-bread-crumb-area a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_bread_crumb_typography',
				'label' => esc_html__( 'Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-bread-crumb-area',
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
        //load render view to show widget output on frontend/website.
        include 'renderview.php';
    }
}