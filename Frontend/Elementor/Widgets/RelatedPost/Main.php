<?php
namespace PrimeKit\Frontend\Elementor\Widgets\RelatedPost;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-related-post';
    }
    
    public function get_title()
    {
        return esc_html__('Related Post', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-product-related primekit-addons-icon';
    }
    
    public function get_categories()
    {
        return ['primekit-category'];
    }
    
    public function get_keywords()
    {
        return ['prime', 'related', 'post'];
    }
    

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        // Related post style section
        $this->start_controls_section(
            'primekit_elementor_related_post_style_section',
            [
                'label' => esc_html__('Related Post Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
            );


            // Heading color
          $this->add_control(
            'primekit_elementor_related_post_heading_color',
            [
                'label' => esc_html__('Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-related-post-heading a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Heading Hover color
        $this->add_control(
            'primekit_elementor_related_post_heading_hover_color',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#04801d',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-related-post-heading a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        //Heading Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_related_post_heading_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-related-post-heading',
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