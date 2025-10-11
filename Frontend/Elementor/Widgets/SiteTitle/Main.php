<?php
namespace PrimeKit\Frontend\Elementor\Widgets\SiteTitle;

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
	public function get_name()
	{
		return 'primekit-site-title';
	}

	public function get_title()
	{
		return esc_html__('Site Title', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-site-title primekit-addons-icon';
	}

	public function get_categories()
	{
		return ['primekit-category'];
	}

	public function get_keywords()
	{
		return ['prime', 'title', 'site', 'tagline'];
	}

    protected function register_controls() {
        $this->start_controls_section(
            'primekit-elementor-site-title-content',
            [
                'label' => esc_html__( 'Contents', 'primekit-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


		//Site Title Switch
		$this->add_control(
			'primekit-elementor-site-title-switch',
			[
				'label' => esc_html__( 'Display Site Title?', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'tagline_on' => esc_html__( 'Show', 'primekit-addons' ),
				'tagline_off' => esc_html__( 'Hide', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		//Heading tag
        $this->add_control(
            'primekit-elementor-site-title-tag',
            [
                'label' => esc_html__('Site Title Tag', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h1',
                'options' => [
                    'h1' => esc_html__('H1', 'primekit-addons'),
                    'h2' => esc_html__('H2', 'primekit-addons'),
                    'h3' => esc_html__('H3', 'primekit-addons'),
                    'h4' => esc_html__('H4', 'primekit-addons'),
                    'h5' => esc_html__('H5', 'primekit-addons'),
                    'h6' => esc_html__('H6', 'primekit-addons'),
                ],
				'condition' => [
					'primekit-elementor-site-title-switch' => 'yes'
				],
            
            ]
        );

        //Title Alignment
		$this->add_responsive_control(
			'primekit-elementor-site-title-align',
			[
				'label' => esc_html__( 'Title Alignment', 'primekit-addons'),
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
					'{{WRAPPER}} .primekit-ele-site-title' => 'text-align: {{VALUE}}',
				],
				'condition' => [
					'primekit-elementor-site-title-switch' => 'yes'
				],
			]
		);

		//Tagline Switch
		$this->add_control(
			'primekit-elementor-site-tagline-switch',
			[
				'label' => esc_html__( 'Display Tagline?', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'tagline_on' => esc_html__( 'Show', 'primekit-addons' ),
				'tagline_off' => esc_html__( 'Hide', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'tagline_off',
			]
		);

		//Tagline tag
        $this->add_control(
            'primekit-elementor-site-tagline-tag',
            [
                'label' => esc_html__('Tagline Tag', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__('H1', 'primekit-addons'),
                    'h2' => esc_html__('H2', 'primekit-addons'),
                    'h3' => esc_html__('H3', 'primekit-addons'),
                    'h4' => esc_html__('H4', 'primekit-addons'),
                    'h5' => esc_html__('H5', 'primekit-addons'),
                    'H6' => esc_html__('H6', 'primekit-addons'),
                ],
				'condition' => [
					'primekit-elementor-site-tagline-switch' => 'yes'
				],
            
            ]
        );

        //Title Alignment
		$this->add_responsive_control(
			'primekit-elementor-site-tagline-align',
			[
				'label' => esc_html__( 'Tagline Alignment', 'primekit-addons'),
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
					'{{WRAPPER}} .primekit-ele-site-tagline' => 'text-align: {{VALUE}}',
				],
				'condition' => [
					'primekit-elementor-site-tagline-switch' => 'yes'
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

		//Title Style
		$this->start_controls_section(
            'primekit-elementor-site-title-style',
            [
                'label' => esc_html__( 'Site Title Style', 'primekit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'primekit-elementor-site-title-switch' => 'yes'
				],
            ]
        );

		//color
		$this->add_control(
			'primekit-elementor-site-title-color',
			[
				'label' => esc_html__( 'Title Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-site-title' => 'color: {{VALUE}}',
				],
			]
		);

		//typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'primekit-elementor-site-title-typography',
				'selector' => '{{WRAPPER}} .primekit-ele-site-title',
			]
		);

		//spacing
		$this->add_control(
		'primekit-elementor-site-title-spacing',
		[
			'label' => esc_html__( 'Spacing', 'primekit-addons' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px' ],
			'default' => [
				'top' => 0,
				'right' => 0,
				'bottom' => 0,
				'left' => 0,
				'unit' => 'px',
				'isLinked' => false,
			],
			'selectors' => [
				'{{WRAPPER}} .primekit-ele-site-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

		$this->end_controls_section();//end site title style

		//Tagline Style
		$this->start_controls_section(
            'primekit-elementor-site-tagline-style',
            [
                'label' => esc_html__( 'Tagline Style', 'primekit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'primekit-elementor-site-tagline-switch' => 'yes'
				],
            ]
        );

		//color
		$this->add_control(
			'primekit-elementor-site-tagline-color',
			[
				'label' => esc_html__( 'Tagline Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#555555',
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-site-tagline' => 'color: {{VALUE}}',
				],
			]
		);

		//typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'primekit-elementor-site-tagline-typography',
				'selector' => '{{WRAPPER}} .primekit-ele-site-tagline',
			]
		);

			//spacing
			$this->add_control(
				'primekit-elementor-site-tagline-spacing',
				[
					'label' => esc_html__( 'Spacing', 'primekit-addons' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'default' => [
						'top' => 0,
						'right' => 0,
						'bottom' => 0,
						'left' => 0,
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .primekit-ele-site-tagline' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();//end tagline style
    }

    protected function render() {      
		include 'renderview.php';
    }
}