<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\SectionTitle;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-section-title';
	}
	
	public function get_title()
	{
		return esc_html__('Section Title', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-post-title primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-category'];
	}
	
	public function get_keywords()
	{
		return ['section', 'PrimeKit', 'title', 'dual title', 'section title', 'PrimeKit section title', 'PrimeKit dual title'];
	}
	


	/**
	 * Register list widget controls.
	 */
	protected function register_controls() {
		//Template
		$this->start_controls_section(
			'primekit-elementor-section-title-box',
			[
				'label' => esc_html__( 'Title Content', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Heading tag

        $this->add_control(
            'primekit_elementor_sec_title_tag',
            [
                'label' => esc_html__('Heading Tag', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
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

		//Title part one
		$this->add_control(
			'primekit_elementor_sec_title_one',
			[
				'label' => esc_html__( 'Title Part 1', 'primekit-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Responsive', 'primekit-addons' ),
				'placeholder' => esc_html__( 'Type your section Title Firt Part', 'primekit-addons' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);
        
		//Title part two
		$this->add_control(
			'primekit_elementor_sec_title_two',
			[
				'label' => esc_html__( 'Title Part 2', 'primekit-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Design', 'primekit-addons' ),
				'placeholder' => esc_html__( 'Type your section Title Second Part', 'primekit-addons' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);
        
		//Divider show/hide
        $this->add_control(
            'primekit_elementor_sec_title_div',
            [
                'label' => esc_html__('Bottom Divider', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

         
		//Divider Width
		$this->add_responsive_control(
            'primekit_elementor_sec_title_div_size',
            [
                'label' => esc_html__('Divider Width', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
                'range' => [
					'px' => [
						'min' => 20,
						'max' => 500,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 120,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-sec-title-divider' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_sec_title_div' => 'yes',
				],
            
            ]
        );

		//Divider height
		$this->add_responsive_control(
            'primekit_elementor_sec_title_div_height',
            [
                'label' => esc_html__('Divider Height', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
                'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-sec-title-divider' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_sec_title_div' => 'yes',
				],
            
            ]
        );

		//Divider Gap
		$this->add_responsive_control(
            'primekit_elementor_sec_title_div_gap',
            [
                'label' => esc_html__('Divider Gap', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
                'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -5,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-sec-title-divider' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_sec_title_div' => 'yes',
				],
            
            ]
        );

		//Title Alignment

		$this->add_responsive_control(
			'primekit_elementor_sec_title_align',
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
					'{{WRAPPER}} .primekit-elementor-title-align' => 'text-align: {{VALUE}}',
				],
			]
		);
		

		$this->end_controls_section();

        //section title style
		
        $this->start_controls_section(
            'primekit_elementor_sec_title_style',
            [
                'label' => esc_html__('Title Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'primekit_elementor_sec_title_one_color',
			[
				'label' => esc_html__( 'Title Part 1 Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-sec-title-one' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_sec_title_one_typography',
				'label' => esc_html__( 'Title Part 1 Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-sec-title-one',
			]
		);

		$this->add_control(
			'primekit_elementor_sec_title_two_color',
			[
				'label' => esc_html__( 'Title Part 2 Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#458f0c',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-sec-title-two' => 'color: {{VALUE}}',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_sec_title_two_typography',
				'label' => esc_html__( 'Title Part 2 Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-sec-title-two',
			]
		);

        //end of title style
        $this->end_controls_section();


		$this->start_controls_section(
            'primekit_elementor_sec_title_div_bg_styly',
            [
                'label' => esc_html__('Divider Background', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'primekit_elementor_sec_title_div' => 'yes',
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'primekit_elementor_sec_div_bg_color',
				'label' => esc_html__( 'Divider Color', 'primekit-addons' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .primekit-elementor-sec-title-divider',
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
        include 'RenderView.php';
    }
}