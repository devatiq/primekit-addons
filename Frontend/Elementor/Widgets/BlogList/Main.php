<?php
namespace PrimeKit\Frontend\Elementor\Widgets\BlogList;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-blog-list';
    }

    public function get_title()
    {
        return esc_html__('Blog Posts List', 'primekit-addons');
    }

    public function get_icon()
    {
        return 'eicon-post-list primekit-addons-icon';
    }
    public function get_categories()
    {
        return ['primekit-category'];
    }
    public function get_keywords()
    {
        return ['prime', 'blog', 'list', 'post'];
    }

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_blog_list_setting',
            [
                'label' => esc_html__('Blog Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //category selection
        $this->add_control(
            'primekit_elementor_blog_list_category',
            [
                'label' => esc_html__('Select Category', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->primekit_blog_list_categories(),
                'default' => 'all',
                'label_block' => true,
                'multiple' => false,
            ]
        );

        //number of post
        $this->add_control(
            'primekit_elementor_blog_list_post_number',
            [
                'label' => esc_html__('Number of Post', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['custom'],
                'range' => [
                    'custom' => [
                        'min' => 3,
                        'max' => 30,
                        'step' => 5,
                    ]
                ],
                'default' => [
                    'size' => 6,
                ],
            ]
        );

        //Featured Image
        $this->add_control(
            'primekit_elementor_blog_list_img_switch',
            [
                'label' => esc_html__('Featured Image', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //blog date on/off switch
        $this->add_control(
            'primekit_elementor_blog_list_date_switch',
            [
                'label' => esc_html__('Blog Date', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //blog comment on/off switch
        $this->add_control(
            'primekit_elementor_blog_list_comment_switch',
            [
                'label' => esc_html__('Blog Comments', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //Excerpt
        $this->add_control(
            'primekit_elementor_blog_list_excerpt_switch',
            [
                'label' => esc_html__('Blog Excerpt', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //Excerpt leangth
        $this->add_control(
            'primekit_elementor_blog_list_excerpt_length',
            [
                'label' => esc_html__('Excerpt Length', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 5,
                'max' => 500,
                'step' => 5,
                'default' => 25,
                'condition' => [
                    'primekit_elementor_blog_list_excerpt_switch' => 'yes'
                ],
            ]
        );

        //More Button
        $this->add_control(
            'primekit_elementor_blog_list_read_more_switch',
            [
                'label' => esc_html__('More Button', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //More Button Text
        $this->add_control(
            'primekit_elementor_blog_list_read_more_text',
            [
                'label' => esc_html__('More Button Text', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More',
                'placeholder' => 'Enter read more text',
                'condition' => [
                    'primekit_elementor_blog_list_read_more_switch' => 'yes',
                ],
            ]
        );

        //Pagination
        $this->add_control(
            'primekit_elementor_blog_list_pagination',
            [
                'label' => esc_html__('Pagination', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
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

        $this->end_controls_section(); //end blog list setting control

        // blog list style section
        $this->start_controls_section(
            'primekit_elementor_blog_list_title_style_section',
            [
                'label' => esc_html__('Title Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //blog title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_list_title_typography',
                'label' => esc_html__('Title Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-blog-list-title, {{WRAPPER}} .primekit-ele-blog-list-title a',
            ]
        );

        $this->start_controls_tabs(
            'primekit_elementor_blog_list_title_style_tabs'
        );

        $this->start_controls_tab(
            'primekit_elementor_blog_list_title_style_normal_tab',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
            ]
        );

        // blog title color
        $this->add_control(
            'primekit_elementor_blog_list_title_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'primekit_elementor_blog_list_title_style_hover_tab',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
            ]
        );

        // blog title hover color
        $this->add_control(
            'primekit_elementor_blog_list_title_hover_color',
            [
                'label' => esc_html__('Title Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59a818',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section(); // end title style

        // blog grid meta style section
        $this->start_controls_section(
            'primekit_elementor_blog_list_meta_style_section',
            [
                'label' => esc_html__('Meta Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //blog meta typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_list_meta_typography',
                'label' => esc_html__('Meta Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-blog-list-meta',
            ]
        );

        // blog meta color
        $this->add_control(
            'primekit_elementor_blog_list_meta_color',
            [
                'label' => esc_html__('Meta Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-meta, {{WRAPPER}} .primekit-ele-blog-list-meta a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // end meta style

        // blog grid excerpt style section
        $this->start_controls_section(
            'primekit_elementor_blog_list_excerpt_style_section',
            [
                'label' => esc_html__('Excerpt Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_blog_list_excerpt_switch' => 'yes'
                ],
            ]
        );

        //blog excerpt typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_list_excerpt_typography',
                'label' => esc_html__('Excerpt Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-blog-list-excerpt',
            ]
        );

        // blog excerpt color
        $this->add_control(
            'primekit_elementor_blog_list_excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3d3d3d',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-excerpt p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // end excerpt style

        // button style section
        $this->start_controls_section(
            'primekit_elementor_blog_list_button_style_section',
            [
                'label' => esc_html__('Button Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_blog_list_read_more_switch' => 'yes'
                ],
            ]
        );

        //button typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_list_button_typography',
                'label' => esc_html__('Button Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-blog-list-more',
            ]
        );

        $this->start_controls_tabs(
            'primekit_elementor_blog_list_button_style_tabs'
        );

        $this->start_controls_tab(
            'primekit_elementor_blog_list_button_style_normal_tab',
            [
                'label' => esc_html__('Button Color', 'primekit-addons'),
            ]
        );

        // Button color
        $this->add_control(
            'primekit_elementor_blog_list_button_color',
            [
                'label' => esc_html__('Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59a818',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-more a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-blog-list-more a:after' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'primekit_elementor_blog_list_button_style_hover_tab',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
            ]
        );

        // Button Hover color
        $this->add_control(
            'primekit_elementor_blog_list_button_hover_color',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3d3d3d',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-more a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-blog-list-more a:hover:after' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section(); // end button style

        // Image style section
        $this->start_controls_section(
            'primekit_elementor_blog_list_image_style_section',
            [
                'label' => esc_html__('Image Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_blog_list_img_switch' => 'yes'
                ],
            ]
        );

        //Image Width
        $this->add_responsive_control(
            'primekit_elementor_blog_list_image_width',
            [
                'label' => esc_html__('Image Width', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-thumb' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //Image Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'primekit_elementor_blog_list_image_width_border',
                'selector' => '{{WRAPPER}} .primekit-ele-blog-list-thumb figure img',
            ]
        );

        //Image Border Radius
        $this->add_responsive_control(
            'primekit_elementor_blog_list_image_width_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
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
                    '{{WRAPPER}} .primekit-ele-blog-list-thumb figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); // end image style

        // Pagination style section
        $this->start_controls_section(
            'primekit_elementor_blog_list_pagination_style_section',
            [
                'label' => esc_html__('Pagination Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_blog_list_pagination' => 'yes'
                ],
            ]
        );

        //Pagination typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_list_pagination_typography',
                'label' => esc_html__('Pagination Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-blog-list-pagi-container',
            ]
        );

        // Spacing
        $this->add_responsive_control(
            'primekit_elementor_blog_list_pagination_spacing',
            [
                'label' => esc_html__('Spacing', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-pagi-container' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Padding fields
        $this->add_responsive_control(
            'primekit_elementor_blog_list_pagination_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 5,
                    'right' => 10,
                    'bottom' => 5,
                    'left' => 10,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-pagi-container a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-ele-blog-list-pagi-container .current' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border fields
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'primekit_elementor_blog_list_pagination_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-blog-list-pagi-container a,{{WRAPPER}} .primekit-ele-blog-list-pagi-container .current',
            ]
        );

        // Border Radius fields
        $this->add_responsive_control(
            'primekit_elementor_blog_list_pagination_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 5,
                    'right' => 5,
                    'bottom' => 5,
                    'left' => 5,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-pagi-container a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-ele-blog-list-pagi-container .current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'primekit_elementor_blog_list_pagination_style_tabs'
        );

        $this->start_controls_tab(
            'primekit_elementor_blog_list_pagination_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'primekit-addons'),
            ]
        );

        // Text color
        $this->add_control(
            'primekit_elementor_blog_list_pagi_text_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-pagi-container a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Text Bg color
        $this->add_control(
            'primekit_elementor_blog_list_pagi_text_bg_color',
            [
                'label' => esc_html__('Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#eeeeee',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-pagi-container a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'primekit_elementor_blog_list_pagination_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'primekit-addons'),
            ]
        );

        // Hover color
        $this->add_control(
            'primekit_elementor_blog_list_pagi_text_hover_color',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-pagi-container a:hover,{{WRAPPER}} .primekit-ele-blog-list-pagi-container .current' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Hover bg color
        $this->add_control(
            'primekit_elementor_blog_list_pagi_text_hover_bg_color',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59a818',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-pagi-container a:hover,{{WRAPPER}} .primekit-ele-blog-list-pagi-container .current' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // Hover border color
        $this->add_control(
            'primekit_elementor_blog_list_pagi_border_hover_color',
            [
                'label' => esc_html__('Border Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-list-pagi-container a:hover, {{WRAPPER}} .primekit-ele-blog-list-pagi-container .current' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section(); // end pagination style

    }

    //get blog category
    private function primekit_blog_list_categories()
    {
        $categories = get_categories();
        $options = ['all' => 'All Categories'];

        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }

        return $options;
    }

    /*
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'RenderView.php';
    }

}