<?php
namespace PrimeKit\Frontend\Elementor\Widgets\CommentForm;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-comment-form';
    }
    
    public function get_title()
    {
        return esc_html__('Comment Form', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-commenting-o primekit-addons-icon';
    }
    
    public function get_categories()
    {
        return ['primekit-category'];
    }
    
    public function get_keywords()
    {
        return ['prime', 'comment', 'form'];
    }
    

    /**
     * Register the widget controls.
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {

        // Comment form style section
        $this->start_controls_section(
            'primekit_elementor_comment_form_style_section',
            [
                'label' => esc_html__('Form Content Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
            );

        // Title color
        $this->add_control(
            'primekit_elementor_comment_form_title_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3d3d3d',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-comment-form h3.comments-title, .primekit-ele-comment-form h3#reply-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        //Title Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_comment_form_title_typography',
                'label' => esc_html__('Title Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-comment-form h3.comments-title, .primekit-ele-comment-form h3#reply-title',
            ]
        );


        // User name color
        $this->add_control(
            'primekit_elementor_comment_form_user_name_color',
            [
                'label' => esc_html__('User Name Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3d3d3d',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-comment-form .fn a' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        //User name Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_comment_user_name_typography',
                'label' => esc_html__('User Name Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-comment-form .fn',
            ]
        );

         // Meta Data color
         $this->add_control(
            'primekit_elementor_comment_form_meta_data_color',
            [
                'label' => esc_html__('Meta Data Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3d3d3d',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-comment-form .comment-metadata a' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

          //Meta Typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_comment_meta_data_typography',
                'label' => esc_html__('Meta Data Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-comment-form .comment-metadata a',
            ]
        );

        // text color
                $this->add_control(
                    'primekit_elementor_comment_form_text_color',
                    [
                        'label' => esc_html__('Text Color', 'primekit-addons'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#444444',
                        'selectors' => [
                            '{{WRAPPER}} .primekit-ele-comment-form .comment-content, .primekit-ele-comment-form .comment-content a, .primekit-ele-comment-form .comment-notes, .primekit-ele-comment-form .logged-in-as, .primekit-ele-comment-form .logged-in-as a, .primekit-ele-comment-form label' => 'color: {{VALUE}} !important;',
                        ],
                    ]
                );

         //Text Typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_comment_text_typography',
                'label' => esc_html__('Text Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-comment-form .comment-content',
            ]
        );
       
        $this->end_controls_section();

// reply button style 
		$this->start_controls_section(
			'primekit_elementor_comment_form_reply_button_style_section',
			[
				'label' => esc_html__( 'Reply Button', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        //Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_form_reply_button_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-comment-form .reply a',
            ]
        );

        $this->start_controls_tabs(
			'primekit_elementor_comment_form_reply_button_style_tabs'
		);

		$this->start_controls_tab(
			'primekit_elementor_comment_form_reply_button_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'primekit-addons' ),
			]
		);

		$this->add_control(
			'primekit_elementor_comment_form_reply_button_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-comment-form .reply a' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'primekit_elementor_comment_form_reply_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-comment-form .reply a' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'primekit_elementor_comment_form_reply_button_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'primekit-addons' ),
			]
		);
	
		$this->add_control(
			'primekit_elementor_comment_form_reply_btn_hover_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-comment-form .reply a:hover' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'primekit_elementor_comment_form_reply_btn_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-comment-form .reply a:hover' => 'background-color: {{VALUE}}!important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
        
        // Comment button style 
		$this->start_controls_section(
			'primekit_elementor_comment_form_button_style_section',
			[
				'label' => esc_html__( 'Comment Button', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        //Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_form_button_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-comment-form .form-submit input[type="submit"]',
            ]
        );


        $this->start_controls_tabs(
			'primekit_elementor_comment_form_button_style_tabs'
		);

		$this->start_controls_tab(
			'primekit_elementor_comment_form_button_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'primekit-addons' ),
			]
		);

		$this->add_control(
			'primekit_elementor_comment_form_button_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-comment-form .form-submit input[type="submit"]' => 'color: {{VALUE}} !important;',
				],
			]
		);

        $this->add_control(
			'primekit_elementor_comment_form_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-comment-form .form-submit input[type="submit"]' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'primekit_elementor_comment_form_button_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'primekit-addons' ),
			]
		);
	
		$this->add_control(
			'primekit_elementor_comment_form_btn_hover_color',
			[
				'label' => esc_html__( 'Color', 'primekit-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-comment-form .form-submit input[type="submit"]:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

        $this->add_control(
			'primekit_elementor_comment_form_btn_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-comment-form .form-submit input[type="submit"]:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section(); // end content style
        

    }



 

    /**
     * Render the widget output on the frontend.
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        //load render view to show widget output on frontend/website.
        include 'RenderView.php';
    }
}

