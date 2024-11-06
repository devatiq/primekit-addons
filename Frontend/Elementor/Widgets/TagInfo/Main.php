<?php
namespace PrimeKit\Frontend\Elementor\Widgets\TagInfo;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-tag-info';
    }
    
    public function get_title()
    {
        return esc_html__('Post Tags', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-tags primekit-addons-icon';
    }
    
    public function get_categories()
    {
        return ['primekit-category'];
    }
    
    public function get_keywords()
    {
        return ['PrimeKit', 'tag', 'post'];
    }
    

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_post_tag_setting',
            [
                'label' => esc_html__('Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //Alignment
		$this->add_responsive_control(
			'primekit_elementor_post_tag_align',
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
					'{{WRAPPER}} .primekit-ele-post-tag' => 'text-align: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section();

        // blog info style section
        $this->start_controls_section(
            'primekit_elementor_post_tag_style_section',
            [
                'label' => esc_html__('Category Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //Tag Padding
        $this->add_responsive_control(
			'primekit_elementor_post_tag_padding',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Tags Padding', 'primekit-addons' ),
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-post-tag ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        //Tag margin
        $this->add_responsive_control(
			'primekit_elementor_post_tag_margin',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Tags Margin', 'primekit-addons' ),
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-post-tag ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        //Tag border radius
        $this->add_responsive_control(
			'primekit_elementor_post_tag_border_radius',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-post-tag ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        //blog info typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_post_tag_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-post-tag',
            ]
        );

        // text color
        $this->add_control(
            'primekit_elementor_post_tag_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-post-tag ul li a' => 'color: {{VALUE}};',
                ],
            ]
        );

         // text bg color
         $this->add_control(
            'primekit_elementor_post_tag_bg_color',
            [
                'label' => esc_html__('Text Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#e3e3e3',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-post-tag ul li a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // hover color
        $this->add_control(
            'primekit_elementor_post_tag_hover_color',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#e3e3e3',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-post-tag ul li a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // hover bg color
        $this->add_control(
            'primekit_elementor_post_tag_hover_bg_color',
            [
                'label' => esc_html__('Hover Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-post-tag ul li a:hover' => 'background-color: {{VALUE}};',
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