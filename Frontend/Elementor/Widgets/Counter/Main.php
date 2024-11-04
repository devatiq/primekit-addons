<?php

namespace PrimeKit\Frontend\Elementor\Widgets\Counter;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;


class Main extends Widget_Base
{

    public function get_name()
    {
        return 'primekit-counterup';
    }
    
    public function get_title()
    {
        return esc_html__('Counter Up', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-counter primekit-addons-icon';
    }
    
    public function get_categories()
    {
        return ['primekit-category'];
    }
    
    public function get_keywords()
    {
        return ['prime', 'counter', 'up'];
    }
    
    public function get_script_depends()
    {
        return ['primekit-counter-up', 'primekit-jquery-appear', 'primekit-wapoints']; 
    }
    

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_counter_section',
            [
                'label' => esc_html__('Counter', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]           
        );
        // counter title
        $this->add_control(
            'primekit_elementor_counter_title',
            [
                'label' => esc_html__('Title', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Our Clients', 'primekit-addons'),
                'label_block' => true,
            ]           
        );
        // counter number
        $this->add_control(
            'primekit_elementor_counter_number',
            [
                'label' => esc_html__('Number', 'primekit-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => esc_html__('100', 'primekit-addons'),               
            ]
        );
        // counter icon
        $this->add_control(
            'primekit_elementor_counter_icon',
            [
                'label' => esc_html__('Icon', 'primekit-addons'),
                'type' => Controls_Manager::ICONS,
            ]            
        );
        // counter suffix
        $this->add_control(
            'primekit_elementor_counter_suffix',
            [
                'label' => esc_html__('Suffix', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('+', 'primekit-addons'),
                'label_block' => true,
            ]            
        );    
        
        //Alignment
		$this->add_responsive_control(
			'primekit_elementor_counter_icon_align',
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
					'{{WRAPPER}} .primekit-ele-countdown-wrap' => 'text-align: {{VALUE}}',
				],
			]
		);

        // end of counter section
        $this->end_controls_section();


        // start of counter style section
        $this->start_controls_section(
            'primekit_elementor_counter_style_section',
            [
                'label' => esc_html__('Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //counter box padding
        $this->add_responsive_control(
            'primekit_elementor_counter_box_padding',
            [
                'label' => esc_html__('Box Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-countdown-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        // counter title color
        $this->add_control(
            'primekit_elementor_counter_title_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-count-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        // counter title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_counter_title_typography',
                'label' => esc_html__('Title Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-count-title h3',
            ]
        );
        // counter number color
        $this->add_control(
            'primekit_elementor_counter_number_color',
            [
                'label' => esc_html__('Number Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-counter .primekit-counter' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-counter-suffix' => 'color: {{VALUE}};',
                ],
            ]
        );
        // counter number typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_counter_number_typography',
                'label' => esc_html__('Number Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-counter span.primekit-counter, {{WRAPPER}} .primekit-ele-counter-suffix',
            ]
        );
        // counter icon color
        $this->add_control(
            'primekit_elementor_counter_icon_color',
            [
                'label' => esc_html__('Icon Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59A818',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        // counter icon size
        $this->add_responsive_control(
            'primekit_elementor_counter_icon_size',
            [
                'label' => esc_html__('Icon Size', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .primekit-ele-countdown-wrap span.primekit-counter-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}  .primekit-ele-countdown-wrap span.primekit-counter-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // counter icon background color
        $this->add_control(
            'primekit_elementor_counter_icon_bg_color',
            [
                'label' => esc_html__('Icon Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon i' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon svg' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // counter icon border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'primekit_elementor_counter_icon_border',
                'selector' => '{{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon i, {{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon svg',
            ]
        );
        // counter icon border radius
        $this->add_responsive_control(
            'primekit_elementor_counter_icon_border_radius',
            [
                'label' => esc_html__('Icon Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        // counter icon padding
        $this->add_responsive_control(
            'primekit_elementor_counter_icon_padding',
            [
                'label' => esc_html__('Icon Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        // counter icon margin
        $this->add_responsive_control(
            'primekit_elementor_counter_icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-ele-countdown-wrap span.primekit-counter-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        // end of counter style section
        $this->end_controls_section();

        // start of counter hover style section
        $this->start_controls_section(
            'primekit_elementor_counter_hover_style_section',
            [
                'label' => esc_html__('Hover', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // counter title hover color
        $this->add_control(
            'primekit_elementor_counter_title_hover_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-countdown-wrap:hover .primekit-ele-count-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        // counter number hover color
        $this->add_control(
            'primekit_elementor_counter_number_hover_color',
            [
                'label' => esc_html__('Number Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-countdown-wrap:hover .primekit-counter' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-countdown-wrap:hover .primekit-ele-counter-suffix' => 'color: {{VALUE}};',
                ],
            ]
        );
        // counter icon hover color
        $this->add_control(
            'primekit_elementor_counter_icon_hover_color',
            [
                'label' => esc_html__('Icon Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-countdown-wrap:hover span.primekit-counter-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-countdown-wrap:hover span.primekit-counter-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        // counter icon hover background color
        $this->add_control(
            'primekit_elementor_counter_icon_hover_bg_color',
            [
                'label' => esc_html__('Icon Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-countdown-wrap:hover span.primekit-counter-icon i' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-countdown-wrap:hover span.primekit-counter-icon svg' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // counter icon hover border color
        $this->add_control(
            'primekit_elementor_counter_icon_hover_border_color',
            [
                'label' => esc_html__('Icon Border Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-countdown-wrap:hover span.primekit-counter-icon i' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-countdown-wrap:hover span.primekit-counter-icon svg' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        // end of counter hover style section
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
