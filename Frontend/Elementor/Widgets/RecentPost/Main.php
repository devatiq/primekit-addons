<?php
namespace PrimeKit\Frontend\Elementor\Widgets\RecentPost;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-recent-post';
    }
    
    public function get_title()
    {
        return esc_html__('Recent Posts', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-bullet-list primekit-addons-icon';
    }
    
    public function get_categories()
    {
        return ['primekit-category'];
    }
    
    public function get_keywords()
    {
        return ['prime', 'recent', 'list', 'post'];
    }
    

    /**
     * Register the widget controls.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_recent_posts_setting',
            [
                'label' => esc_html__('Post Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //category selection
    $this->add_control(
        'primekit_elementor_recent_posts_post_category',
        [
            'label' => esc_html__( 'Select Category', 'primekit-addons' ),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'options' => $this->primekit_recent_post_categories(),
            'default' => 'all',
            'label_block' => true,
            'multiple' => false,
        ]
    );

        //number of post
        $this->add_control(
			'primekit_elementor_recent_posts_post_number',
			[
				'label' => esc_html__( 'Number of Posts', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['number'],
				'range' => [
					'number' => [
						'min' => 3,
						'max' => 30,
						'step' => 1,
					]
				],
				'default' => [
					'size' => 5,
				],
			]
		);


        //post date on/off switch
        $this->add_control(
            'primekit_elementor_recent_posts_date_switch',
            [
                'label' => esc_html__('Post Date', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //post comment on/off switch
        $this->add_control(
            'primekit_elementor_recent_posts_comment_switch',
            [
                'label' => esc_html__('Blog Comments', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

         //More Button
         $this->add_control(
            'primekit_elementor_recent_posts_read_more_switch',
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
            'primekit_elementor_recent_posts_read_more_text',
            [
                'label' => esc_html__('More Button Text', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More',
                'placeholder' => 'Enter read more text',
                'condition' => [
                    'primekit_elementor_recent_posts_read_more_switch' => 'yes',
                ],
            ]
        );

        $this->end_controls_section(); //end recent posts setting

        // recent post style
        $this->start_controls_section(
            'primekit_elementor_recent_posts_title_style_section',
            [
                'label' => esc_html__('Title Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

          //Post title typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_recent_posts_title_typography',
                'label' => esc_html__('Title Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-recent-post-title',
            ]
        );

        $this->start_controls_tabs(
			'primekit_elementor_recent_posts_title_style_tabs'
		);

		$this->start_controls_tab(
			'primekit_elementor_recent_posts_title_style_normal_tab',
			[
				'label' => esc_html__( 'Title Color', 'primekit-addons' ),
			]
		);

		// post title color
        $this->add_control(
            'primekit_elementor_recent_posts_title_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-recent-post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'primekit_elementor_recent_posts_title_style_hover_tab',
			[
				'label' => esc_html__( 'Hover Color', 'primekit-addons' ),
			]
		);

        // post title hover color
        $this->add_control(
            'primekit_elementor_recent_posts_title_hover_color',
            [
                'label' => esc_html__('Title Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59a818',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-recent-post-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section(); // end title style

        // post meta style section
        $this->start_controls_section(
            'primekit_elementor_recent_posts_meta_style_section',
            [
                'label' => esc_html__('Meta Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

          //post meta typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_recent_posts_meta_typography',
                'label' => esc_html__('Meta Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-recent-post-meta',
            ]
        );

        // post meta color
        $this->add_control(
            'primekit_elementor_recent_posts_meta_color',
            [
                'label' => esc_html__('Meta Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-recent-post-meta, .primekit-ele-recent-post-meta a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // end meta style

        // button style section
        $this->start_controls_section(
            'primekit_elementor_recent_posts_button_style_section',
            [
                'label' => esc_html__('Read More Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_recent_posts_read_more_switch' => 'yes'
                ],
            ]
        );

          //button typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_recent_posts_button_typography',
                'label' => esc_html__('Read More Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-recent-post-more',
            ]
        );

        $this->start_controls_tabs(
			'primekit_elementor_recent_posts_button_style_tabs'
		);

		$this->start_controls_tab(
			'primekit_elementor_recent_posts_button_style_normal_tab',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
			]
		);

		// Button color
        $this->add_control(
            'primekit_elementor_recent_posts_button_color',
            [
                'label' => esc_html__('Read More Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59a818',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-recent-post-more a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-recent-post-more a:after' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'primekit_elementor_recent_posts_button_style_hover_tab',
			[
				'label' => esc_html__( 'Hover Color', 'primekit-addons' ),
			]
		);

        // Button Hover color
        $this->add_control(
            'primekit_elementor_recent_posts_button_hover_color',
            [
                'label' => esc_html__('Read More Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3d3d3d',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-recent-post-more a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-recent-post-more a:hover:after' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
		$this->end_controls_tabs();
        $this->end_controls_section(); // end read more style
    }

     //get blog category
     private function primekit_recent_post_categories() {
        $categories = get_categories();
        $options = [ 'all' => 'All Categories' ];
    
        foreach ( $categories as $category ) {
            $options[ $category->term_id ] = $category->name;
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