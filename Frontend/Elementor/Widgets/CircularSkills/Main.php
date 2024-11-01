<?php
namespace PrimeKit\Frontend\Elementor\Widgets\CircularSkills;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
    public function get_name()
	{
		return 'primekit-circular-skill';
	}

	public function get_title()
	{
		return esc_html__('Circular Skill', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-counter-circle primekit-addons-icon';
	}
	public function get_categories()
	{
		return ['primekit-category'];
	}
	public function get_keywords()
	{
		return ['prime', 'skill',  'circular'];
	}

    public function get_script_depends()
    {
        return ['primekit-jquery-appear', 'primekit-circular-progress', 'primekit-circular-skills']; 
    }
    
    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_circl_skill_setting',
            [
                'label' => esc_html__('Circle Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //circle skill text
        $this->add_control(
            'primekit_elementor_circl_skill_text',
            [
                'label' => esc_html__('Heading', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Web Design', 'primekit-addons'),
                'label_block' => true,
            ]
        );
        //circle skill percentage
        $this->add_control(
            'primekit_elementor_circl_skill_value',
            [
                'label' => esc_html__('Value', 'primekit-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 50,
                'min' => 0,
                'max' => 100,
                'step' => 1,
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

        //circle skill style
        $this->start_controls_section(
            'primekit_elementor_circl_skill_style_setting',
            [
                'label' => esc_html__('Circle Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // circle size
        $this->add_control(
			'primekit_elementor_circl_skill_size',
			[
				'label' => esc_html__( 'Circle Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
						'step' => 10,
					],
				],
				'default' => [
					'size' => 180,
				],

			]
		);

        // circle heading typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_circl_skill_heading_typography',
                'label' => esc_html__('Heading Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-skill-circle span',
            ]
        ); 
        // circle heading color
        $this->add_control(
            'primekit_elementor_circl_skill_heading_color',
            [
                'label' => esc_html__('Heading Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-circle span' => 'color: {{VALUE}}',
                ],
            ]
        );

        //Value Position
        // circle size
        $this->add_control(
			'primekit_elementor_circl_skill_value_position',
			[
				'label' => esc_html__( 'Value Position Adjustment', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
                    'unit' => '%',
					'size' => 35,
				],

                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-circle strong' => 'top: {{SIZE}}{{UNIT}}',
                ],

			]
		);

        // circle value typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_circl_skill_value_typography',
                'label' => esc_html__('Value Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-skill-circle strong',
            ]
        );
        // circle value color
        $this->add_control(
            'primekit_elementor_circl_skill_value_color',
            [
                'label' => esc_html__('Value Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-circle strong' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .primekit-ele-skill-circle strong i' => 'color: {{VALUE}}',
                ],
            ]
        );
        // circle empty fill color
        $this->add_control(
            'primekit_elementor_circl_skill_empty_fill_color',
            [
                'label' => esc_html__('Empty Fill Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, .3)',               
            ]
        );
        // circle fill gradient color one
        $this->add_control(
            'primekit_elementor_circl_skill_fill_gradient_color_one',
            [
                'label' => esc_html__('Gradient Color One', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#e60a0a',               
            ]
        );
        // circle fill gradient color two
        $this->add_control(
            'primekit_elementor_circl_skill_fill_gradient_color_two',
            [
                'label' => esc_html__('Gradient Color Two', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#d1de04',               
            ]
        );
        // circle style section end
        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        //load render view to show widget output on frontend/website.
        include 'RenderView.php';
    }


}