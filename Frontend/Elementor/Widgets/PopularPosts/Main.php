<?php
namespace PrimeKit\Frontend\Elementor\Widgets\PopularPosts;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-PopularPosts';
    }
    
    public function get_title()
    {
        return esc_html__('Popular Posts', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-posts-group primekit-addons-icon';
    }
    
    public function get_categories()
    {
        return ['primekit-category'];
    }
    
    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_popular_posts_setting',
            [
                'label' => esc_html__('Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        // Add control for selecting popular based on (Comments or Views)
        $this->add_control(
            'primekit_popular_posts_views',
            [
                'label' => esc_html__('Popular Based on', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'comments' => esc_html__('Comments', 'primekit-addons'),
                    'views' => esc_html__('Views', 'primekit-addons'),
                ],
                'default' => 'comments',
                'description' => esc_html__('Select Popular Based on', 'primekit-addons'),
            ]
        );


        // Add control for selecting post limit
        $this->add_control(
            'primekit_popular_posts_limit',
            [
                'label' => esc_html__('Post Limit', 'primekit-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => 6,
                'description' => esc_html__('Select the number of posts to show', 'primekit-addons'),
            ]
        );

        // Add control for category display switch
        $this->add_control(
            'category_display_switch',
            [
                'label' => esc_html__('Display Category', 'primekit-addons'),
                'description' => esc_html__('Choose to display or hide category labels.', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'true',
                'default' => 'true',
            ]
        );

        // Add control for selecting random color switch
        $this->add_control(
            'category_random_color_switch',
            [
                'label' => esc_html__('Random Color?', 'primekit-addons'),
                'description' => esc_html__('display random background color for category?', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'true',
                'default' => 'false',
                'condition' => [
                    'category_display_switch' => 'true',
                ],
            ]
        );
        // Add control for selecting comments or views to display
        $this->add_control(
            'display_fields',
            [
                'label' => esc_html__('Display Meta', 'primekit-addons'),
                'description' => esc_html__('Select whether to display comments, views.', 'primekit-addons'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => [
                    'comments' => esc_html__('Comments', 'primekit-addons'),
                    'views' => esc_html__('Views', 'primekit-addons'),
                ],
                'default' => ['comments', 'views'],
            ]
        );

        // End section
        $this->end_controls_section();

        //start style section
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Add control for alignment
        $this->add_responsive_control(
            'popular_posts_alignment',
            [
                'label' => esc_html__('Alignment', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'column',
                'options' => [
                    'column' => [
                        'title' => esc_html__('Column', 'primekit-addons'),
                        'icon' => 'eicon-arrow-down',
                    ],
                    'row' => [
                        'title' => esc_html__('Row', 'primekit-addons'),
                        'icon' => 'eicon-arrow-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-popular-posts-wrapper' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        // Add control for gap
        $this->add_responsive_control(
            'popular_posts_gap',
            [
                'label' => esc_html__('Gap', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}}  .primekit-popular-posts-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Add control for thumbnail alignment
        $this->add_responsive_control(
            'popular_posts_thumbnail_alignment',
            [
                'label' => esc_html__('Thumbnail Alignment', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Left', 'primekit-addons'),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Right', 'primekit-addons'),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'column' => [
                        'title' => esc_html__('Top', 'primekit-addons'),
                        'icon' => 'eicon-arrow-up',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__('Bottom', 'primekit-addons'),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'default' => 'row',
                'selectors' => [
                    '{{WRAPPER}}  .primekit-popular-posts-wrapper .primekit-popular-posts-single-post' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        // Add control for contents alignment
        $this->add_responsive_control(
            'popular_posts_contents_alignment',
            [
                'label' => esc_html__('Contents Alignment', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'primekit-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'primekit-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'primekit-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'condition' => [
                    'popular_posts_thumbnail_alignment' => ['column', 'column-reverse'],
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-posts-single-post' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        // Add control for text alignment
        $this->add_responsive_control(
            'popular_posts_text_alignment',
            [
                'label' => esc_html__('Text Alignment', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'primekit-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'primekit-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'primekit-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-post-contents' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'popular_posts_thumbnail_alignment' => ['column', 'column-reverse'],
                ],
            ]
        );

        // Add control for padding
        $this->add_responsive_control(
            'popular_posts_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-posts-single-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Add control for border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'popular_posts_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-posts-single-post',
            ]
        );

        // Add control for border radius
        $this->add_control(
            'popular_posts_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-posts-single-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        //start style section for hover
        $this->start_controls_tabs('popular_posts_style_tabs');

        // Normal tab
        $this->start_controls_tab(
            'popular_posts_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'primekit-addons'),
            ]
        );

        //add control for background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'popular_posts_background',
                'label' => esc_html__('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-posts-single-post',
            ]
        );

        $this->end_controls_tab(); // End normal tab

        // Hover tab
        $this->start_controls_tab(
            'popular_posts_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'primekit-addons'),
            ]
        );

        //add control for hover background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'popular_posts_hover_background',
                'label' => esc_html__('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-posts-single-post:hover',
            ]
        );

        $this->end_controls_section(); // End style section

        //start style section for contents
        $this->start_controls_section(
            'style_popular_posts_contents',
            [
                'label' => esc_html__('Contents', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //add control for category color
        $this->add_control(
            'category_color',
            [
                'label' => esc_html__('Category Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-post-contents .primekit-popular-post-cat a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'category_display_switch' => 'true',
                ],
                'default' => '#ffffff',
            ]
        );

        //add control for category typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => esc_html__('Category Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-post-contents .primekit-popular-post-cat a',
                'condition' => [
                    'category_display_switch' => 'true',
                ],
            ]
        );

        //add control for category background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'category_background',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-post-contents .primekit-popular-post-cat a',
                'condition' => [
                    'category_display_switch' => 'true',
                    'category_random_color_switch!' => 'true',
                ],
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Category Background', 'primekit-addons'),
                        'default' => 'classic',
                    ],
                    'color' => [
                        'label' => esc_html__('Background Color', 'primekit-addons'),
                        'default' => '#5A49F8',
                    ],
                ],
            ]
        );


        //add control for title color
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-post-contents .primekit-popular-post-title a' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'default' => '#010218',
            ]
        );

        //add control for title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-post-contents .primekit-popular-post-title',
            ]
        );

        //add control for meta color
        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__('Meta Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-post-contents .primekit-popular-post-meta span' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'default' => '#686868',
            ]
        );

        //add control for meta typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__('Meta Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-popular-posts-wrapper .primekit-popular-post-contents .primekit-popular-post-meta span',
            ]
        );

        $this->end_controls_section(); // End style section

        //start style section for thumbnail
        $this->start_controls_section(
            'section_thumbnail_style',
            [
                'label' => esc_html__('Thumbnail', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );   

        //add control for thumbnail border radius
        $this->add_responsive_control(
            'thumbnail_boder_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-popular-post-thumbanil img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'top' => 5,
                    'right' => 5,
                    'bottom' => 5,
                    'left' => 5,
                ],
            ]
        );

        //add control for thumbnail border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thumbnail_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-popular-post-thumbanil img',              
            ]
        );

        $this->end_controls_section(); // End style section

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
    private function generate_random_color()
    {
        return sprintf('#%06X', wp_rand(0, 0xFFFFFF));
    }
    
    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'RenderView.php';
    }
}
