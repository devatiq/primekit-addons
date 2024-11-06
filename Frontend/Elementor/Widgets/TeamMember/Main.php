<?php
namespace PrimeKit\Frontend\Elementor\Widgets\TeamMember;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-elementor-team-member';
    }
    
    public function get_title()
    {
        return esc_html__('Team Member', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-theme-builder primekit-addons-icon';
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
            'primekit_elementor_teammember_setting',
            [
                'label' => esc_html__('Team Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // select team member style
        $this->add_control(
            'primekit_elementor_teammember_style',
            [
                'label' => esc_html__('Member Style', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style-one',
                'options' => [
                    'style-one' => esc_html__('Style One', 'primekit-addons'),
                    'style-two' => esc_html__('Style Two', 'primekit-addons'),
                    'style-three' => esc_html__('Style Three', 'primekit-addons'),
                ],
            ]
        );

        //Member Image
        $this->add_control(
			'primekit_elementor_teammember_image',
			[
				'label' => esc_html__( 'Member Image', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

        //Image dimension
        $this->add_control(
			'primekit_elementor_teammember_image_dimension',
			[
				'label' => esc_html__( 'Image Dimension', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'primekit-addons' ),
				'default' => [
					'width' => '800',
					'height' => '800',
				],
			]
		);

         //Member Name
         $this->add_control(
			'primekit_elementor_teammember_name',
			[
				'label' => esc_html__( 'Member Name', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Member Name', 'primekit-addons' ),
			]
		);

        //Name Position
        $this->add_responsive_control(
			'primekit_elementor_teammember_name_pos',
			[
				'label' => esc_html__( 'Name Text Position', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 35,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-team-single-item-style-two:hover h3.primekit-ele-team-name' => 'bottom: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-two',
                ],
			]
		);

         //Member Designation
         $this->add_control(
			'primekit_elementor_teammember_designation',
			[
				'label' => esc_html__( 'Member Designation', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'CEO of Company', 'primekit-addons' ),
			]
		);

        //Designation Position
        $this->add_responsive_control(
			'primekit_elementor_teammember_designation_pos',
			[
				'label' => esc_html__( 'Designation Text Position', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 70,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-team-style-two-info .primekit-ele-team-designation' => 'bottom: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-two',
                ],
			]
		);

         //Link
         $this->add_control(
			'primekit_elementor_teammember_link',
			[
				'label' => esc_html__( 'Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
                'condition' => [
                    'primekit_elementor_teammember_style!' => 'style-three',
                ],
			]
		);


        //social profile on/off switch
        $this->add_control(
            'primekit_elementor_teammember_display_social',
            [
                'label' => esc_html__('Display Social Profile', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

         //Social Position
         $this->add_responsive_control(
			'primekit_elementor_teammember_social_icon_pos',
			[
				'label' => esc_html__( 'Icon Position', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-team-style-two-social' => 'bottom: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-two',
                    'primekit_elementor_teammember_display_social' => 'yes',
                ],
			]
		);
         
        //Phone Number
        $this->add_control(
			'primekit_elementor_teammember_phone_number',
			[
				'label' => esc_html__( 'Phone Number', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '+123 456 7890', 'primekit-addons' ),
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ]
			]
		);

        //Phone Number
        $this->add_control(
			'primekit_elementor_teammember_email_address',
			[
				'label' => esc_html__( 'Email Address', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'name@siteaddress.com', 'primekit-addons' ),
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ]
			]
		);

        //Details Button
        $this->add_control(
			'primekit_elementor_teammember_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn More', 'primekit-addons' ),
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ]
			]
		);

        //Button Link
        $this->add_control(
			'primekit_elementor_teammember_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ]
			]
		);

        //Facebook
        $this->add_control(
			'primekit_elementor_teammember_social_fc',
			[
				'label' => esc_html__( 'Facebook Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
                'condition' => [
                    'primekit_elementor_teammember_display_social' => 'yes',
                ]
			]
		);

        //Twitter/x
        $this->add_control(
			'primekit_elementor_teammember_social_tw',
			[
				'label' => esc_html__( 'Twitter/X Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
                'condition' => [
                    'primekit_elementor_teammember_display_social' => 'yes',
                ]
			]
		);

        //Linkedin
        $this->add_control(
			'primekit_elementor_teammember_social_lin',
			[
				'label' => esc_html__( 'Linkedin Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
                'condition' => [
                    'primekit_elementor_teammember_display_social' => 'yes',
                ]
			]
		);

        //Instagram
        $this->add_control(
			'primekit_elementor_teammember_social_ins',
			[
				'label' => esc_html__( 'Instagram Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
                'condition' => [
                    'primekit_elementor_teammember_display_social' => 'yes',
                ]
			]
		);

        //Youtube
        $this->add_control(
			'primekit_elementor_teammember_social_yt',
			[
				'label' => esc_html__( 'Youtube Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
                'condition' => [
                    'primekit_elementor_teammember_display_social' => 'yes',
                ]
			]
		);

        // end of team member section
        $this->end_controls_section();

        // start of team member style section
        $this->start_controls_section(
            'primekit_elementor_teammember_style_setting',
            [
                'label' => esc_html__('Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Border color
        $this->add_control(
            'primekit_elementor_teammember_border_color',
            [
                'label' => esc_html__('Border Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#448E08',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-team-image img' => 'border-color: {{VALUE}} !important;',
                    
                ],
                'condition' => [
                    'primekit_elementor_teammember_style!' => 'style-three',
                ],
            ]
        );

          // Style one name typography 
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_teammember_name_one_typography',
                'label' => esc_html__('Name Typography', 'primekit-addons'),
                'selector' =>  '{{WRAPPER}} h4.primekit-ele-team-name a, {{WRAPPER}} h4.primekit-ele-team-name',
                    'condition' => [
                        'primekit_elementor_teammember_style' => 'style-one',
                    ],
            ]
        );

          // Style Two name typography 
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_teammember_name_two_typography',
                'label' => esc_html__('Name Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} h3.primekit-ele-team-name, {{WRAPPER}} h3.primekit-ele-team-name a',
                    'condition' => [
                        'primekit_elementor_teammember_style' => 'style-two',
                    ],
            ]
        );

          // Style Three name typography 
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_teammember_name_three_typography',
                'label' => esc_html__('Name Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} h3.primekit-style-three-team-name, {{WRAPPER}} h3.primekit-style-three-team-name a',
                    'condition' => [
                        'primekit_elementor_teammember_style' => 'style-three',
                    ],
            ]
        );
        

        // team member name color
        $this->add_control(
            'primekit_elementor_teammember_name_color',
            [
                'label' => esc_html__('Name Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} h4.primekit-ele-team-name a, {{WRAPPER}} h4.primekit-ele-team-name' => 'color: {{VALUE}};',
                    '{{WRAPPER}} h3.primekit-ele-team-name, {{WRAPPER}} h3.primekit-ele-team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} h3.primekit-style-three-team-name, {{WRAPPER}} h3.primekit-style-three-team-name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // team member name color
        $this->add_control(
            'primekit_elementor_teammember_name_hover_color',
            [
                'label' => esc_html__('Name Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#448E08',
                'selectors' => [
                    '{{WRAPPER}} h4.primekit-ele-team-name a:hover, {{WRAPPER}} h4.primekit-ele-team-name:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} h3.primekit-ele-team-name:hover, {{WRAPPER}} h3.primekit-ele-team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} h3.primekit-style-three-team-name:hover, {{WRAPPER}} h3.primekit-style-three-team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-team-link svg:hover' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Style One designation typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_teammember_designation_one_typography',
                'label' => esc_html__('Designation Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} p.primekit-ele-team-designation',
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-one',
                ],
            ]
        );

        // Style Two designation typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_teammember_designation_two_typography',
                'label' => esc_html__('Designation Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-team-style-two-info p.primekit-ele-team-designation',
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-two',
                ],
            ]
        );

        // Style Three designation typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_teammember_designation_three_typography',
                'label' => esc_html__('Designation Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} h4.primekit-style-three-team-designation',
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ],
            ]
        );

        // team member designation color
        $this->add_control(
            'primekit_elementor_teammember_designation_color',
            [
                'label' => esc_html__('Designation Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#448E08',
                'selectors' => [
                    '{{WRAPPER}} p.primekit-ele-team-designation' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-ele-team-style-two-info p.primekit-ele-team-designation' => 'color: {{VALUE}};',
                    '{{WRAPPER}} h4.primekit-style-three-team-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

         // Arrow Icon color
         $this->add_control(
            'primekit_elementor_teammember_arrow_icon_color',
            [
                'label' => esc_html__('Arrow Icon Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1b75cf',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-team-link svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-one',
                ],
            ]
        );

        // contact info typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_teammember_contact_typography',
                'label' => esc_html__('Contact Info Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-style-three-team-phone, {{WRAPPER}} .primekit-style-three-team-email',
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ],
            ]
        );

         //Contact Icon Size
         $this->add_responsive_control(
			'primekit_elementor_teammember_contact_icon_size',
			[
				'label' => esc_html__( 'Contact Icon Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-style-three-team-phone svg, {{WRAPPER}} .primekit-style-three-team-email svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ],
			]
		);

        //Contact Icon Position
        $this->add_responsive_control(
			'primekit_elementor_teammember_contact_icon_pos',
			[
				'label' => esc_html__( 'Icon Position', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-style-three-team-phone svg, {{WRAPPER}} .primekit-style-three-team-email svg' => 'top: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ],
			]
		);

          // Contact Text Color
          $this->add_control(
            'primekit_elementor_teammember_contact_text_color',
            [
                'label' => esc_html__('Contact Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .primekit-style-three-team-phone, {{WRAPPER}} .primekit-style-three-team-email' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ],
            ]
        );

          // Contact Icon Color
          $this->add_control(
            'primekit_elementor_teammember_contact_icon_color',
            [
                'label' => esc_html__('Contact Icon Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .primekit-style-three-team-phone svg, {{WRAPPER}} .primekit-style-three-team-email svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ],
            ]
        );

        // Learn More typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_teammember_btn_typography',
                'label' => esc_html__('Learn More Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-style-three-team-button a',
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ],
            ]
        );

        //Button Color
        $this->add_control(
            'primekit_elementor_teammember_more_btn_color',
            [
                'label' => esc_html__('Learn More Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#0694bf',
                'selectors' => [
                    '{{WRAPPER}} .primekit-style-three-team-button a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-style-three-team-button svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ],
            ]
        );

        //Button Hover Color
        $this->add_control(
            'primekit_elementor_teammember_more_btn_hover_color',
            [
                'label' => esc_html__('Learn More Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#04de75',
                'selectors' => [
                    '{{WRAPPER}} .primekit-style-three-team-button a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .primekit-style-three-team-button svg:hover' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ],
            ]
        );

        //More Icon size
        $this->add_responsive_control(
			'primekit_elementor_teammember_more_icon_size',
			[
				'label' => esc_html__( 'Learn More Icon Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-style-three-team-button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ],
			]
		);

        //More Icon Position
        $this->add_responsive_control(
			'primekit_elementor_teammember_more_icon_pos',
			[
				'label' => esc_html__( 'Learn More Icon Position', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-style-three-team-button svg' => 'top: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-three',
                ],
			]
		);

        // end of team member style section
        $this->end_controls_section();

        // start of social style section
        $this->start_controls_section(
            'primekit_elementor_teammember_social_style',
            [
                'label' => esc_html__('Social Profile', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_teammember_display_social' => 'yes',
                ]
            ]
        );

        //Social Icon Size
        $this->add_responsive_control(
			'primekit_elementor_teammember_social_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-team-style-two-social ul li a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .primekit-style-three-team-icons ul li svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_teammember_display_social' => 'yes',
                ],
			]
		);

        // social circle background color
        $this->add_control(
            'primekit_elementor_teammember_social_circle_bg_color',
            [
                'label' => esc_html__('Share Icon Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#448E08',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-team-social svg circle' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'primekit_elementor_teammember_style' => 'style-one',
                ],
            ]
        );

        //social icons color
        $this->add_control(
            'primekit_elementor_teammember_social_icons_color',
            [
                'label' => esc_html__('Social Icons Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#448E08',
                'selectors' => [
                    '{{WRAPPER}} ul.primekit-team-member-social-links li svg, .primekit-team-style-two-social ul li a svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // social icon Hover color
        $this->add_control(
            'primekit_elementor_teammember_social_icons_hover_color',
            [
                'label' => esc_html__('Social Icon Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1b75cf',
                'selectors' => [
                    '{{WRAPPER}} ul.primekit-team-member-social-links li:hover svg, .primekit-team-style-two-social ul li:hover a svg ' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // end of social style section
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