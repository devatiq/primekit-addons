<?php
namespace PrimeKit\Frontend\Elementor\Widgets\PostInfo;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-post-info';
    }
    
    public function get_title()
    {
        return esc_html__('Post Meta Info', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-post-info primekit-addons-icon';
    }
    
    public function get_categories()
    {
        return ['primekit-category'];
    }
    
    public function get_keywords()
    {
        return ['prime', 'post', 'info', 'meta'];
    }
    

    /**
     * Register the widget controls.
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_post_info_setting',
            [
                'label' => esc_html__('Post Info Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //blog date on/off switch
        $this->add_control(
            'primekit_elementor_post_info_date_switch',
            [
                'label' => esc_html__('Date', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //blog date on/off switch
        $this->add_control(
            'primekit_elementor_post_info_author_switch',
            [
                'label' => esc_html__('Author', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //blog comment on/off switch
        $this->add_control(
            'primekit_elementor_post_info_comment_switch',
            [
                'label' => esc_html__('Comments', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //Alignment
		$this->add_responsive_control(
			'primekit_elementor_post_info_align',
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
					'{{WRAPPER}} .primekit-ele-post-info' => 'text-align: {{VALUE}}',
				],
			]
		);


        $this->end_controls_section();

        // blog info style section
        $this->start_controls_section(
            'primekit_elementor_post_info_content_style_section',
            [
                'label' => esc_html__('Blog Info Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //blog info typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_post_info_info_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-post-info',
            ]
        );
        // blog info text color
        $this->add_control(
            'primekit_elementor_post_info_info_color',
            [
                'label' => esc_html__('Info Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#d6d6d6',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-post-info, .primekit-ele-post-info a' => 'color: {{VALUE}};',
                ],
            ]
        );
        // blog info icon color
        $this->add_control(
            'primekit_elementor_post_info_info_icon_color',
            [
                'label' => esc_html__('Icon Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#d6d6d6',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-post-info i' => 'color: {{VALUE}};',
                ],
            ]
        );
        // blog info icon size
        $this->add_responsive_control(
            'primekit_elementor_post_info_info_icon_size',
            [
                'label' => esc_html__('Icon Size', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-post-info i' => 'font-size: {{SIZE}}{{UNIT}};',
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