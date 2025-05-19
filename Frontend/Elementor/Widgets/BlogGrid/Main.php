<?php
namespace PrimeKit\Frontend\Elementor\Widgets\BlogGrid;

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
        return 'primekit-blog-grid';
    }

    public function get_title()
    {
        return esc_html__('Blog Posts Grid', 'primekit-addons');
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
        return ['prime', 'blog', 'grid', 'post'];
    }

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_blog_grid_setting',
            [
                'label' => esc_html__('Blog Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //blog layout
        // $this->add_control(
        //     'primekit_elementor_blog_grid_layout',
        //     [
        //         'label' => esc_html__('Blog Layout', 'primekit-addons'),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => 'three-column',
        //         'options' => [
        //             'two-column' => esc_html__('Two Colum', 'primekit-addons'),
        //             'three-column' => esc_html__('Three Colum', 'primekit-addons'),
        //             'four-column' => esc_html__('Four Colum', 'primekit-addons'),
        //         ],
        //     ]
        // );


        $this->add_responsive_control(
            'primekit_elementor_blog_grid_column',
            [
                'label' => esc_html__('Column', 'primekit-addons'),
                'type' => Controls_Manager::NUMBER,
                'size_units' => [],
                'min' => 1,
                'max' => 4,
                'step' => 1,
                'desktop_default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'description' => esc_html__('Set the number of columns for Tablet and Mobile views', 'primekit-addons'),
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-four-column-blog' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );



        //category selection
        $this->add_control(
            'primekit_elementor_blog_grid_category',
            [
                'label' => esc_html__('Select Category', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->primekit_get_blog_categories(),
                'default' => 'all',
                'label_block' => true,
                'multiple' => false,
            ]
        );

        //number of post
        $this->add_control(
            'primekit_elementor_blog_grid_post_number',
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
            'primekit_elementor_blog_grid_img_switch',
            [
                'label' => esc_html__('Featured Image', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //thumbnail size
        $this->add_control(
            'primekit_elementor_blog_grid_img_size',
            [
                'label' => esc_html__('Thumbnail Size', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'full',
                'options' => [
                    'blog' => esc_html__('Blog', 'primekit-addons'),
                    'full' => esc_html__('Full', 'primekit-addons'),
                ],
                'condition' => [
                    'primekit_elementor_blog_grid_img_switch' => 'yes',
                ],
            ]
        );

        //blog date on/off switch
        $this->add_control(
            'primekit_elementor_blog_grid_date_switch',
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
            'primekit_elementor_blog_grid_comment_switch',
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
            'primekit_elementor_blog_grid_excerpt_switch',
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
            'primekit_elementor_blog_grid_excerpt_length',
            [
                'label' => esc_html__('Excerpt Length', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 5,
                'max' => 500,
                'step' => 5,
                'default' => 25,
                'condition' => [
                    'primekit_elementor_blog_grid_excerpt_switch' => 'yes'
                ],
            ]
        );

        //More Button
        $this->add_control(
            'primekit_elementor_blog_grid_read_more_switch',
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
            'primekit_elementor_blog_grid_read_more_text',
            [
                'label' => esc_html__('More Button Text', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More',
                'placeholder' => 'Enter read more text',
                'condition' => [
                    'primekit_elementor_blog_grid_read_more_switch' => 'yes',
                ],
            ]
        );

        //Pagination
        $this->add_control(
            'primekit_elementor_blog_grid_pagination',
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

        $this->end_controls_section(); //end blog grid setting control

        // blog grid style section
        $this->start_controls_section(
            'primekit_elementor_blog_grid_title_style_section',
            [
                'label' => esc_html__('Title Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //blog title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_grid_title_typography',
                'label' => esc_html__('Title Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-blog-title, {{WRAPPER}} .primekit-ele-blog-title a',
            ]
        );

        $this->start_controls_tabs(
            'primekit_elementor_blog_grid_title_style_tabs'
        );

        $this->start_controls_tab(
            'primekit_elementor_blog_grid_title_style_normal_tab',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
            ]
        );

        // blog title color
        $this->add_control(
            'primekit_elementor_blog_grid_title_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'primekit_elementor_blog_grid_title_style_hover_tab',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
            ]
        );

        // blog title hover color
        $this->add_control(
            'primekit_elementor_blog_grid_title_hover_color',
            [
                'label' => esc_html__('Title Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59a818',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section(); // end title style

        // blog grid meta style section
        $this->start_controls_section(
            'primekit_elementor_blog_grid_meta_style_section',
            [
                'label' => esc_html__('Meta Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //blog meta typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_grid_meta_typography',
                'label' => esc_html__('Meta Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-blog-meta',
            ]
        );

        // blog meta color
        $this->add_control(
            'primekit_elementor_blog_grid_meta_color',
            [
                'label' => esc_html__('Meta Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-meta, .primekit-ele-blog-meta a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // end meta style

        // blog grid excerpt style section
        $this->start_controls_section(
            'primekit_elementor_blog_grid_excerpt_style_section',
            [
                'label' => esc_html__('Excerpt Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_blog_grid_excerpt_switch' => 'yes'
                ],
            ]
        );

        //blog excerpt typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_grid_excerpt_typography',
                'label' => esc_html__('Excerpt Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-blog-grid-excerpt',
            ]
        );

        // blog excerpt color
        $this->add_control(
            'primekit_elementor_blog_grid_excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3d3d3d',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-grid-excerpt p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // end excerpt style

        // button style section
        $this->start_controls_section(
            'primekit_elementor_blog_grid_button_style_section',
            [
                'label' => esc_html__('Button Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_blog_grid_read_more_switch' => 'yes'
                ],
            ]
        );

        //button typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_grid_button_typography',
                'label' => esc_html__('Button Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-blog-more',
            ]
        );

        $this->start_controls_tabs(
            'primekit_elementor_blog_grid_button_style_tabs'
        );

        $this->start_controls_tab(
            'primekit_elementor_blog_grid_button_style_normal_tab',
            [
                'label' => esc_html__('Button Color', 'primekit-addons'),
            ]
        );

        // Button color
        $this->add_control(
            'primekit_elementor_blog_grid_button_color',
            [
                'label' => esc_html__('Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59a818',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-more a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-blog-more a:after' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'primekit_elementor_blog_grid_button_style_hover_tab',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
            ]
        );

        // Button Hover color
        $this->add_control(
            'primekit_elementor_blog_grid_button_hover_color',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3d3d3d',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-more a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-blog-more a:hover:after' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section(); // end button style

        // Pagination style section
        $this->start_controls_section(
            'primekit_elementor_blog_grid_pagination_style_section',
            [
                'label' => esc_html__('Pagination Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_blog_grid_pagination' => 'yes'
                ],
            ]
        );
        //Pagination alignment
        $this->add_responsive_control(
            'primekit_elementor_blog_grid_pagination_alignment',
            [
                'label' => esc_html__('Alignment', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'primekit-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'primekit-addons'),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'primekit-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blog-grid .primekit-ele-pagination-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        //Pagination typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_grid_pagination_typography',
                'label' => esc_html__('Pagination Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-pagination-container',
            ]
        );

        // Pagination padding
        $this->add_responsive_control(
            'primekit_elementor_blog_grid_pagination_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 6,
                    'right' => 10,
                    'bottom' => 6,
                    'left' => 10,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-pagination-container a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-ele-pagination-container .current' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Pagination margin
        $this->add_responsive_control(
            'primekit_elementor_blog_grid_pagination_spacing',
            [
                'label' => esc_html__('Spacing', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-pagination-container' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Group border control for pagination
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'primekit_elementor_blog_grid_pagination_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-pagination-container a,{{WRAPPER}} .primekit-ele-pagination-container .current',
            ]
        );

        // Border radius control for pagination
        $this->add_responsive_control(
            'primekit_elementor_blog_grid_pagination_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-pagination-container a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-ele-pagination-container .current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'primekit_elementor_blog_grid_pagination_style_tabs'
        );

        $this->start_controls_tab(
            'primekit_elementor_blog_grid_pagination_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'primekit-addons'),
            ]
        );

        // Text color
        $this->add_control(
            'primekit_elementor_blog_grid_pagi_text_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-pagination-container a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Text Bg color
        $this->add_control(
            'primekit_elementor_blog_grid_pagi_text_bg_color',
            [
                'label' => esc_html__('Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#eeeeee',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-pagination-container a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'primekit_elementor_blog_grid_pagination_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'primekit-addons'),
            ]
        );

        // Hover color
        $this->add_control(
            'primekit_elementor_blog_grid_pagi_text_hover_color',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-pagination-container a:hover, {{WRAPPER}} .primekit-ele-pagination-container .current' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Hover bg color
        $this->add_control(
            'primekit_elementor_blog_grid_pagi_text_hover_bg_color',
            [
                'label' => esc_html__('Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59a818',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-pagination-container a:hover, {{WRAPPER}} .primekit-ele-pagination-container .current' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Hover border color
        $this->add_control(
            'primekit_elementor_blog_grid_pagi_text_hover_border_color',
            [
                'label' => esc_html__('Hover Border Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59a818',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-pagination-container a:hover, {{WRAPPER}} .primekit-ele-pagination-container .current' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section(); // end pagination style

    }

    //get blog category
    private function primekit_get_blog_categories()
    {
        $categories = get_categories();
        $options = ['all' => 'All Categories'];

        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }

        return $options;
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'RenderView.php';
    }
}