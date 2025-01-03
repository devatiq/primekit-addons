<?php
namespace PrimeKit\Frontend\Elementor\Widgets\ContactForm7;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-contact-form-7';
    }
    
    public function get_title()
    {
        return esc_html__('Contact Form 7 Style', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-form-horizontal primekit-addons-icon';
    }
    
    public function get_categories()
    {
        return ['primekit-category'];
    }
    
    public function get_keywords()
    {
        return ['prime', 'form', 'contact', 'style', '7'];
    }
    
    public function get_style_depends()
    {
        return ['primekit-form-7-style'];
    }
    

    /**
     * Get Contact Form 7 Shortcodes
     */
    private function primekit_contact_form_shortcodes() {
        $formlist = array();
        $forms_args = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $forms = get_posts( $forms_args );
        if( $forms ){
            foreach ( $forms as $form ){
                $formlist[$form->ID] = $form->post_title;
            }
        }else{
            $formlist['0'] = esc_html__('Form not found', 'primekit-addons');
        }
        return $formlist;
    }

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_contact_form_setting',
            [
                'label' => esc_html__('Contact Form 7 Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // form selection
        $this->add_control(
            'primekit_ele_contact_form_shortcode',
            [
                'label' => esc_html__('Select Form', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->primekit_contact_form_shortcodes(),
            ]
        );    

        // end of Contact form section
        $this->end_controls_section();

         // Label style section
         $this->start_controls_section(
            'primekit_elementor_cf7_label_style_setting',
            [
                'label' => esc_html__('Label Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

          //label typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_cf7_label_typography',
                'label' => esc_html__('Label Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-contact-form-7-area label',
            ]
        );

        //label color
        $this->add_control(
            'primekit_elementor_cf7_label_typography',
            [
                'label' => esc_html__('Label Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-contact-form-7-area label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();  // end of label section

        //input style section
        $this->start_controls_section(
            'primekit_elementor_cf7_input_style_setting',
            [
                'label' => esc_html__('Input Fields', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //input field height
        $this->add_responsive_control(
            'primekit_ele_cf7_input_height',
            [
                'label' => esc_html__('Height', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap select' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //input field border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'primekit_ele_cf7_input_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap input',
            ]
        );

        //input field border radius
        $this->add_responsive_control(
            'primekit_ele_cf7_input_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //input field padding
        $this->add_responsive_control(
            'primekit_ele_cf7_input_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //input field margin
        $this->add_responsive_control(
            'primekit_ele_cf7_input_margin',
            [
                'label' => esc_html__('Margin', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap input, {{WRAPPER}} .primekit-ele-contact-form-7-area select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

         // input field text color
         $this->add_control(
            'primekit_ele_cf7_input_text_bg_color',
            [
                'label' => esc_html__('Field Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f1f1f1',
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap select' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // input field text color
        $this->add_control(
            'primekit_ele_cf7_input_text_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap select' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Input field text color
        $this->add_control(
            'primekit_ele_cf7_input_text_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap input::placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

         //placeholder typography
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_ele_cf7_input_text_placeholder_typography',
                'label' => esc_html__('Placeholder Typography', 'primekit-addons'),
                'selector' =>'{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap input::placeholder, {{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea::placeholder',
            ]
        );

        // end input style section
        $this->end_controls_section();

        //Textarea style section
        $this->start_controls_section(
            'primekit_elementor_cf7_textarea_style_setting',
            [
                'label' => esc_html__('Textarea', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Textarea field height
        $this->add_responsive_control(
            'primekit_ele_cf7_textarea_height',
            [
                'label' => esc_html__('Height', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],

                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
      
        // Textarea field border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'primekit_ele_cf7_textarea_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea',
            ]
        );

        // Textarea field border radius
        $this->add_responsive_control(
            'primekit_ele_cf7_textarea_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //Textarea field padding
        $this->add_responsive_control(
            'primekit_ele_cf7_textarea_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //Textarea field margin
        $this->add_responsive_control(
            'primekit_ele_cf7_textarea_margin',
            [
                'label' => esc_html__('Margin', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // End extarea style section
        $this->end_controls_section();

        //Submit button style section
        $this->start_controls_section(
            'primekit_elementor_cf7_submit_button_style_setting',
            [
                'label' => esc_html__('Submit Button', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Submit button field typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_ele_cf7_submit_button_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} #primekit-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit',
            ]
        );

        // Submit button field padding
        $this->add_responsive_control(
            'primekit_ele_cf7_submit_button_padding',
            [
                'label' => esc_html__('Padding', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Submit button field margin
        $this->add_responsive_control(
            'primekit_ele_cf7_submit_button_margin',
            [
                'label' => esc_html__('Margin', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Submit button field text color
        $this->add_control(
            'primekit_ele_cf7_submit_button_text_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Submit button field background color
        $this->add_control(
            'primekit_ele_cf7_submit_button_bg_color',
            [
                'label' => esc_html__('Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#53a6d6',
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Submit button field border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'primekit_ele_cf7_submit_button_border',
                'label' => esc_html__('Border', 'primekit-addons'),
                'selector' => '{{WRAPPER}} #primekit-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit',
            ]
        );  

        // Submit button field border radius
        $this->add_responsive_control(
            'primekit_ele_cf7_submit_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'primekit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Submit button field hover text color
        $this->add_control(
            'primekit_ele_cf7_submit_button_hover_text_color',
            [
                'label' => esc_html__('Hover Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Submit button field hover background color
        $this->add_control(
            'primekit_ele_cf7_submit_button_hover_bg_color',
            [
                'label' => esc_html__('Hover Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#b039f5',
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Submit button field hover border color
        $this->add_control(
            'primekit_ele_cf7_submit_button_hover_border_color',
            [
                'label' => esc_html__('Hover Border Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#b039f5',
                'selectors' => [
                    '{{WRAPPER}} #primekit-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        // end button style section
        $this->end_controls_section();

        //Radio button style section
        $this->start_controls_section(
            'primekit_elementor_cf7_submit_radio_button_style_setting',
            [
                'label' => esc_html__('Radio Button', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //label typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_cf7_radio_label_typography',
                'label' => esc_html__('Label Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-radio .wpcf7-list-item-label',
            ]
        );

        //radio size
        $this->add_responsive_control(
			'primekit_elementor_cf7_radio_button_size',
			[
				'label' => esc_html__( 'Radio Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-radio .wpcf7-list-item-label::before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        // Radio background color
        $this->add_control(
            'primekit_elementor_cf7_radio_button_bg_color',
            [
                'label' => esc_html__('Radio Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f2f2f2',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-radio .wpcf7-list-item-label::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

         // Radio selected background color
         $this->add_control(
            'primekit_elementor_cf7_radio_button_bg_selected_color',
            [
                'label' => esc_html__('Selected Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4246ec',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-contact-form-7-area input[type="radio"]:checked + .wpcf7-list-item-label::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

          // Radio Border color
          $this->add_control(
            'primekit_elementor_cf7_radio_button_border_color',
            [
                'label' => esc_html__('Border Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-radio .wpcf7-list-item-label::before' => 'border-color: {{VALUE}};',
                ],
            ]
        );

         //Item Spacing
         $this->add_responsive_control(
			'primekit_elementor_cf7_radio_button_item_spacing',
			[
				'label' => esc_html__( 'Item Spacing', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
					'top' => 0,
					'right' => 15,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-radio .wpcf7-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        // end radio button style section
        $this->end_controls_section();

        //checkbox style section
        $this->start_controls_section(
            'primekit_elementor_cf7_submit_checkbox_style_setting',
            [
                'label' => esc_html__('Checkbox Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //label typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_cf7_checkbox_label_typography',
                'label' => esc_html__('Label Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-checkbox .wpcf7-list-item-label',
            ]
        );

        //checkbox size
        $this->add_responsive_control(
			'primekit_elementor_cf7_checkbox_size',
			[
				'label' => esc_html__( 'Checkbox Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-checkbox .wpcf7-list-item-label::before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        // checkbox background color
        $this->add_control(
            'primekit_elementor_cf7_checkbox_bg_color',
            [
                'label' => esc_html__('Checkbox Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f2f2f2',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-checkbox .wpcf7-list-item-label::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

         // checkbox selected background color
         $this->add_control(
            'primekit_elementor_cf7_checkbox_bg_selected_color',
            [
                'label' => esc_html__('Selected Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4246ec',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-contact-form-7-area input[type="checkbox"]:checked + .wpcf7-list-item-label::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

          // checkbox Border color
          $this->add_control(
            'primekit_elementor_cf7_checkbox_border_color',
            [
                'label' => esc_html__('Border Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-checkbox .wpcf7-list-item-label::before' => 'border-color: {{VALUE}};',
                ],
            ]
        );

         //Item Spacing
         $this->add_responsive_control(
			'primekit_elementor_cf7_checkbox_item_spacing',
			[
				'label' => esc_html__( 'Item Spacing', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
					'top' => 0,
					'right' => 15,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-checkbox .wpcf7-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        // end checkbox style section
        $this->end_controls_section();

        //response message style section
        $this->start_controls_section(
            'primekit_elementor_cf7_submit_response_sms_style',
            [
                'label' => esc_html__('Response Message', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

          //label typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_cf7_submit_response_sms_typography',
                'label' => esc_html__('Label Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-response-output',
            ]
        );

        //text color
        $this->add_control(
            'primekit_elementor_cf7_submit_response_sms_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-contact-form-7-area .wpcf7-response-output' => 'color: {{VALUE}};',
                ],
            ]
        );

        // error border color
        $this->add_control(
            'primekit_elementor_cf7_submit_response_sms_err_order_color',
            [
                'label' => esc_html__('Error Border Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffb900',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        // success border color
        $this->add_control(
            'primekit_elementor_cf7_submit_response_sms_sent_border_color',
            [
                'label' => esc_html__('Success Border Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#46b450',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        // end response message style section
        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()

    {
        include 'RenderView.php';
    }
}