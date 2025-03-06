<?php
namespace PrimeKit\Frontend\Elementor\Widgets\GravityForms;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;




class Main extends Widget_Base
{

    private $settings;

    public function get_name()
    {
        return 'primekit-GravityForms';
    }

    public function get_title()
    {
        return __('Gravity Forms', 'primekit-addons');
    }

    public function get_icon()
    {
        return 'eicon-form-horizontal primekit-addons-icon';
    }

    public function get_categories()
    {
        return ['primekit-category'];
    }


    protected function register_controls()
    {

        // Section for Gravity Forms
        $this->start_controls_section(
            'primekit_gravity_form_section',
            [
                'label' => __('Gravity Form', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        // gravity forms preview not visible in editor
        $this->add_control(
            'gravity_forms_preview_not_visible_in_editor',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('<strong>Note:</strong> Some changes may not be reflected in the editor mode. However, all modifications will be visible on the frontend. Please preview your changes directly on the webpage to see the updates.', 'primekit-addons'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );


        // Check if Gravity Forms is active
        if (class_exists('GFAPI')) {
            $forms = \GFAPI::get_forms();
            $options = [];

            // Populate the options array with form id and title
            if (!empty($forms)) {
                foreach ($forms as $form) {
                    $options[$form['id']] = $form['title'];
                }
            } else {
                $options[0] = esc_html__('No forms available', 'primekit-addons');
            }
            // Add control for Gravity Forms selection
            $this->add_control(
                'primekit_gf_form_id',
                [
                    'label' => esc_html__('Select Form', 'primekit-addons'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $options,
                    'default' => 0,
                    'description' => esc_html__('Select the Gravity Form you want to use', 'primekit-addons')
                ]
            );
        } else {
            // Show a message if Gravity Forms is missing
            $this->add_control(
                'gravity_forms_missing',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => __('<strong>Gravity Forms is not installed or activated.</strong> Please install and activate Gravity Forms, then refresh the page to continue using this widget.', 'primekit-addons'),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
                ]
            );

        }
        // Display form title
        $this->add_control(
            'display_title',
            [
                'label' => esc_html__('Display Form Title', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        // Display form description
        $this->add_control(
            'display_description',
            [
                'label' => esc_html__('Display Form Description', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        // Enable AJAX
        $this->add_control(
            'enable_ajax',
            [
                'label' => esc_html__('Enable AJAX', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__('Enable AJAX for the form submission.', 'primekit-addons'),
            ]
        );

        // Custom field values (optional)
        $this->add_control(
            'field_values',
            [
                'label' => esc_html__('Field Values (Optional)', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'description' => esc_html__('Pre-populate form fields with specific values (optional).', 'primekit-addons'),
            ]
        );

        // Tab index (optional)
        $this->add_control(
            'tabindex',
            [
                'label' => esc_html__('Tab Index', 'primekit-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
                'description' => esc_html__('Set a specific tab index for the form fields (optional).', 'primekit-addons'),
            ]
        );

        // Hide label
        $this->add_control(
            'hide_label',
            [
                'label' => esc_html__('Hide Form Label', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__('Hide the form label.', 'primekit-addons'),
            ]
        );

        //hide sub label
        $this->add_control(
            'hide_sub_label',
            [
                'label' => esc_html__('Hide Form Sub-Label', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__('Hide the form sub-label.', 'primekit-addons'),
            ]
        );

        $this->end_controls_section(); // End Section for Gravity Forms


        // Style Section for General
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => esc_html__('General', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // gravity forms preview not visible in editor     
        $this->add_control(
			'gravity_forms_preview_not_visible_in_editor_2',
			[
				'type' => \Elementor\Controls_Manager::ALERT,
				'alert_type' => 'warning',
				'heading' => esc_html__( 'Styling Alert', 'primekit-addons' ),
				'content' => esc_html__( 'Some changes may not be reflected in the editor mode. However, all modifications will be visible on the frontend. Please preview your changes directly on the webpage to see the updates.', 'primekit-addons' ),
			]
		);

        //wrapper background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'general_container_background',
                'label' => esc_html__('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper'
            ]
        );

        //wrapper padding
        $this->add_responsive_control(
            'general_container_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //wrapper border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'general_container_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper'
            ]
        );

        //wrapper border radius
        $this->add_control(
            'general_container_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //wrapper box shadow      
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_container_box_shadow',
                'label' => esc_html__('Box Shadow', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper',
            ]
        );

        //title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_title',
            ]
        );

        //title color
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        //description typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_description',
            ]
        );

        //description color
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();// End Style Section for General

        // Start Style Section for input fields labels
        $this->start_controls_section(
            'section_style_input_labels',
            [
                'label' => esc_html__('Input Fields Labels', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hide_label',
                            'operator' => '!==',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'hide_sub_label',
                            'operator' => '!==',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        //label typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gfield_label',
                'condition' => [
                    'hide_label!' => 'yes',
                ]
            ]
        );

        //label color
        $this->add_control(
            'label_color',
            [
                'label' => esc_html__('Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gfield_label' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'hide_label!' => 'yes',
                ],
            ]
        );

        //sub label typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_label_typography',
                'label' => esc_html__('Sub Label Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform-field-label:not(.gfield_label),{{WRAPPER}} .primekit-gravity-form-wrapper .gfield_description',
                'condition' => [
                    'hide_sub_label!' => 'yes',
                ],
            ]
        );

        //sub label color
        $this->add_control(
            'sub_label_color',
            [
                'label' => esc_html__('Sub Label Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform-field-label:not(.gfield_label)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gfield_description' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'hide_sub_label!' => 'yes',
                ],
            ]
        );

        //required sign color
        $this->add_control(
            'required_sign_color',
            [
                'label' => esc_html__('Required Sign Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gfield_required' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // End Style Section for input fields labels

        
        //start name field style section
        $this->start_controls_section(
            'name_field_style_section',
            [
                'label' => esc_html__('Name Field', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //name field width
        $this->add_responsive_control(
            'name_field_width',
            [
                'label' => esc_html__('Width', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .ginput_container_name input' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //name field padding
        $this->add_responsive_control(
            'name_field_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .ginput_container_name input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //name field border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'name_field_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .ginput_container_name input',
            ]
        );

        //name field border radius
        $this->add_control(
            'name_field_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .ginput_container_name input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); // End Style Section for name field

        //start form fields style section
        $this->start_controls_section(
            'form_fields_style_section',
            [
                'label' => esc_html__('Input Fields', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //input fields width
        $this->add_responsive_control(
            'form_fields_width',
            [
                'label' => esc_html__('Large Field Width', 'primekit-addons'),
                'description' => esc_html__('it\'s only work for large fields', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper input.large:not([type="submit"])' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //input fields width
        $this->add_responsive_control(
            'form_fields_textarea_width',
            [
                'label' => esc_html__('Textarea Field Width', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper textarea' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //input fields typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'form_fields_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper input:not([type="submit"]), {{WRAPPER}} .primekit-gravity-form-wrapper textarea',
            ]
        );

        //input fields background color
        $this->add_control(
            'form_fields_background_color',
            [
                'label' => esc_html__('Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper input:not([type="submit"]), {{WRAPPER}} .primekit-gravity-form-wrapper textarea' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        //input fields border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'form_fields_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper input:not([type="submit"]), {{WRAPPER}} .primekit-gravity-form-wrapper textarea',
            ]
        );

        //input fields border radius
        $this->add_responsive_control(
            'form_fields_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper input:not([type="submit"]), {{WRAPPER}} .primekit-gravity-form-wrapper textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //input fields padding
        $this->add_responsive_control(
            'form_fields_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper input:not([type="submit"]), {{WRAPPER}} .primekit-gravity-form-wrapper textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //input fields gap
        $this->add_responsive_control(
            'form_fields_gap',
            [
                'label' => esc_html__('Gap', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_fields' => 'gap: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section(); // End Style Section for form fields


        // Start Style Section for submit button
        $this->start_controls_section(
            'primekit_gravity_form_submit_button_style',
            [
                'label' => esc_html__('Submit Button', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //submit button typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer input.gform_button',
            ]
        );

        //submit button width
        $this->add_responsive_control(
            'button_width',
            [
                'label' => esc_html__('Width', 'primekit-addons'),
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
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer input.gform_button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        //submit button padding
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer input.gform_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        //submit button border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer input.gform_button',
            ]
        );


        //submit button border radius
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer input.gform_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //submit button position
        $this->add_responsive_control(
            'button_position',
            [
                'label' => esc_html__('Button Position', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'primekit-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'primekit-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'primekit-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer' => 'justify-content: {{VALUE}};',
                ],
            ]
        );


        //submit button margin
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer input.gform_button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //submit button box shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'label' => esc_html__('Box Shadow', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer input.gform_button',
            ]
        );

        // Start Style tabs
        $this->start_controls_tabs('button_tabs');

        // Start Normal tab
        $this->start_controls_tab('button_normal_tab', [
            'label' => esc_html__('Normal', 'primekit-addons'),
        ]);

        //submit button text color
        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer input.gform_button' => 'color: {{VALUE}};',
                ],
            ]
        );

        //submit button background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'label' => esc_html__('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer input.gform_button',
            ]
        );

        $this->end_controls_tab();// end:Normal

        // Hover
        $this->start_controls_tab('button_hover_tab', [
            'label' => esc_html__('Hover', 'primekit-addons'),
        ]);

        //submit button hover text color
        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer input.gform_button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        //submit button hover background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_background',
                'label' => esc_html__('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gform_footer input.gform_button:hover',
            ]
        );

        $this->end_controls_tab();// end:Hover

        $this->end_controls_tabs(); // end tabs

        $this->end_controls_section(); // End Style Section for submit button

        
        //Style Section for Radio
        $this->start_controls_section(
            'radio_style_section',
            [
                'label' => esc_html__('Radio Field', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //Radio label color
        $this->add_control(
            'radio_label_color',
            [
                'label' => esc_html__('Label Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gfield_radio .gform-field-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        //Radio label typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'radio_label_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gfield_radio .gform-field-label',
            ]
        );

        $this->end_controls_section(); // End Style Section for radio

        
        //Style Section for Checkbox Field
        $this->start_controls_section(
            'checkbox_style_section',
            [
                'label' => esc_html__('Checkbox Field', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //Checkbox label color
        $this->add_control(
            'checkbox_label_color',
            [
                'label' => esc_html__('Label Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gfield_checkbox .gform-field-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        //Checkbox label typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'checkbox_label_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gfield_checkbox .gform-field-label',
            ]
        );
        //checkbox input field size
        $this->add_control(
            'checkbox_input_field_size',
            [
                'label' => esc_html__('Input Size', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper input[type="checkbox"]' => 'transform: scale({{SIZE}});',
                ],
            ]
        );

        $this->end_controls_section(); // End Style Section for checkbox field

        //Style Section for Section Break
        $this->start_controls_section(
            'section_break_style_section',
            [
                'label' => esc_html__('Section Break', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //Section Break Border Color
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'section_break_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gfield--type-section',
            ]
        );


        //Section Break Border
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'section_break_box_shadow',
                'label' => esc_html__('Box Shadow', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gfield--type-section',
            ]
        );


        //Section Break Border Radius
        $this->add_responsive_control(
            'section_break_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gfield--type-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );


        //Section Break Margin
        $this->add_responsive_control(
            'section_break_margin',
            [
                'label' => esc_html__('Margin', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gfield--type-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        //Section Break Padding
        $this->add_control(
            'section_break_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gfield--type-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //Section Break Title Color
        $this->add_control(
            'section_break_title_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gsection_title' => 'color: {{VALUE}}',
                ],
            ]
        );

        //Section Break Title Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_break_title_typography',
                'label' => esc_html__('Title Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gsection_title',
            ]
        );

        //Section Break Description Color
        $this->add_control(
            'section_break_description_color',
            [
                'label' => esc_html__('Description Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gsection_description' => 'color: {{VALUE}}',
                ],
            ]
        );

        //Section Break Description Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_break_description_typography',
                'label' => esc_html__('Description Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_wrapper .gsection_description',
            ]
        );


        $this->end_controls_section(); //End Style Section for Section Break

        //Style Section for Page Break
        $this->start_controls_section(
            'section_style_page_break',
            [
                'label' => esc_html__('Page Break', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //Progressbar Color
        $this->add_control(
            'progressbar_color',
            [
                'label' => esc_html__('Progressbar Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gf_progressbar' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        //Active Progressbar Color
        $this->add_control(
            'active_progressbar_color',
            [
                'label' => esc_html__('Active Progressbar Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gf_progressbar .percentbar_blue' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        //Step Color
        $this->add_control(
            'page_break_step_color',
            [
                'label' => esc_html__('Step Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gf_progressbar_title' => 'color: {{VALUE}}',
                ],
            ]
        );

        //Step Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'page_break_step_typography',
                'label' => esc_html__('Step Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gf_progressbar_title',
            ]
        );

        //Button Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'page_break_button_border',
                'label' => esc_html__('Button Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_page_footer input.gform-theme-button.button',
            ]
        );

        //Button Border Radius
        $this->add_responsive_control(
            'page_break_button_border_radius',
            [
                'label' => esc_html__('Button Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_page_footer input.gform-theme-button.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //Button Width
        $this->add_responsive_control(
            'page_break_button_width',
            [
                'label' => esc_html__('Button Width', 'primekit-addons'),
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
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_page_footer input.gform-theme-button.button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //Button Padding
        $this->add_responsive_control(
            'page_break_button_padding',
            [
                'label' => esc_html__('Button Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_page_footer input.gform-theme-button.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        //Button Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'page_break_button_typography',
                'label' => esc_html__('Button Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_page_footer input.gform-theme-button.button',
            ]
        );

        //Button Normal and Hover Tabs
        $this->start_controls_tabs('page_break_button_tabs');

        $this->start_controls_tab(
            'page_break_button_normal_tab',
            [
                'label' => esc_html__('Normal', 'primekit-addons'),
            ]
        );

        $this->add_control(
            'page_break_button_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_page_footer input.gform-theme-button.button' => 'color: {{VALUE}};',
                ],
            ]
        );

        //Button Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'page_break_button_background',
                'label' => esc_html__('Button Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_page_footer input.gform-theme-button.button',
            ]
        );

        $this->end_controls_tab(); //End Normal Tab



        //Button Hover
        $this->start_controls_tab(
            'page_break_button_hover_tab',
            [
                'label' => esc_html__('Hover', 'primekit-addons'),
            ]
        );
        //Button Hover Text Color
        $this->add_control(
            'page_break_button_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_page_footer input.gform-theme-button.button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        //Button Hover Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'page_break_button_hover_background',
                'label' => esc_html__('Background', 'primekit-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .primekit-gravity-form-wrapper .gform_page_footer input.gform-theme-button.button:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section(); //End Style Section for Page Break

    }




    protected function render()
    {

        // Check if Gravity Forms is active
        if (class_exists('GFAPI')) {
            // Render the Gravity Forms output as usual
            include 'renderview.php';
        } else {
            // Display a notice if Gravity Forms is not active
            echo '<div class="gravity-forms-missing-notice">';
            echo '<strong>' . esc_html__('Gravity Forms is missing! Please install and activate Gravity Forms.', 'primekit-addons') . '</strong>';
            echo '</div>';
        }

    }

}