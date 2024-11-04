<?php 

namespace PrimeKit\Frontend\Elementor\Widgets\FlipBox;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-flip-box';
	}
	
	public function get_title()
	{
		return esc_html__('Flip Box', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-flip-box primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-category'];
	}
	
	public function get_keywords()
	{
		return ['prime', 'flip', 'box'];
	}
	
	public function get_style_depends()
	{
		return ['primekit-flip-box'];
	}
	


	/**
	 * Register list widget controls.
	 */
	protected function register_controls() {

		//front content
		$this->start_controls_section(
			'primekit_elementor_flip_box_front_contents',
			[
				'label' => esc_html__( 'Front Contents', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Type Selection
		$this->add_control(
			'primekit_elementor_flip_box_icon_img_selection',
			[
				'label' => esc_html__( 'Icon Type', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'primekit-addons' ),
					'icon'  => esc_html__( 'Icon', 'primekit-addons' ),
					'image' => esc_html__( 'Image', 'primekit-addons' ),
				],
			]
		);

		//front icon
		$this->add_control(
			'primekit_elementor_flip_box_front_icon',
			[
				'label' => esc_html__( 'Choose Icon', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'primekit_elementor_flip_box_icon_img_selection' => 'icon',
				],
			]
		);

		//Media
		$this->add_control(
			'primekit_elementor_flip_box_front_image',
			[
				'label' => esc_html__( 'Choose Image', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'primekit_elementor_flip_box_icon_img_selection' => 'image',
				],			
			]
		);

		//front heading
		$this->add_control(
			'primekit_elementor_flip_box_front_title',
			[
				'label' => esc_html__( 'Front Title', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Box front heading', 'primekit-addons' ),
			]
		);

		//Fron paragraph
		$this->add_control(
			'primekit_elementor_flip_box_front_desc',
			[
				'label' => esc_html__( 'Front Description', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 6,
				'default' => esc_html__( 'Front paragraph content goes here.', 'primekit-addons' ),
			]
		);

		//end of flip front
        $this->end_controls_section();

		//back content
		$this->start_controls_section(
			'primekit_elementor_flip_box_back_contents',
			[
				'label' => esc_html__( 'Back Contents', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//front heading
		$this->add_control(
			'primekit_elementor_flip_box_back_title',
			[
				'label' => esc_html__( 'Back Title', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Box back heading', 'primekit-addons' ),
			]
		);

		//Fron paragraph
		$this->add_control(
			'primekit_elementor_flip_box_back_desc',
			[
				'label' => esc_html__( 'Back Description', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 6,
				'default' => esc_html__( 'Back paragraph content goes here.', 'primekit-addons' ),
			]
		);

		//back button
		$this->add_control(
			'primekit_elementor_flip_box_back_btn',
			[
				'label' => esc_html__( 'Back Button Text', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Click Here', 'primekit-addons' ),
			]
		);

		//button link
		$this->add_control(
			'primekit_elementor_flip_box_back_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
				'label_block' => true,
			]
		);

		//end of flip back
        $this->end_controls_section();

		//back content
		$this->start_controls_section(
			'primekit_elementor_flip_box_settings',
			[
				'label' => esc_html__( 'Settings', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Flipping Direction
		$this->add_responsive_control(
			'primekit_elementor_page_title_align',
			[
				'label' => esc_html__( 'Flipping Direction', 'primekit-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'primekit-right-flip',
				'options' => [
					'primekit-left-flip'    => [
						'title' => esc_html__( 'Left', 'primekit-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'primekit-right-flip' => [
						'title' => esc_html__( 'Right', 'primekit-addons' ),
						'icon' => 'eicon-h-align-right',
					],
					'primekit-top-flip' => [
						'title' => esc_html__( 'Top', 'primekit-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'primekit-bottom-flip' => [
						'title' => esc_html__( 'Bottom', 'primekit-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],				
			]
		);

		//Box Width
		$this->add_responsive_control(
			'primekit_elementor_flip_box_width',
			[
				'label' => esc_html__( 'Box Width', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Box height
		$this->add_responsive_control(
			'primekit_elementor_flip_box_height',
			[
				'label' => esc_html__( 'Box Height', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%'],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 200,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Box Background
		$this->add_control(
			'primekit_elementor_flip_box_bg_color',
			[
				'label' => esc_html__( 'Box Background Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_flip_box_border',
				'selector' => '{{WRAPPER}} .primekit-flip-box',
			]
		);

		//Border radius
		$this->add_control(
			'primekit_elementor_flip_box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//end of flip box setting
        $this->end_controls_section();

		//front Style
		$this->start_controls_section(
			'primekit_elementor_flip_box_front_style',
			[
				'label' => esc_html__( 'Front Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		// Padding control
		$this->add_responsive_control(
		    'primekit_elementor_flip_box_front_padding',
		    [
		        'label' => esc_html__( 'Padding', 'primekit-addons' ),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-flip-box-front' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		//front background color
		$this->add_control(
			'primekit_elementor_flip_box_front_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ededed',
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-front' => 'background-color: {{VALUE}}',
				],
			]
		);

		//front icon size
		$this->add_responsive_control(
			'primekit_elementor_flip_box_front_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .primekit-flip-box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_flip_box_icon_img_selection' => 'icon',
				],
			]
		);

		//Icon Color
		$this->add_control(
				'primekit_elementor_flip_box_front_icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'primekit-addons' ),
					'type'  => Controls_Manager::COLOR,
					'default' => '#2f3093',
					'selectors' => [
						'{{WRAPPER}} .primekit-flip-box-icon svg, {{WRAPPER}} .primekit-flip-box-icon svg path' => 'fill: {{VALUE}}',
							'{{WRAPPER}} .primekit-flip-box-icon i' => 'color: {{VALUE}}',
					],
					'condition' => [
						'primekit_elementor_flip_box_icon_img_selection' => 'icon',
					],
				]
			);

		//front icon spacing
		$this->add_responsive_control(
			'primekit_elementor_flip_box_front_icon_spacing',
			[
				'label' => esc_html__( 'Icon Bottom Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_flip_box_icon_img_selection' => 'icon',
				],
			]
		);

		//front image size
		$this->add_responsive_control(
			'primekit_elementor_flip_box_front_image_size',
			[
				'label' => esc_html__( 'Image Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_flip_box_icon_img_selection' => 'image',
				],
			]
		);

		//front image spacing
		$this->add_responsive_control(
			'primekit_elementor_flip_box_front_image_spacing',
			[
				'label' => esc_html__( 'Image Bottom Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_flip_box_icon_img_selection' => 'image',
				],
			]
		);

		//Image Border radius
		$this->add_control(
				'primekit_elementor_flip_box_front_image_border_radius',
				[
					'label' => esc_html__( 'Image Border Radius', 'primekit-addons' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'default' => [
						'top' => 3,
						'right' => 3,
						'bottom' => 3,
						'left' => 3,
						'unit' => 'px',
						'isLinked' => true,
					],
					'selectors' => [
						'{{WRAPPER}} .primekit-flip-box-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'primekit_elementor_flip_box_icon_img_selection' => 'image',
					],
				]
			);


		//Heading typography
		$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'primekit_elementor_flip_box_front_heading_typography',
					'label' => esc_html__( 'Heading Typography', 'primekit-addons' ),
					'selector' => '{{WRAPPER}} .primekit-flip-box-front h2',
				]
			);

		//Heading Color
		$this->add_control(
			'primekit_elementor_flip_box_front_heading_color',
			[
				'label' => esc_html__( 'Heading Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#2f3093',
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-front h2' => 'color: {{VALUE}}',
				],
			]
		);

		//front heading spacing
		$this->add_responsive_control(
			'primekit_elementor_flip_box_front_heading_spacing',
			[
				'label' => esc_html__( 'Heading Bottom Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-front h2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Desc typography
		$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'primekit_elementor_flip_box_front_desc_typography',
					'label' => esc_html__( 'Description Typography', 'primekit-addons' ),
					'selector' => '{{WRAPPER}} p.primekit-front-description',
				]
			);

			//Desc Color
		$this->add_control(
			'primekit_elementor_flip_box_front_desc_color',
			[
				'label' => esc_html__( 'Description Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} p.primekit-front-description' => 'color: {{VALUE}}',
				],
			]
		);

		//Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_flip_box_front_border',
				'selector' => '{{WRAPPER}} .primekit-flip-box-front',
			]
		);

		//Border radius
		$this->add_control(
			'primekit_elementor_flip_box_front_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	
		//end of flip front style
        $this->end_controls_section();

		//Back Style
		$this->start_controls_section(
			'primekit_elementor_flip_box_back_style',
			[
				'label' => esc_html__( 'Back Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		//Back Padding
		$this->add_responsive_control(
			'primekit_elementor_flip_box_back_padding',
			[
				'label' => esc_html__( 'Padding', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-back ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//back background color
		$this->add_control(
			'primekit_elementor_flip_box_back_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#2f3093',
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-back' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Heading typography
		$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'primekit_elementor_flip_box_back_heading_typography',
					'label' => esc_html__( 'Heading Typography', 'primekit-addons' ),
					'selector' => '{{WRAPPER}} .primekit-flip-box-back h3',
				]
			);

			//Heading Color
		$this->add_control(
			'primekit_elementor_flip_box_back_heading_color',
			[
				'label' => esc_html__( 'Heading Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-back h3' => 'color: {{VALUE}}',
				],
			]
		);

		//back heading spacing
		$this->add_responsive_control(
			'primekit_elementor_flip_box_back_heading_spacing',
			[
				'label' => esc_html__( 'Heading Bottom Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-back h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Desc typography
		$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'primekit_elementor_flip_box_back_desc_typography',
					'label' => esc_html__( 'Description Typography', 'primekit-addons' ),
					'selector' => '{{WRAPPER}} p.primekit-back-description',
				]
			);

			//Desc Color
		$this->add_control(
			'primekit_elementor_flip_box_back_desc_color',
			[
				'label' => esc_html__( 'Description Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} p.primekit-back-description' => 'color: {{VALUE}}',
				],
			]
		);

		//back description spacing
		$this->add_responsive_control(
			'primekit_elementor_flip_box_back_desc_spacing',
			[
				'label' => esc_html__( 'Description Bottom Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} p.primekit-back-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_flip_box_back_border',
				'selector' => '{{WRAPPER}} .primekit-flip-box-back',
			]
		);

		//Border radius
		$this->add_control(
			'primekit_elementor_flip_box_back_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-box-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	
		//end of flip back style
        $this->end_controls_section();

		//front Style
		$this->start_controls_section(
				'primekit_elementor_flip_box_back_btn_style',
				[
					'label' => esc_html__( 'Back Button Style', 'primekit-addons' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			//button typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_flip_box_back_btn_typography',
				'label' => esc_html__( 'Button Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-flip-back-btn a',
			]
		);

			//Text Color
		$this->add_control(
			'primekit_elementor_flip_box_back_btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-back-btn a' => 'color: {{VALUE}}',
				],
			]
		);

		//Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_flip_box_back_btn_border',
				'selector' => '{{WRAPPER}} .primekit-flip-back-btn a',
			]
		);

		//Border radius
		$this->add_control(
			'primekit_elementor_flip_box_back_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-back-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Spacing
		$this->add_control(
			'primekit_elementor_flip_box_back_btn_spacing',
			[
				'label' => esc_html__( 'Button Spacing', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 10,
					'right' => 20,
					'bottom' => 10,
					'left' => 20,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-back-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Text Hover Color
		$this->add_control(
			'primekit_elementor_flip_box_back_btn_text_hov_color',
			[
				'label' => esc_html__( 'Hover Text Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-back-btn a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		// Hover BG Color
		$this->add_control(
			'primekit_elementor_flip_box_back_btn_bg_hov_color',
			[
				'label' => esc_html__( 'Hover Background Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#633396',
				'selectors' => [
					'{{WRAPPER}} .primekit-flip-back-btn a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_flip_box_back_btn_hov_border',
				'selector' => '{{WRAPPER}} .primekit-flip-back-btn a:hover',
			]
		);

			//end of flip back button style
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