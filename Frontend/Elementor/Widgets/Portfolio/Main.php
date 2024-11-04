<?php
namespace PrimeKit\Frontend\Elementor\Widgets\Portfolio;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
	public function get_name()
	{
		return 'primekit-portfolio';
	}
	
	public function get_title()
	{
		return esc_html__('Portfolio', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-posts-grid primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-category'];
	}
	
	public function get_keywords()
	{
		return ['prime', 'work', 'portfolio'];
	}
	
    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_portfolio_setting',
            [
                'label' => esc_html__('Portfolio Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

         //Portfolio Image
         $this->add_control(
			'primekit_elementor_portfolio_image',
			[
				'label' => esc_html__( 'Choose Image', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

        //Image dimension
        $this->add_control(
			'primekit_elementor_portfolio_image_dimension',
			[
				'label' => esc_html__( 'Image Dimension', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'primekit-addons' ),
				'default' => [
					'width' => '1000',
					'height' => '1000',
				],
			]
		);

        //Title text
        $this->add_control(
			'primekit_elementor_portfolio_title_text',
			[
				'label' => esc_html__( 'Title Text', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Business Website Development', 'primekit-addons' ),
			]
		);

      
        //Sub Title text
        $this->add_control(
			'primekit_elementor_portfolio_sub_title_text',
			[
				'label' => esc_html__( 'Sub Title Text', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Website Design', 'primekit-addons' ),
			]
		);

        //Portfolio Link
        $this->add_control(
			'primekit_elementor_portfolio_link',
			[
				'label' => esc_html__( 'Portfolio Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => 'https://demo.primekitaddons.com/widgets/portfolio-elementor-widget/',
					'is_external' => true,
					'nofollow' => false,
				],
			]
		);
      
        $this->end_controls_section();//end setting


          // start of team member style section
          $this->start_controls_section(
            'primekit_elementor_portfolio_style_section',
            [
                'label' => esc_html__('Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		 //Image Width
         $this->add_responsive_control(
			'primekit_elementor_portfolio_img_width',
			[
				'label' => esc_html__( 'Image Width', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1200,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-portfolio-item img, {{WRAPPER}} .primekit-elementor-portfolio-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
         //Vertical Alignment
		$this->add_responsive_control(
			'primekit_elementor_portfolio_vertical_align',
			[
				'label' => esc_html__( 'Title Vertical Alignment', 'primekit-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'flex-end',
				'options' => [
					'flex-start'    => [
						'title' => esc_html__( 'Top', 'primekit-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'primekit-addons' ),
						'icon' => 'eicon-align-center-v',
					],
					'flex-end' => [
						'title' => esc_html__( 'Bottom', 'primekit-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],				
				'selectors' => [
					'{{WRAPPER}} .primekit-portfolio-overlay' => 'justify-content: {{VALUE}}',
				],
			]
		);

         //Horizontal Alignment
		$this->add_responsive_control(
			'primekit_elementor_portfolio_horizontal_align',
			[
				'label' => esc_html__( 'Title Horizontal Alignment', 'primekit-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'primekit-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'primekit-addons' ),
						'icon' => 'eicon-align-center-h',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'primekit-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],				
				'selectors' => [
					'{{WRAPPER}} h3.primekit-portfolio-title, {{WRAPPER}} p.primekit-portfolio-subtitle' => 'text-align: {{VALUE}}',
				],
			]
		);

         // Title typography 
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_portfolio_title_typography',
                'label' => esc_html__('Title Typography', 'primekit-addons'),
                'selector' =>  '{{WRAPPER}} h3.primekit-portfolio-title',
            ]
        );

         // Sub Title typography 
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_portfolio_sub_title_typography',
                'label' => esc_html__('Sub Title Typography', 'primekit-addons'),
                'selector' =>  '{{WRAPPER}} p.primekit-portfolio-subtitle',
            ]
        );

        // Title color
        $this->add_control(
            'primekit_elementor_portfolio_title_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} h3.primekit-portfolio-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Sub Title color
        $this->add_control(
            'primekit_elementor_portfolio_sub_title_color',
            [
                'label' => esc_html__('Sub Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} p.primekit-portfolio-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        // Overflow color
        $this->add_control(
            'primekit_elementor_portfolio_overflow_color',
            [
                'label' => esc_html__('Overflow Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .primekit-portfolio-overlay' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Image Border
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_portfolio_img_border',
				'selector' => '{{WRAPPER}} .primekit-elementor-portfolio-item img',
			]
		);

        // Image Border Radius
        $this->add_control(
			'primekit_elementor_portfolio_img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-portfolio-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-portfolio-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-elementor-portfolio-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        include 'RenderView.php';
    }

}
