<?php

namespace PrimeKit\Frontend\Elementor\Widgets\MailChimp;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Main extends Widget_Base
{

    private $settings;

    public function get_name()
    {
        return 'primekit-mailchimp';
    }

    public function get_title()
    {
        return __('MailChimp', 'primekit-addons');
    }

    public function get_icon()
    {
        return 'eicon-mailchimp primekit-addons-icon';
    }

    public function get_categories()
    {
        return ['primekit-category'];
    }

    // Use this method to register the scripts
    public function get_script_depends()
    {
        return ['primekit-mailchimp-newsletter']; // The handle for your script
    }

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        // Fetch Mailchimp API key from plugin settings
        $this->settings = get_option('primekit_mailchimp_options');
    }

    protected function register_controls()
    {
        // Check if API key is set
        $api_key = isset($this->settings['mailchimp_api_key']) ? sanitize_text_field($this->settings['mailchimp_api_key']) : '';


        if (empty($api_key)) {
            // Add notice control if API key is not set
            $this->start_controls_section(
                'section_notice',
                [
                    'label' => __('Notice', 'primekit-addons'),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );

            // Add notice control if API key is not set
            $this->add_control(
                'api_key_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<div style="color: red;">' . sprintf(
                        __('Mailchimp API key is not set. Please configure it in the <a href="%s" target="_blank">plugin settings</a>.', 'primekit-addons'),
                        esc_url(admin_url('admin.php?page=primekit_settings&tab=mailchimp'))
                    ) . '</div>',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
                ]
            );

            $this->end_controls_section();
        }

        // Add section for MailChimp settings
        $this->start_controls_section(
            'section_mailchimp',
            [
                'label' => __('MailChimp Settings', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Add control for form style
        $this->add_control(
            'mailchimp_form_style',
            [
                'label' => __('Form Style', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __('Default', 'primekit-addons'),
                    'inline' => __('Inline', 'primekit-addons'),
                ],
                'default' => 'default',
            ]
        );

        // Add control for MailChimp Audience List
        $this->add_control(
            'mailchimp_list_id',
            [
                'label' => __('Audience List', 'primekit-addons'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_mailchimp_lists(),
                'description' => sprintf(__('Select your Mailchimp Audience List. You can find more information %shere%s.', 'primekit-addons'), '<a href="https://mailchimp.com/help/find-audience-id/" target="_blank">', '</a>'),
                'dynamic' => ['active' => true],
            ]
        );

        // Toggle control to enable or disable name fields
        $this->add_control(
            'enable_name_fields',
            [
                'label' => __('Enable Name Fields', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'primekit-addons'),
                'label_off' => __('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        // Add control for email placeholder
        $this->add_control(
            'email_placeholder_text',
            [
                'label' => __('Email Placeholder', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Enter your email', 'primekit-addons'),
                'placeholder' => __('Enter your placeholder text', 'primekit-addons'),
                'label_block' => true,
            ]
        );

        // Add control for button type
        $this->add_control(
            'button_type',
            [
                'label' => __('Button Type', 'primekit-addons'),
                'condition' => [
                    'mailchimp_form_style' => 'inline',
                ],
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'text' => __('Text', 'primekit-addons'),
                    'icon' => __('Icon', 'primekit-addons'),
                ],
                'default' => 'text',
            ]
        );

        // Add control for submit button text
        $this->add_control(
            'submit_button_text',
            [
                'label' => __('Submit Button Text', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Subscribe', 'primekit-addons'),
                'placeholder' => __('Enter your submit button text', 'primekit-addons'),
                'label_block' => true,
                'condition' => [
                    'mailchimp_form_style' => 'default',
                ]
               
            ]
        );

        // Add control for submit button text
        $this->add_control(
            'submit_button_inline_text',
            [
                'label' => __('Submit Button Text', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Subscribe', 'primekit-addons'),
                'placeholder' => __('Enter your submit button text', 'primekit-addons'),
                'label_block' => true,
                'condition' => [
                    'mailchimp_form_style' => 'inline',
                    'button_type' => 'text',
                ]
               
            ]
        );

        // Add control for form alignment
        $this->add_control(
            'form_alignment',
            [
                'label' => __( 'Form Alignment', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'row',
                'options' => [
                    'row' => [
                        'title' => __( 'Row', 'primekit-addons' ),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'row-reverse' => [
                        'title' => __( 'Row Reverse', 'primekit-addons' ),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'column' => [
                        'title' => __( 'Column', 'primekit-addons' ),
                        'icon' => 'eicon-arrow-down',
                    ],
                    'column-reverse' => [
                        'title' => __( 'Column Reverse', 'primekit-addons' ),
                        'icon' => 'eicon-arrow-up',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-form' => 'flex-direction: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section(); // End Controls Section


        // Start Controls Section for MailChimp Form Style
        $this->start_controls_section(
            'primekit_mailchimp_section_style',
            [
                'label' => __('Style', 'primekit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Add control for first name width
        $this->add_responsive_control(
            'primekit_mailchimp_first_name_width',
            [
                'label' => __( 'First Name Width', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-fname' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'enable_name_fields' => 'yes',
                ],

            ]
        );

        // Add control for last name width
        $this->add_responsive_control(
            'primekit_mailchimp_last_name_width',
            [
                'label' => __( 'Last Name Width', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'enable_name_fields' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-lname' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        // Add control for email width
        $this->add_responsive_control(
            'primekit_mailchimp_email_width',
            [
                'label' => __( 'Email Width', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-email' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

  

        // Add control for gap
        $this->add_responsive_control(
            'primekit_mailchimp_gap',
            [
                'label' => __( 'Gap', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'condition' => [
                    'mailchimp_form_style!' => 'inline',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-mailchimp-single-form' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Add control for input padding
        $this->add_responsive_control(
            'primekit_mailchimp_input_padding',
            [
                'label' => __( 'Input Padding', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Add control for input border
        $this->add_responsive_control(
            'primekit_mailchimp_input_border_radius',
            [
                'label' => __( 'Input Border Radius', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Add control for input border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'primekit_mailchimp_input_border',
                'label' => __( 'Input Border', 'primekit-addons' ),
                'selector' => '{{WRAPPER}} #primekit-mailchimp-form input:not(.primekit-mailchimp-submit)',
            ]
        );


        $this->end_controls_section(); // end: Section


        // Start: Button Style
        $this->start_controls_section(
            'primekit_mailchimp_button_style',
            [
                'label' => __( 'Button', 'primekit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Add control for button padding
        $this->add_responsive_control(
            'primekit_mailchimp_button_padding',
            [
                'label' => __( 'Padding', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],        
                'condition' => [
                    'button_type!' => 'icon',
                ],  
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} button#primekit-mailchimp-inline-submit.primekit-mailchimp-inline-submit-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Add control for button border
        $this->add_responsive_control(
            'primekit_mailchimp_button_border_radius',
            [
                'label' => __( 'Border Radius', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} button#primekit-mailchimp-inline-submit.primekit-mailchimp-inline-submit-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #primekit-mailchimp-inline-submit svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Add control for button border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'primekit_mailchimp_button_border',
                'label' => __( 'Border', 'primekit-addons' ),
                'selector' => '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-submit, {{WRAPPER}} button#primekit-mailchimp-inline-submit.primekit-mailchimp-inline-submit-text, {{WRAPPER}} #primekit-mailchimp-inline-submit svg',
            ]
        );

        // Add control for button typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_mailchimp_button_typography',
                'label' => __( 'Typography', 'primekit-addons' ),
                'condition' => [
                    'button_type' => 'text',
                ],
                'selector' => '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-submit, {{WRAPPER}} button#primekit-mailchimp-inline-submit.primekit-mailchimp-inline-submit-text',
            ]
        );

        // Add control for button width
        $this->add_responsive_control(
            'primekit_mailchimp_submit_width',
            [
                'label' => __( 'Width', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ], 
                'condition' => [
                    'button_type' => 'text',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-submit' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} button#primekit-mailchimp-inline-submit.primekit-mailchimp-inline-submit-text' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        // Add control for button size
        $this->add_responsive_control(
            'primekit_mailchimp_submit_btn_size',
            [
                'label' => __( 'Button Size', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ], 
                'condition' => [
                    'button_type' => 'icon',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-inline-submit svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        // Add control for button right indent
        $this->add_responsive_control(
            'primekit_mailchimp_submit_btn_right_indent',
            [
                'label' => __( 'Button Right Indent', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'button_type' => 'icon',
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} button#primekit-mailchimp-inline-submit' => 'right: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        // Add control for button top indent
        $this->add_responsive_control(
            'primekit_mailchimp_submit_btn_top_indent',
            [
                'label' => __( 'Button Top Indent', 'primekit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'condition' => [
                    'button_type' => 'icon',
                ],
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -50,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} button#primekit-mailchimp-inline-submit' => 'top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        // Add control for button color
        $this->start_controls_tabs(
            'primekit_mailchimp_button_tabs'
        );

        // Normal tab
        $this->start_controls_tab(
            'primekit_mailchimp_button_normal',
            [
                'label' => __( 'Normal', 'primekit-addons' ),
            ]
        );

        // Add control for button text color
        $this->add_control(
            'primekit_mailchimp_button_text_color',
            [
                'label' => __( 'Text Color', 'primekit-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_type' => 'text',
                ],
                'default' => '#ffffff',               
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-submit' => 'color: {{VALUE}};',
                    '{{WRAPPER}} button#primekit-mailchimp-inline-submit.primekit-mailchimp-inline-submit-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Add control for button icon color
        $this->add_control(
            'primekit_mailchimp_button_icon_color',
            [
                'label' => __( 'Icon Color', 'primekit-addons' ),
                'condition' => [
                    'button_type' => 'icon',
                ],
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',               
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-inline-submit svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Add control for button background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'primekit_mailchimp_button_background',
                'label' => __( 'Background', 'primekit-addons' ),    
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],    
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => 'crimson',
                    ],
                ],     
                'selector' => '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-submit, {{WRAPPER}} button#primekit-mailchimp-inline-submit.primekit-mailchimp-inline-submit-text, {{WRAPPER}} #primekit-mailchimp-inline-submit svg',               
            ]
        );

        $this->end_controls_tab(); // Normal tab


        // Hover tab
        $this->start_controls_tab(
            'primekit_mailchimp_button_hover',
            [
                'label' => __( 'Hover', 'primekit-addons' ),
            ]
        );

        // Add control for button hover text color
        $this->add_control(
            'primekit_mailchimp_button_hover_text_color',
            [
                'label' => __( 'Text Color', 'primekit-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_type' => 'text',
                ],
                'default' => '#ffffff',            
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-submit:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} button#primekit-mailchimp-inline-submit.primekit-mailchimp-inline-submit-text:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Add control for button hover icon color
        $this->add_control(
            'primekit_mailchimp_button_hover_icon_color',
            [
                'label' => __( 'Icon Color', 'primekit-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_type' => 'icon',
                ],
                'default' => '#ffffff',            
                'selectors' => [
                    '{{WRAPPER}} #primekit-mailchimp-inline-submit:hover svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Add control for button hover background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'primekit_mailchimp_button_background_hover',
                'label' => __( 'Background', 'primekit-addons' ),    
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],     
                'selector' => '{{WRAPPER}} #primekit-mailchimp-form #primekit-mailchimp-submit:hover, {{WRAPPER}} button#primekit-mailchimp-inline-submit.primekit-mailchimp-inline-submit-text:hover, {{WRAPPER}} #primekit-mailchimp-inline-submit:hover svg',                
            ]
        );

        $this->end_controls_tab(); // Hover tab

        $this->end_controls_tabs(); // Button tab

        $this->end_controls_section(); // Button Style

        // Message Style
        $this->start_controls_section(
            'primekit_elementor_mailchimp_message_style',
            [
                'label' => __( 'Message Style', 'primekit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Add control for message text color
        $this->add_control(
            'primekit_elementor_mailchimp_message_text_color',
            [
                'label' => __( 'Text Color', 'primekit-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .primekit-mailchimp-response' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Add control for message typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_mailchimp_message_typography',
                'label' => __( 'Typography', 'primekit-addons' ),
                'selector' => '{{WRAPPER}} .primekit-mailchimp-response',
            ]
        );

        $this->end_controls_section(); // End Message Style Section

    }

    // Get mailchimp lists
    private function get_mailchimp_lists()
    {
        $api_key = isset($this->settings['mailchimp_api_key']) ? sanitize_text_field($this->settings['mailchimp_api_key']) : '';

        if (empty($api_key)) {
            return [];
        }

        $data_center = substr($api_key, strpos($api_key, '-') + 1);
        $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists';

        $response = wp_remote_get($url, [
            'timeout' => 15,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode('user:' . $api_key),
            ],
        ]);

        if (is_wp_error($response)) {
            return [];
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);

        if (json_last_error() !== JSON_ERROR_NONE || empty($data->lists)) {
            return [];
        }

        $lists = [];
        foreach ($data->lists as $list) {
            $lists[$list->id] = $list->name;
        }

        return $lists;
    }

    protected function render()
    {
       include 'renderview.php';
        
    }
}