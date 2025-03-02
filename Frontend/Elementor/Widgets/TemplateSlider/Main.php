<?php
namespace PrimeKit\Frontend\Elementor\Widgets\TemplateSlider;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Background;


class Main extends Widget_Base
{

    public function get_name()
    {
        return 'primekit-TemplateSlider';
    }
    
    public function get_title()
    {
        return esc_html__('Template Slider', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-testimonial-carousel primekit-addons-icon';
    }
    
    public function get_categories()
    {
        return ['primekit-category'];
    }
    
    public function get_keywords()
    {
        return ['prime', 'carousel', 'slider'];
    }
    
    public function get_script_depends()
    {
        return ['primekit-swiper', 'primekit-template-slider'];
    }
    
    public function get_style_depends()
    {
        return ['primekit-swiper'];
    }
    

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        // Start content section
        $this->start_controls_section(
            'primekit_slider_contents',
            [
                'label' => esc_html__('Slides', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Fetch Elementor templates to populate repeater
        $templates = Plugin::instance()->templates_manager->get_source('local')->get_items();
        $template_options = [];

        if (!empty($templates)) {
            foreach ($templates as $template) {
                $template_options[$template['template_id']] = $template['title'];
            }
        }

        // Define the repeater
        $repeater = new Repeater();

        // Add the repeater controls
        $repeater->add_control(
            'template_select',
            [
                'label' => esc_html__('Choose Template', 'primekit-addons'),
                'type' => Controls_Manager::SELECT2,
                'options' => $template_options,
                'description' => esc_html__('Choose a template from Elementor', 'primekit-addons'),
                'label_block' => true,
            ]
        );

        // Add more controls within the repeater if necessary (e.g., text, images, etc.)
        $repeater->add_control(
            'slide_title',
            [
                'label' => esc_html__('Slide Title', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Slide Title', 'primekit-addons'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slides', 'primekit-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_title' => esc_html__('Slide 1', 'primekit-addons'),
                    ],
                    [
                        'slide_title' => esc_html__('Slide 2', 'primekit-addons'),
                    ],
                ],
                'title_field' => '{{{ slide_title }}}',
            ]
        );

        $this->end_controls_section(); //end content section


        // start slider settings section
        $this->start_controls_section(
            'primekit_slider_settings',
            [
                'label' => esc_html__('Slider Settings', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'label' => esc_html__('Slides Per View', 'primekit-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
                'desktop_default' => 1,
                'tablet_default' => 1,
                'mobile_default' => 1,
            ]
        );

        $this->add_control(
            'slider_loop',
            [
                'label' => esc_html__('Loop', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label' => esc_html__('Autoplay', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => esc_html__('Show Pagination', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label' => esc_html__('Show Navigation', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section(); //end slider settings section

        // start style section
        $this->start_controls_section(
            'primekit_slider_style',
            [
                'label' => esc_html__('Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'slider_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-addons-template-slider-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_gap',
            [
                'label' => esc_html__('Gap', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); //end style section


        // start navigation section
        $this->start_controls_section(
            'primekit_slider_navigation',
            [
                'label' => esc_html__('Navigation', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        // nav size
        $this->add_responsive_control(
            'nav_size',
            [
                'label' => esc_html__('Size', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-template-slider-nav > div' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // nav font size
        $this->add_responsive_control(
            'nav_font_size',
            [
                'label' => esc_html__('Font Size', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-addons-template-slider-wrapper .swiper-button-next:after, {{WRAPPER}} .primekit-addons-template-slider-wrapper .swiper-button-prev::after' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // prev nav left indent
        $this->add_responsive_control(
            'nav_prev_left_indent',
            [
                'label' => esc_html__('Prev Left Indent', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // next nav right indent
        $this->add_responsive_control(
            'nav_next_right_indent',
            [
                'label' => esc_html__('Next Right Indent', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // nav prev top indent
        $this->add_responsive_control(
            'nav_prev_top_indent',
            [
                'label' => esc_html__('Prev Top Indent', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -50,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-prev' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );    

        // nav next top indent
        $this->add_responsive_control(
            'nav_next_top_indent',
            [
                'label' => esc_html__('Next Top Indent', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -50,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        


        $this->start_controls_tabs('nav_tabs');

        $this->start_controls_tab(
            'nav_normal_tab',
            [
                'label' => esc_html__('Normal', 'primekit-addons'),
            ]
        );

        $this->add_control(
            'nav_color',
            [
                'label' => esc_html__('Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .primekit-template-slider-nav .swiper-button-next' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-template-slider-nav .swiper-button-prev' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'nav_background',
                'label' => esc_html__('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-template-slider-nav .swiper-button-next, {{WRAPPER}} .primekit-template-slider-nav .swiper-button-prev',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'nav_hover_tab',
            [
                'label' => esc_html__('Hover', 'primekit-addons'),
            ]
        );

        $this->add_control(
            'nav_hover_color',
            [
                'label' => esc_html__('Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-template-slider-nav .swiper-button-next:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-template-slider-nav .swiper-button-prev:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'nav_hover_background',
                'label' => esc_html__('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-template-slider-nav .swiper-button-next:hover, {{WRAPPER}} .primekit-template-slider-nav .swiper-button-prev:hover',
            ]
        );

        $this->end_controls_tab(); // end hover tab

        $this->end_controls_tabs(); // end tabs

        $this->end_controls_section(); // end navigation section


        // pagination section
        $this->start_controls_section(
            'pagination_section',
            [
                'label' => esc_html__('Pagination', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pagination' => 'yes',
                ],
            ]
        );

        // pagination size
        $this->add_responsive_control(
            'pagination_size',
            [
                'label' => esc_html__('Size', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-addons-template-slider-wrapper .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // pagination color
        $this->add_control(
            'pagination_color',
            [
                'label' => esc_html__('Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-addons-template-slider-wrapper .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // pagination active color
        $this->add_control(
            'pagination_active_color',
            [
                'label' => esc_html__('Active Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-addons-template-slider-wrapper .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // pagination bottom indent
        $this->add_responsive_control(
            'pagination_bottom_indent',
            [
                'label' => esc_html__('Bottom Indent', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-addons-template-slider-wrapper .primekit-template-slider-pagination .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section(); // end pagination section

    }


    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'RenderView.php';
    }
}