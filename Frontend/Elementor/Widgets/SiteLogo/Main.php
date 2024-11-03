<?php
namespace PrimeKit\Frontend\Elementor\Widgets\SiteLogo;

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
	public function get_name()
	{
		return 'primekit-site-logo';
	}

	public function get_title()
	{
		return esc_html__('Site Logo', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-logo primekit-addons-icon';
	}

	public function get_categories()
	{
		return ['primekit-category'];
	}

	public function get_keywords()
	{
		return ['prime', 'logo', 'site'];
	}

    protected function register_controls() {
        $this->start_controls_section(
            'primekit-elementor-site-logo-content',
            [
                'label' => esc_html__( 'Contents', 'primekit-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //Custom Logo Switch
        $this->add_control(
			'primekit-elementor-site-logo-custom-switch',
			[
				'label' => esc_html__( 'Custom Logo', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'custom_on' => esc_html__( 'Yes', 'primekit-addons' ),
				'custom_off' => esc_html__( 'No', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'custom_off',
			]
		);

        //Custom Logo
        $this->add_control(
			'primekit-elementor-site-logo-custom-image',
			[
				'label' => esc_html__( 'Choose Logo', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'primekit-elementor-site-logo-custom-switch' => 'yes'
                ],
			]
		);

        //URL
        $this->add_control(
			'primekit-elementor-site-logo-link',
			[
				'label' => esc_html__( 'Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => false,
				],
				'label_block' => true,
			]
		);

        //Alignment
		$this->add_responsive_control(
			'primekit-elementor-site-logo-align',
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
					'{{WRAPPER}} .primekit-elementor-site-logo-area' => 'text-align: {{VALUE}}',
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

        $this->end_controls_section();//end content

        //Style Tab
        $this->start_controls_section(
            'primekit-elementor-site-logo-style',
            [
                'label' => esc_html__( 'Logo Style', 'primekit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //width
        $this->add_control(
			'primekit-elementor-site-logo-width',
			[
				'label' => esc_html__( 'Logo Width', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 250,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-site-logo-area img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        //Spacing
        $this->add_control(
			'primekit-elementor-site-logo-spacing',
			[
				'label' => esc_html__( 'Spacing', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-site-logo-area img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        //Border
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit-elementor-site-logo-border',
                'label' => esc_html__( 'Logo Border', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-site-logo-area img',
			]
		);

         //Border Radius
         $this->add_control(
			'primekit-elementor-site-logo-border-radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-site-logo-area img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();//end style
    }

    protected function render() {      
		include 'renderview.php';
    }
}