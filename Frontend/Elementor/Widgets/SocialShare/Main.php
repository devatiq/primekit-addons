<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\SocialShare;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-social-share';
	}
	
	public function get_title()
	{
		return esc_html__('Social Share', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-share primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-category'];
	}
	
	public function get_keywords()
	{
		return ['PrimeKit', 'social', 'share', 'icon'];
	}
	
	/**
	 * Register list widget controls.
	 */
	protected function register_controls() {
		//Template
		$this->start_controls_section(
			'primekit-elementor-social-share-content',
			[
				'label' => esc_html__( 'Social Share', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Icon Alignment
		$this->add_responsive_control(
			'primekit_elementor_social_share_align',
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
					'{{WRAPPER}} .primekit-elementor-social-share-area' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
            'primekit_elementor_single_share_icon_show',
            [
                'label' => esc_html__('Share icon at the beginning', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		$this->add_control(
            'primekit_elementor_single_share_icon_mob_show',
            [
                'label' => esc_html__('Hide Share icon on mobile?', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'label_off',
				'condition' => [
					'primekit_elementor_single_share_icon_show' => 'yes'
				],
            ]
        );
		

		$this->end_controls_section();

        //primekit social icon style

		
        $this->start_controls_section(
            'primekit_elementor_social_share_style',
            [
                'label' => esc_html__('Social Icon Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'primekit_elementor_social_share_single_icon_color',
			[
				'label' => esc_html__( 'Share Icon Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#3d3d3d',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area li.primekit-single-share svg, .primekit-elementor-social-share-area li:hover.primekit-single-share svg' => 'fill: {{VALUE}} !important',
				],

				'condition' => [
					'primekit_elementor_single_share_icon_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'primekit_elementor_single_share_icon_size',
			[
				'label' => esc_html__( 'Share Icon Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area li.primekit-single-share svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}} !important;',
				],

				'condition' => [
					'primekit_elementor_single_share_icon_show' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'primekit_elementor_single_share_icon_position',
			[
				'label' => esc_html__( 'Share Icon Position', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area li.primekit-single-share svg' => 'top: {{SIZE}}{{UNIT}} !important;',
				],

				'condition' => [
					'primekit_elementor_single_share_icon_show' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'primekit_elementor_single_share_icon_gap',
			[
				'label' => esc_html__( 'Share Icon Gap', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 7,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area li.primekit-single-share' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
				],

				'condition' => [
					'primekit_elementor_single_share_icon_show' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'primekit_elementor_social_share_icon_size',
			[
				'label' => esc_html__( 'Social Icons Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area ul li svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'primekit_elementor_social_share_icon_position',
			[
				'label' => esc_html__( 'Social Icons Position', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area li svg' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'primekit_elementor_social_icons_gap',
			[
				'label' => esc_html__( 'Social Icons Gap', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area li' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'primekit_elementor_social_share_icon_bg_size',
			[
				'label' => esc_html__( 'Icons background Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 150,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area ul li a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs(
			'primekit_elementor_social_share_icon_color_tabs'
		);

		$this->start_controls_tab(
			'primekit_elementor_social_share_icon_color_tab_normal',
			[
				'label' => esc_html__( 'Normal', 'primekit-addons' ),
			]
		);

		$this->add_control(
			'primekit_elementor_social_share_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area ul li svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_social_share_icon_bg_color',
			[
				'label' => esc_html__( 'Icon Background Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#59a818',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area ul li a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'primekit_elementor_social_share_icon_color_tab_hover',
			[
				'label' => esc_html__( 'Hover', 'primekit-addons' ),
			]
		);

		$this->add_control(
			'primekit_elementor_social_share_icon_color_hover',
			[
				'label' => esc_html__( 'Icon Hover Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area ul li:hover svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_social_share_icon_bg_color_hover',
			[
				'label' => esc_html__( 'Icon Hover Background Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#3d3d3d',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-social-share-area ul li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
        $this->end_controls_section();

    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'RenderView.php';
    }
}