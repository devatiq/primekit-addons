<?php
namespace PrimeKit\Frontend\Elementor\Widgets\BlogPostFancy;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

class Main extends Widget_Base
{

    public function get_name()
    {
        return 'primekit-elementor-blogpost';
    }

    public function get_title()
    {
        return esc_html__('Blog Posts Fancy', 'primekit-addons');
    }

    public function get_icon()
    {
        return 'eicon-posts-group';
    }

    public function get_categories()
    {
        return ['primekit-category'];
    }

    public function get_keywords()
    {
        return ['prime', 'blog', 'post', 'fancy'];
    }


    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_blog_setting',
            [
                'label' => esc_html__('Blog Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //category selection
        $this->add_control(
            'primekit_elementor_blog_category_fancy',
            [
                'label' => esc_html__('Select Category', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->primekit_blog_fancy_categories(),
                'default' => 'all',
                'label_block' => true,
                'multiple' => false,
            ]
        );

        //blog date on/off switch
        $this->add_control(
            'primekit_elementor_blog_date_switch',
            [
                'label' => esc_html__('Date', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //blog comment on/off switch
        $this->add_control(
            'primekit_elementor_blog_comment_switch',
            [
                'label' => esc_html__('Comments', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // blog read more button on/off switch
        $this->add_control(
            'primekit_elementor_blog_read_more_switch',
            [
                'label' => esc_html__('Read More', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //Read more text
        $this->add_control(
            'primekit_elementor_blog_read_more_text',
            [
                'label' => esc_html__('Read More Text', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'primekit-addons'),
                'placeholder' => esc_html__('Type read more text', 'primekit-addons'),
                'condition' => [
                    'primekit_elementor_blog_read_more_switch' => 'yes',
                ],
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


        $this->end_controls_section(); //end blog setting control

        // blog content style section
        $this->start_controls_section(
            'primekit_elementor_blog_content_style_section',
            [
                'label' => esc_html__('Blog Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //blog gap
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_gap',
            [
                'label' => esc_html__('Gap', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blogs' => 'gap: {{SIZE}}{{UNIT}};',
                ]
            ],
        );

        //flex direction choose
        $this->add_responsive_control(
            'primekit_elementor_blog_flex_direction',
            [
                'label' => esc_html__('Layout Direction', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Row', 'primekit-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Row Reverse', 'primekit-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-blogs' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );


        //blog info typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_info_typography',
                'label' => esc_html__('Meta Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-single-blog-info a',
            ]
        );
        // blog info color
        $this->add_control(
            'primekit_elementor_blog_info_color',
            [
                'label' => esc_html__('Meta Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-info a' => 'color: {{VALUE}};',
                ],
            ]
        );
        // blog info icon color
        $this->add_control(
            'primekit_elementor_blog_info_icon_color',
            [
                'label' => esc_html__('Meta Icon Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-info i' => 'color: {{VALUE}};',
                ],
            ]
        );
        // blog info icon size
        $this->add_responsive_control(
            'primekit_elementor_blog_info_icon_size',
            [
                'label' => esc_html__('Meta Icon Size', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-info i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // blog title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_title_typography',
                'label' => esc_html__('Title Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-single-blog-title h2 a',
            ]
        );
        // blog title color
        $this->add_control(
            'primekit_elementor_blog_title_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-title h2 a' => 'color: {{VALUE}};',
                ],
            ]
        );
        // blog read more button typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_blog_read_more_typography',
                'label' => esc_html__('Read More Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-single-blog-button a',
            ]
        );
        // blog read more button color
        $this->add_control(
            'primekit_elementor_blog_read_more_color',
            [
                'label' => esc_html__('Read More Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-button a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // end: Section


        // Start section for featured post
        $this->start_controls_section(
            'primekit_elementor_fancy_featured_post_section',
            [
                'label' => esc_html__('Featured Post', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Content width control
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_content_width',
            [
                'label' => esc_html__('Content Width', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-first .primekit-ele-single-blog-content-area' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Content padding control
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_content_padding',
            [
                'label' => esc_html__('Content Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-first .primekit-ele-single-blog-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Content background control
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'primekit_elementor_fancy_blog_content_background',
                'label' => esc_html__('Content Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-ele-single-first .primekit-ele-single-blog-content-area',
            ]
        );

        //content border radius
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-first .primekit-ele-single-blog-content-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Content margin-top control
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_content_margin_top',
            [
                'label' => esc_html__('Content Margin Top', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    'em' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-first .primekit-ele-single-blog-content-area' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Image Height control
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_image_height',
            [
                'label' => esc_html__('Image Height', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-area.primekit-ele-single-first .primekit-ele-single-blog-thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //image border radius
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_image_border_radius',
            [
                'label' => esc_html__('Image Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-area.primekit-ele-single-first .primekit-ele-single-blog-thumbnail img' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
                ],
            ],
        );

        // Image Width control
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_image_width',
            [
                'label' => esc_html__('Image Width', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-area.primekit-ele-single-first .primekit-ele-single-blog-thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        // End section for featured post
        $this->end_controls_section();

        // Start new section for Blog List Style settings
        $this->start_controls_section(
            'primekit_elementor_fancy_blog_list_style',
            [
                'label' => esc_html__('Blog List', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'primekit_elementor_fancy_blog_blog_post_count',
            [
                'label' => esc_html__('Post Count', 'primekit-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 3,
                'default' => 3,
                'description' => esc_html__('Set the number of posts to show', 'primekit-addons'),
            ]
        );

        // Padding control
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_list_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-rem-posts .primekit-ele-single-blog-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //content background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'primekit_elementor_fancy_blog_list_background',
                'label' => esc_html__('Content Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-ele-single-blog-rem-posts .primekit-ele-single-blog-content-area',
            ]
        );

        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_list_gap',
            [
                'label' => esc_html__('Gap Between Posts', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-rem-posts' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        //fancy blog list content radius
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_list_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-rem-posts .primekit-ele-single-blog-content-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        // Width control
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_list_width',
            [
                'label' => esc_html__('Width', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'vw'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-rem-posts .primekit-ele-single-blog-content-area' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Top control
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_list_top',
            [
                'label' => esc_html__('Top Position', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-rem-posts .primekit-ele-single-blog-content-area' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Left control
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_list_left',
            [
                'label' => esc_html__('Left Position', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-rem-posts .primekit-ele-single-blog-content-area' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Image width control
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_list_image_width',
            [
                'label' => esc_html__('Thumbnail Width', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-rem-posts .primekit-ele-single-blog-thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Image height control
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_list_image_height',
            [
                'label' => esc_html__('Thumbnail Height', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-rem-posts .primekit-ele-single-blog-thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-ele-single-blog-rem-posts .primekit-ele-single-blog-thumbnail' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //thumbnail radius
        $this->add_responsive_control(
            'primekit_elementor_fancy_blog_list_thumbnail_radius',
            [
                'label' => esc_html__('Thumbnail Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-single-blog-rem-posts .primekit-ele-single-blog-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        // End section
        $this->end_controls_section();


    }

    //get blog category
    private function primekit_blog_fancy_categories()
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
