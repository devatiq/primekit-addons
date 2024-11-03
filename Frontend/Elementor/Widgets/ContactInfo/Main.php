<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\ContactInfo;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-contact-info';
	}
	
	public function get_title()
	{
		return esc_html__('Contact & Social Info', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-social-icons primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-category'];
	}
	
	public function get_keywords()
	{
		return ['prime', 'contact', 'info', 'social'];
	}
	

	/**
	 * Register list widget controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'primekit_elementor_contact_switch_Settings',
			[
				'label' => esc_html__( 'Settings', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//contact info
		$this->add_control(
			'primekit_elementor_contact_info_switch',
			[
				'label' => esc_html__( 'Contact Info', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'primekit-addons' ),
				'label_off' => esc_html__( 'Hide', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		//social
		$this->add_control(
			'primekit_elementor_contact_social_icon_switch',
			[
				'label' => esc_html__( 'Social Icons', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'primekit-addons' ),
				'label_off' => esc_html__( 'Hide', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		//type
		$this->add_control(
			'primekit_elementor_contact_style_type',
			[
				'label' => esc_html__( 'Style type', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'stack',
				'options' => [
					'stack' => esc_html__( 'Stack', 'primekit-addons' ),
					'inline'  => esc_html__( 'Inline', 'primekit-addons' ),
				],
			]
		);

		//Alignment
		$this->add_responsive_control(
				'primekit_elementor_contact_info_inline_align',
				[
					'label' => esc_html__( 'Content Alignment', 'primekit-addons'),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'flex-start',
					'options' => [
						'flex-start'    => [
							'title' => esc_html__( 'Left', 'primekit-addons' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'primekit-addons' ),
							'icon' => 'eicon-text-align-center',
						],
						'flex-end' => [
							'title' => esc_html__( 'Right', 'primekit-addons' ),
							'icon' => 'eicon-text-align-right',
						],
					],				
					'selectors' => [
						'{{WRAPPER}} .primekit-contact-info-inline' => 'justify-content: {{VALUE}}',
					],
					'condition' => [
						'primekit_elementor_contact_style_type' => 'inline',
					],
				]
			);

		$this->end_controls_section();//end settings

		//Contact Info section
		$this->start_controls_section(
			'primekit_elementor_contact_info_Settings',
			[
				'label' => esc_html__( 'Contact Info', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'primekit_elementor_contact_info_switch' => 'yes',
				],
			]
		);

		//Address
		$this->add_control(
			'primekit_elementor_contact_info_address',
			[
				'label' => esc_html__( 'Address:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__( '1234 Street Name, City, Zip Code, Country', 'primekit-addons' ),
			]
		);

		//Mobile
		$this->add_control(
			'primekit_elementor_contact_info_mobile',
			[
				'label' => esc_html__( 'Mobile:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '+123 456 7890', 'primekit-addons' ),
			]
		);

		//Email
		$this->add_control(
			'primekit_elementor_contact_info_email',
			[
				'label' => esc_html__( 'Email:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'example@example.com', 'primekit-addons' ),
			]
		);

		$this->end_controls_section(); //end contact info

		//Social Icon section
		$this->start_controls_section(
			'primekit_elementor_contact_social_icons_Settings',
			[
				'label' => esc_html__( 'Social Icons', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'primekit_elementor_contact_social_icon_switch' => 'yes',
				],
			]
		);

		//Facebook
		$this->add_control(
			'primekit_elementor_contact_info_fb_url',
			[
				'label' => esc_html__( 'Facebook URL:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
			]
		);

		//X
		$this->add_control(
			'primekit_elementor_contact_info_x_url',
			[
				'label' => esc_html__( 'Twitter/X:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
			]
		);

		//Instagram
		$this->add_control(
			'primekit_elementor_contact_info_ins_url',
			[
				'label' => esc_html__( 'Instagram:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
			]
		);

		//Linkedin
		$this->add_control(
			'primekit_elementor_contact_info_link_url',
			[
				'label' => esc_html__( 'Linkedin:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
			]
		);

		//Pinterest
		$this->add_control(
			'primekit_elementor_contact_info_pin_url',
			[
				'label' => esc_html__( 'Pinterest:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		//Dribbble
		$this->add_control(
			'primekit_elementor_contact_info_drib_url',
			[
				'label' => esc_html__( 'Dribbble:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		//Behance
		$this->add_control(
			'primekit_elementor_contact_info_behan_url',
			[
				'label' => esc_html__( 'Behance:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		//TikTok
		$this->add_control(
			'primekit_elementor_contact_info_tikton_url',
			[
				'label' => esc_html__( 'TikTok:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		//Vimeo
		$this->add_control(
			'primekit_elementor_contact_info_vimeo_url',
			[
				'label' => esc_html__( 'Vimeo:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		//Youtube
		$this->add_control(
			'primekit_elementor_contact_info_yt_url',
			[
				'label' => esc_html__( 'Youtube:', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'primekit-addons' ),
			]
		);

		$this->end_controls_section();//end socian icons

		//Contact Info Style
		$this->start_controls_section(
			'primekit_elementor_contact_info_style',
			[
				'label' => esc_html__( 'Contact Info Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'primekit_elementor_contact_info_switch' => 'yes',
				],
			]
		);

		//Icon Size
		$this->add_responsive_control(
			'primekit_elementor_contact_info_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'primekit-addons' ),
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
					'{{WRAPPER}} .primekit-contact-info-area svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Icon Color
		$this->add_control(
			'primekit_elementor_contact_info_icon_size_color',
			[
				'label' => esc_html__( 'Icon Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#903cf2',
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-area svg' => 'fill: {{VALUE}}',
				],
			]
		);

		//Info typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_contact_info_text_typography',
				'label' => esc_html__( 'Text Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-contact-info-area',
			]
		);

		//Info Text Color
		$this->add_control(
			'primekit_elementor_contact_info_text_color',
			[
				'label' => esc_html__( 'Text Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-area, {{WRAPPER}} .primekit-contact-info-area a' => 'color: {{VALUE}}',
				],
			]
		);

		//Info Hover Color
		$this->add_control(
			'primekit_elementor_contact_info_text_hov_color',
			[
				'label' => esc_html__( 'Text Hover Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-area a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		//Spacing Stack
		$this->add_responsive_control(
			'primekit_elementor_contact_info_item_spacing',
			[
				'label' => esc_html__( 'Info Bottom Spacing', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-address, {{WRAPPER}} .primekit-contact-info-mobile, {{WRAPPER}} .primekit-contact-info-email' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Spacing Inline
		$this->add_responsive_control(
			'primekit_elementor_contact_info_item_inline_spacing',
			[
				'label' => esc_html__( 'Info Right Spacing', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-inline .primekit-contact-info-address, {{WRAPPER}} .primekit-contact-info-inline .primekit-contact-info-mobile, {{WRAPPER}} .primekit-contact-info-inline .primekit-contact-info-email' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_contact_style_type' => 'inline',
				],
			]
		);

        $this->end_controls_section();//end contact info style

		//Social Icons Style
		$this->start_controls_section(
			'primekit_elementor_contact_social_icons_style',
			[
				'label' => esc_html__( 'Social Icons Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'primekit_elementor_contact_social_icon_switch' => 'yes',
				],
			]
		);

		//Icon Color
		$this->add_control(
			'primekit_elementor_contact_social_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-social-icons ul li svg' => 'fill: {{VALUE}}',
				],
			]
		);

		//Icon BG Color
		$this->add_control(
			'primekit_elementor_contact_social_icon_bg_color',
			[
				'label' => esc_html__( 'Icon BG Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#f0f0f0',
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-social-icons ul li a' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Icon Hover Color
		$this->add_control(
			'primekit_elementor_contact_social_icon_hov_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-social-icons ul li:hover svg' => 'fill: {{VALUE}}',
				],
			]
		);

		//Icon BG Color
		$this->add_control(
			'primekit_elementor_contact_social_icon_bg_hov_color',
			[
				'label' => esc_html__( 'Icon Hover BG Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#dddddd',
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-social-icons ul li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Icon Size
		$this->add_responsive_control(
			'primekit_elementor_contact_social_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-social-icons ul li svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Icon BG Size
		$this->add_responsive_control(
			'primekit_elementor_contact_social_icon_bg_size',
			[
				'label' => esc_html__( 'Icon Background Size', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-social-icons ul li a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Icon Gap
		$this->add_responsive_control(
			'primekit_elementor_contact_social_icon_gap',
			[
				'label' => esc_html__( 'Icon Gap', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-contact-info-social-icons ul li' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();//end social icons style

    }

    /**
     * Render the widget output on the frontend.
     */
	protected function render()
	{
		$primekit_settings = $this->get_settings_for_display();
		if (isset($primekit_settings['primekit_elementor_contact_style_type']) && $primekit_settings['primekit_elementor_contact_style_type'] === 'inline') {
			include 'inline-render.php';
		} else {
			include 'stack-render.php';
		}
	}
	
}