<?php
namespace PrimeKit\Frontend\Elementor\Widgets\FetchPosts;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

class Main extends Widget_Base
{

    public function get_name()
    {
        return 'primekit-fetch-posts';
    }
    
    public function get_title()
    {
        return esc_html__('Fetch Posts', 'primekit-addons');
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
        return ['prime', 'posts', 'fetch posts', 'api posts'];
    }
    

    /**
     * Register the widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        // Add a control for the number of posts to fetch
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Settings', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Add control for selecting layout type (list or grid)
        $this->add_control(
            'layout_type',
            [
                'label' => __('Layout Type', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'list',
                'options' => [
                    'list' => __('List', 'primekit-addons'),
                    'grid' => __('Grid', 'primekit-addons'),
                ],
            ]
        );

        // Add control for selecting number of columns
        $this->add_responsive_control(
            'grid_columns',
            [
                'label' => __('Columns', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'desktop_default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'options' => [
                    1 => __('1 Column', 'primekit-addons'),
                    2 => __('2 Columns', 'primekit-addons'),
                    3 => __('3 Columns', 'primekit-addons'),
                    4 => __('4 Columns', 'primekit-addons'),
                ],
                'condition' => [
                    'layout_type' => 'grid',
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-posts-grid.primekit-fetch-posts-list' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_control(
            'fetch_posts_count',
            [
                'label' => __('Number of Posts', 'primekit-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
        // Add control for website URL
        $this->add_control(
            'website_url',
            [
                'label' => __('External Website URL', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __('https://example.com', 'primekit-addons'),
                'description' => __('Enter the full URL of the external WordPress website you want to fetch posts from. Make sure the site uses the default WordPress REST API and includes a valid URL with HTTP/HTTPS protocol. Example: https://example.com. Do not include any query parameters, as the plugin will handle them automatically.', 'primekit-addons'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'pagination_switch',
            [
                'label' => __('Show Pagination', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'primekit-addons'),
                'label_off' => __('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section(); // End content section



        // General Style Section
        $this->start_controls_section(
            'general_style_section',
            [
                'label' => __('General', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'general_background',
                'label' => __('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-fetch-single-post',
            ]
        );

        $this->add_control(
            'general_padding',
            [
                'label' => __('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'general_border',
                'label' => __('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-fetch-single-post',
            ]
        );

        $this->add_control(
            'general_border_radius',
            [
                'label' => __('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'general_gap',
            [
                'label' => __('Gap', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-posts-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); // End general style section


        // Thumbnail Style Section
        $this->start_controls_section(
            'thumbnail_style_section',
            [
                'label' => __('Thumbnail', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'thumbnail_alignment',
            [
                'label' => __('Image Alignment', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row-reverse' => [
                        'title' => __('Right', 'primekit-addons'),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'row' => [
                        'title' => __('Left', 'primekit-addons'),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'column' => [
                        'title' => __('Top', 'primekit-addons'),
                        'icon' => 'eicon-arrow-up',
                    ],
                    'column-reverse' => [
                        'title' => __('Bottom', 'primekit-addons'),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_width',
            [
                'label' => __('Width', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 2000,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-thumb img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_height',
            [
                'label' => __('Height', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-thumb img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thumbnail_border',
                'label' => __('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-fetch-single-post-thumb img',
            ]
        );

        $this->add_responsive_control(
            'thumbnail_margin',
            [
                'label' => __('Margin', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_padding',
            [
                'label' => __('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-thumb img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'thumbnail_border_radius',
            [
                'label' => __('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); // End thumbnail style section

        // Style Section
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => __('Content', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label' => __('Category Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-cat > p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'category_background',
                'label' => __('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-fetch-single-post-cat > p',
                'fields_options' => [
                    'background' => [
                        'label' => __('Category Background', 'primekit-addons'),
                    ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => __('Category Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-fetch-single-post-cat > p',
            ]
        );

        $this->add_control(
            'category_padding',
            [
                'label' => __('Category Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-cat > p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_title_color',
            [
                'label' => __('Post Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-title h2 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'post_title_typography',
                'label' => __('Post Title Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-fetch-single-post-title h2',
            ]
        );

        $this->add_control(
            'post_date_color',
            [
                'label' => __('Post Date Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#888',
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-info p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-fetch-single-post-info svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_excerpt_color',
            [
                'label' => __('Post Excerpt Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666',
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_excerpt_typography',
                'label' => __('Post Excerpt Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-fetch-single-post-content p',
            ]
        );

        $this->end_controls_section(); // End style section


        // Button Style Section
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => __('Button', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-fetch-single-post-btn a',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label' => __('Width', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-btn a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-fetch-single-post-btn a',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('button_tabs');
        $this->start_controls_tab(
            'button_normal_tab',
            [
                'label' => __('Normal', 'primekit-addons'),
            ]
        );
        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-btn a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'label' => __('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-fetch-single-post-btn a',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => __('Hover', 'primekit-addons'),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-single-post-btn a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_background',
                'label' => __('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-fetch-single-post-btn a:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section(); // End button style section

        $this->start_controls_section(
            'pagination_style_section',
            [
                'label' => __('Pagination', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pagination_switch' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_alignment',
            [
                'label' => __('Alignment', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'primekit-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'primekit-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'primekit-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-posts-pagination' => 'justify-content: {{VALUE}};',
                ],
                'default' => 'center',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pagination_typography',
                'label' => __('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-fetch-posts-pagination a',
            ]
        );
        $this->add_responsive_control(
            'pagination_padding',
            [
                'label' => __('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-posts-pagination a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-fetch-posts-pagination .fetch-posts-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-fetch-posts-pagination .fetch-posts-current-page' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_gap',
            [
                'label' => __('Gap', 'primekit-addons'),
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
                    '{{WRAPPER}} .primekit-fetch-posts-pagination' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pagination_border',
                'label' => __('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-fetch-posts-pagination a',
            ]
        );

        $this->add_control(
            'pagination_border_radius',
            [
                'label' => __('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-posts-pagination a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('pagination_tabs');

        $this->start_controls_tab(
            'pagination_normal_tab',
            [
                'label' => __('Normal', 'primekit-addons'),
            ]
        );
        $this->add_control(
            'pagination_normal_text_color',
            [
                'label' => __('Text Color', 'primekit-addons'),
                'default' => '#333',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-posts-pagination a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pagination_normal_background',
                'label' => __('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-fetch-posts-pagination a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pagination_hover_tab',
            [
                'label' => __('Hover', 'primekit-addons'),
            ]
        );
        $this->add_control(
            'pagination_hover_text_color',
            [
                'label' => __('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,       
                'default' => '#fff',         
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-posts-pagination a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pagination_hover_background',
                'label' => __('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-fetch-posts-pagination a:hover',
            ]
        );

        $this->add_control(
            'pagination_hover_border_color',
            [
                'label' => __('Border Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'pagination_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-posts-pagination a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'pagination_active_tab',
            [
                'label' => __('Active', 'primekit-addons'),
            ]
        );
        $this->add_control(
            'pagination_active_text_color',
            [
                'label' => __('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,     
                'default' => '#fff',           
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-posts-pagination .fetch-posts-current-page' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pagination_active_background',
                'label' => __('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-fetch-posts-pagination .fetch-posts-current-page',
            ]
        );

        $this->add_control(
            'pagination_active_border_color',
            [
                'label' => __('Border Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'pagination_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-fetch-posts-pagination .fetch-posts-current-page' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }



    /**
     * Retrieve category names from the embedded data based on category IDs.
     *
     * This function checks the provided embedded data for category terms and
     * returns an array of category names that match the given category IDs.
     *
     * @param array $category_ids An array of category IDs to match against.
     * @param object $embedded_data The embedded data object containing category terms.
     * @return array An array of category names corresponding to the provided IDs.
     */
    private function get_category_names($category_ids, $embedded_data)
    {
        $category_names = [];

        // Check if categories are available in the _embedded data
        if (isset($embedded_data->{'wp:term'}[0]) && is_array($embedded_data->{'wp:term'}[0])) {
            foreach ($embedded_data->{'wp:term'}[0] as $term) {
                if (in_array($term->id, $category_ids)) {
                    $category_names[] = $term->name; // Get category name from _embedded data
                }
            }
        }

        return $category_names;
    }

    /**
     * Generates and outputs pagination links for blog posts.
     *
     * This function generates pagination links for navigating between multiple pages
     * of blog posts. It calculates the range of page numbers to display and includes
     * ellipses for skipped ranges if necessary. The pagination links are based on
     * the current page and total number of pages provided.
     *
     * @param int $total_pages The total number of pages available.
     * @param int $current_page The current page number being viewed.
     */
    private function primekit_get_blog_pagination($total_pages, $current_page)
    {
        if ($total_pages > 1) {
            // Ensure the global $wp variable is available
            global $wp;

            // Base URL for pagination (current page URL without the page parameter)
            $pagination_base_url = add_query_arg('primekit_page', false, home_url($wp->request));

            echo '<div class="primekit-fetch-posts-pagination">';

            // Define how many numbers to show at the beginning, end, and around the current page
            $range = 2; // Number of pages to show on each side of the current page
            $first_pages_count = 3; // Always show the first 3 pages
            $last_pages_count = 3; // Always show the last 3 pages

            // Show first few pages and last few pages
            if ($total_pages <= $first_pages_count + $last_pages_count + (2 * $range) + 1) {
                // If total pages are small, show all page numbers
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="fetch-posts-current-page">' . esc_html($i) . '</span>';
                    } else {
                        echo '<a href="' . esc_url(add_query_arg('primekit_page', $i, $pagination_base_url)) . '">' . esc_html($i) . '</a>';
                    }
                }
            } else {
                // Always show the first few pages
                for ($i = 1; $i <= $first_pages_count; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="fetch-posts-current-page">' . esc_html($i) . '</span>';
                    } else {
                        echo '<a href="' . esc_url(add_query_arg('primekit_page', $i, $pagination_base_url)) . '">' . esc_html($i) . '</a>';
                    }
                }

                // Add an ellipsis after the first few pages, if necessary
                if ($current_page > $first_pages_count + $range + 1) {
                    echo '<span class="fetch-posts-dots">...</span>';
                }

                // Show pages around the current page
                $start = max($first_pages_count + 1, $current_page - $range);
                $end = min($total_pages - $last_pages_count, $current_page + $range);

                for ($i = $start; $i <= $end; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="fetch-posts-current-page">' . esc_html($i) . '</span>';
                    } else {
                        echo '<a href="' . esc_url(add_query_arg('primekit_page', $i, $pagination_base_url)) . '">' . esc_html($i) . '</a>';
                    }
                }

                // Add an ellipsis before the last few pages, if necessary
                if ($current_page < $total_pages - $last_pages_count - $range) {
                    echo '<span class="fetch-posts-dots">...</span>';
                }

                // Always show the last few pages
                for ($i = $total_pages - $last_pages_count + 1; $i <= $total_pages; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="fetch-posts-current-page">' . esc_html($i) . '</span>';
                    } else {
                        echo '<a href="' . esc_url(add_query_arg('primekit_page', $i, $pagination_base_url)) . '">' . esc_html($i) . '</a>';
                    }
                }
            }

            echo '</div>';
        }

    }
    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'renderview.php';
    }
}