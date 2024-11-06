<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\StickerText;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-sticker-text';
	}
	
	public function get_title()
	{
		return esc_html__('Sticker Text', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-text-area primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-category'];
	}
	
	public function get_keywords()
	{
		return ['PrimeKit', 'sticker', 'text'];
	}
	
	public function get_script_depends()
	{
		return ['primekit-sticker-text'];
	}
	

	/**
	 * Register list widget controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'primekit_elementor_sticker_text_setting',
			[
				'label' => esc_html__( 'Contents', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Text
		$this->add_control(
			'primekit_elementor_sticker_text',
			[
				'label' => esc_html__( 'Text', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 3,
				'default' => esc_html__( 'primekit Multi Addons for Elementor', 'primekit-addons' ),
			]
		);

		//Button Switch
		$this->add_control(
			'primekit_elementor_sticker_btn_switch',
			[
				'label' => esc_html__( 'Button', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'btn_on' => esc_html__( 'Show', 'primekit-addons' ),
				'btn_off' => esc_html__( 'Hide', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		//button text
		$this->add_control(
			'primekit_elementor_sticker_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Read More', 'primekit-addons' ),
				'condition' => [
					'primekit_elementor_sticker_btn_switch' => 'yes'
				],
			]
		);

		//button url
		$this->add_control(
			'primekit_elementor_sticker_btn_url',
			[
				'label' => esc_html__( 'Button Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => 'https://primekitaddons.com/',
					'is_external' => true,
					'nofollow' => false,
				],
				'label_block' => true,
				'condition' => [
					'primekit_elementor_sticker_btn_switch' => 'yes'
				],
			]
		);

		//Button Position
		$this->add_responsive_control(
            'primekit_elementor_sticker_button_pos',
            [
                'label' => esc_html__( 'Button Position', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'row',
                'options' => [
                    'row-reverse'    => [
                        'title' => esc_html__( 'Left', 'primekit-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row' => [
                        'title' => esc_html__( 'Right', 'primekit-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'Top', 'primekit-addons' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'column' => [
                        'title' => esc_html__( 'Bottom', 'primekit-addons' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-sticker-contents-area' => 'flex-direction: {{VALUE}}',
                ],
				'condition' => [
					'primekit_elementor_sticker_btn_switch' => 'yes'
				],
            ]
        );

		//Text and Button position
		$this->add_responsive_control(
            'primekit_elementor_sticker_button_text_pos',
            [
                'label' => esc_html__( 'Button & Text Combination', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => [
                    'left'    => [
                        'title' => esc_html__( 'Inline', 'primekit-addons' ),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'primekit-addons' ),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'primekit-addons' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-sticker-contents-area' => 'justify-content: {{VALUE}}',
                ],
				'condition' => [
					'primekit_elementor_sticker_button_pos' => 'row'
				],
            ]
        );

		//Text Gap
		$this->add_responsive_control(
			'primekit_elementor_sticker_button_gap',
			[
				'label' => esc_html__( 'Button & Text Gap', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-contents-area' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_sticker_btn_switch' => 'yes'
				],
			]
		);

		//close icon
		$this->add_control(
			'primekit_elementor_sticker_close_icon_switch',
			[
				'label' => esc_html__( 'Close Icon', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'btn_on' => esc_html__( 'Show', 'primekit-addons' ),
				'btn_off' => esc_html__( 'Hide', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section(); //end Anim Text contents

		//Box Style 
		$this->start_controls_section(
			'primekit_elementor_sticker_box_style',
			[
				'label' => esc_html__( 'Box Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//BG Color
		$this->add_control(
			'primekit_elementor_sticker_box_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f5f5f5',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-sticker-text-area' => 'background-color: {{VALUE}}',
				],
			]
		);

		//spacing
		$this->add_responsive_control(
			'primekit_elementor_sticker_box_spacing',
			[
				'label' => esc_html__( 'Spacing', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => 20,
					'right' => 20,
					'bottom' => 20,
					'left' => 20,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-sticker-text-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Border Radius
		$this->add_responsive_control(
			'primekit_elementor_sticker_box_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => 3,
					'right' => 3,
					'bottom' => 3,
					'left' => 3,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-sticker-text-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	   $this->end_controls_section();//end box style

	   //Text Style 
		$this->start_controls_section(
			'primekit_elementor_sticker_text_style',
			[
				'label' => esc_html__( 'Text Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			//Alignment
			$this->add_responsive_control(
				'primekit_elementor_sticker_text_align',
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
						'{{WRAPPER}} .primekit-sticker-text' => 'text-align: {{VALUE}}',
					],
				]
			);

		//Color
		$this->add_control(
			'primekit_elementor_sticker_text_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-text' => 'color: {{VALUE}}',
				],
			]
		);

		//Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_sticker_text_typography',
				'label' => esc_html__( 'Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-sticker-text',
			]
		);

		$this->end_controls_section();//end text style

		 //Button Style 
		 $this->start_controls_section(
			'primekit_elementor_sticker_btn_style',
			[
				'label' => esc_html__( 'Button Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'primekit_elementor_sticker_btn_switch' => 'yes'
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_sticker_btn_typography',
				'label' => esc_html__( 'Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-sticker-btn',
			]
		);

		$this->start_controls_tabs(
			'primekit_elementor_sticker_btn_style_tabs'
		);

		$this->start_controls_tab(
			'primekit_elementor_sticker_btn_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'primekit-addons' ),
			]
		);

		//Color
		$this->add_control(
			'primekit_elementor_sticker_btn_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#3544ec',
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-btn a' => 'color: {{VALUE}}',
				],
			]
		);

		//BG Color
		$this->add_control(
			'primekit_elementor_sticker_btn_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-btn a' => 'background-color: {{VALUE}}',
				],
			]
		);

		//border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_sticker_btn_border',
				'selector' => '{{WRAPPER}} .primekit-sticker-btn a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'primekit_elementor_sticker_btn_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'primekit-addons' ),
			]
		);

		//Hover Color
		$this->add_control(
			'primekit_elementor_sticker_btn_hov_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-btn a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		//Hover BG Color
		$this->add_control(
			'primekit_elementor_sticker_btn_bg_hov_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#3544ec',
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-btn a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		//hover border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_sticker_btn_hov_border',
				'selector' => '{{WRAPPER}} .primekit-sticker-btn a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		//Border radius
		$this->add_responsive_control(
			'primekit_elementor_sticker_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => 3,
					'right' => 3,
					'bottom' => 3,
					'left' => 3,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Spacing
		$this->add_responsive_control(
			'primekit_elementor_sticker_btn_spacing',
			[
				'label' => esc_html__( 'Button Spacing', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => 7,
					'right' => 15,
					'bottom' => 7,
					'left' => 15,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();//end button style

		 //Close Icon Style 
		 $this->start_controls_section(
			'primekit_elementor_sticker_close_icon_style',
			[
				'label' => esc_html__( 'Close Icon Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'primekit_elementor_sticker_close_icon_switch' => 'yes'
				],
			]
		);

		//Icon Size
		$this->add_responsive_control(
			'primekit_elementor_sticker_close_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-close-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Color
		$this->add_control(
			'primekit_elementor_sticker_close_icon_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#3544ec',
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-close-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		//Icon top position
		$this->add_responsive_control(
			'primekit_elementor_sticker_close_icon_top_post',
			[
				'label' => esc_html__( 'Icon Top Position', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-close-icon' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Icon right position
		$this->add_responsive_control(
			'primekit_elementor_sticker_close_icon_right_post',
			[
				'label' => esc_html__( 'Icon Right Position', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-sticker-close-icon' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();//end close icon style
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'renderview.php';
    }
}