<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\WooCommerce\WooAccount;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;


/**
 * Elementor List Widget.
 * @since 1.0.0
 */
class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-wc-account';
	}
	
	public function get_title()
	{
		return esc_html__('Woo My Account', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-my-account primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-wc-category'];
	}
	
	public function get_keywords()
	{
		return ['PrimeKit', 'woo', 'my account', 'account'];
	}
	
	public function get_style_depends()
	{
		return ['primekit-woocommerce-style'];
	}
	

	protected function register_controls() {

		//Info Style
		$this->start_controls_section(
			'primekit_elementor_wc_account_content',
			[
				'label' => esc_html__( 'Settings', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
		    'primekit_elementor_wc_account_style_orientation',
		    [
		        'label' => esc_html__('Style Orientation', 'primekit-addons'),
		        'type' => Controls_Manager::SELECT,
		        'default' => 'horizontal',
		        'options' => [
		            'horizontal' => esc_html__('Horizontal', 'primekit-addons'),
		            'vertical' => esc_html__('Vertical', 'primekit-addons'),
		        ],
		        'separator' => 'before',
		    ]
		);

		// Alignment control based on the style orientation		
		$this->add_control(
		    'primekit_elementor_wc_account_align_items_icon',
		    [
		        'label' => esc_html__('Tabs Align', 'primekit-addons'),
		        'type' => Controls_Manager::CHOOSE,
		        'options' => [
		            'flex-start' => [
		                'title' => esc_html__('Start', 'primekit-addons'),
		                'icon' => 'eicon-h-align-left',
		            ],
		            'center' => [
		                'title' => esc_html__('Center', 'primekit-addons'),
		                'icon' => 'eicon-h-align-center',
		            ],
		            'flex-end' => [
		                'title' => esc_html__('End', 'primekit-addons'),
		                'icon' => 'eicon-h-align-right',
		            ],
		        ],
		        'default' => 'left',
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul' => 'justify-content: {{VALUE}};',
		        ],
		        'condition' => [
		            'primekit_elementor_wc_account_style_orientation' => 'vertical',
		        ],
		    ]
		);

		$this->end_controls_section();

		// General Style section
		$this->start_controls_section(
		    'primekit_elementor_wc_account_general_style',
		    [
		        'label' => esc_html__( 'General Style', 'primekit-addons' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'primekit_elementor_wc_account_gap',
		    [
		        'label' => esc_html__( 'Gap', 'primekit-addons' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 200,
		                'step' => 1,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce' => 'gap: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section(); // End General Style

		// Start Tabs section
		$this->start_controls_section(
		    'primekit_elementor_wc_account_tab_style',
		    [
		        'label' => esc_html__('Tabs Style', 'primekit-addons'),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);
		// menu typography
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'primekit_elementor_wc_account_tab_typography',
		        'selector' => '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul a',
		    ]
		);

		// Gap control
		$this->add_responsive_control(
		    'primekit_elementor_wc_account_menu_item_gap',
		    [
		        'label' => esc_html__('Menu Gap', 'primekit-addons'),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px', '%'],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 200,
		                'step' => 1,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul' => 'gap: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		// Border control
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'primekit_elementor_wc_account_tab_border',
		        'selector' => '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul a',
		    ]
		);

		// Padding control
		$this->add_responsive_control(
		    'primekit_elementor_wc_account_tab_padding',
		    [
		        'label' => esc_html__('Padding', 'primekit-addons'),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => ['px', 'em', '%'],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		// Border radius
		$this->add_responsive_control(
		    'primekit_elementor_wc_account_tab_border_radius',
		    [
		        'label' => esc_html__('Border Radius', 'primekit-addons'),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => ['px', '%'],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		// Menu width control
		$this->add_responsive_control(
		    'primekit_elementor_wc_account_menu_width',
		    [
		        'label' => esc_html__('Menu Width', 'primekit-addons'),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px', 'em', '%'],
		        'range' => [
		            'px' => [
		                'min' => 50,
		                'max' => 600,
		                'step' => 1,
		            ],
		            'em' => [
		                'min' => 5,
		                'max' => 80,
		                'step' => 0.1,
		            ],
		            '%' => [
		                'min' => 5,
		                'max' => 100,
		                'step' => 1,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul a' => 'width: {{SIZE}}{{UNIT}};flex-basis: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		// Start Normal Tab
		$this->start_controls_tabs('primekit_elementor_wc_account_tabs_style');

		$this->start_controls_tab(
		    'primekit_elementor_wc_account_tab_normal',
		    [
		        'label' => esc_html__('Normal', 'primekit-addons'),
		    ]
		);

		$this->add_control(
		    'primekit_elementor_wc_account_tab_text_color',
		    [
		        'label' => esc_html__('Text Color', 'primekit-addons'),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'primekit_elementor_wc_account_tab_background_color',
		    [
		        'label' => esc_html__('Background Color', 'primekit-addons'),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul a' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		// Start Hover Tab
		$this->start_controls_tab(
		    'primekit_elementor_wc_account_tab_hover',
		    [
		        'label' => esc_html__('Hover', 'primekit-addons'),
		    ]
		);

		$this->add_control(
		    'primekit_elementor_wc_account_tab_hover_text_color',
		    [
		        'label' => esc_html__('Text Color', 'primekit-addons'),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul a:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link.is-active a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'primekit_elementor_wc_account_tab_hover_background_color',
		    [
		        'label' => esc_html__('Background Color', 'primekit-addons'),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul a:hover' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link.is-active a' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'primekit_elementor_wc_account_tab_hover_border_color',
		    [
		        'label' => esc_html__('Border Color', 'primekit-addons'),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation ul a:hover' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link.is-active a' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		// End Tabs
		$this->end_controls_tabs();

		$this->end_controls_section(); // End Tabs Style

		// Start Content Style
		$this->start_controls_section(
		    'primekit_elementor_wc_account_content_section',
		    [
		        'label' => esc_html__('Content Style', 'primekit-addons'),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		// Content text color
		$this->add_control(
		    'primekit_elementor_wc_account_content_text_color',
		    [
		        'label' => esc_html__('Text Color', 'primekit-addons'),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		// Content link color
		$this->add_control(
		    'primekit_elementor_wc_account_content_link_color',
		    [
		        'label' => esc_html__('Link Color', 'primekit-addons'),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		// Content background color
		$this->add_control(
		    'primekit_elementor_wc_account_content_background_color',
		    [
		        'label' => esc_html__('Background Color', 'primekit-addons'),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		// Content padding
		$this->add_control(
		    'primekit_elementor_wc_account_content_padding',
		    [
		        'label' => esc_html__('Padding', 'primekit-addons'),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => ['px', '%', 'em'],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		// Content margin
		$this->add_control(
		    'primekit_elementor_wc_account_content_margin',
		    [
		        'label' => esc_html__('Margin', 'primekit-addons'),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => ['px', '%', 'em'],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		// Content border radius
		$this->add_control(
		    'primekit_elementor_wc_account_content_border_radius',
		    [
		        'label' => esc_html__('Border Radius', 'primekit-addons'),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => ['px', '%'],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);		

		// Group Border
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'primekit_elementor_wc_account_content_border',
		        'label' => esc_html__('Border', 'primekit-addons'),
		        'selector' => '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content',
		    ]
		);

		// Content Typography
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'primekit_elementor_wc_account_content_typography',
		        'label' => esc_html__('Typography', 'primekit-addons'),
		        'selector' => '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content',
		    ]
		);

		$this->end_controls_section(); // End Content Style

		// Start of Input Fields Style section
		$this->start_controls_section(
		    'primekit_elementor_wc_account_input_fields_style',
		    [
		        'label' => esc_html__('Input Fields', 'primekit-addons'),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		// Label Color
		$this->add_control(
		    'primekit_elementor_wc_account_label_color',
		    [
		        'label' => esc_html__('Label Color', 'primekit-addons'),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row label' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		// Label Typography
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'primekit_elementor_wc_account_label_typography',
		        'label' => esc_html__('Label Typography', 'primekit-addons'),
		        'selector' => '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row label',
		    ]
		);

		// Input Typography
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'primekit_elementor_wc_account_input_typography',
		        'label' => esc_html__('Input Typography', 'primekit-addons'),
		        'selector' => '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row input.input-text, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row select, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row textarea',
		    ]
		);

		// Input Padding
		$this->add_responsive_control(
		    'primekit_elementor_wc_account_input_padding',
		    [
		        'label' => esc_html__('Input Padding', 'primekit-addons'),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => ['px', 'em', '%'],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row input.input-text, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row select, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		// Input Gap
		$this->add_responsive_control(
		    'primekit_elementor_wc_account_input_gap',
		    [
		        'label' => esc_html__('Input Gap', 'primekit-addons'),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		// Input Color
		$this->add_control(
		    'primekit_elementor_wc_account_input_color',
		    [
		        'label' => esc_html__('Input Color', 'primekit-addons'),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row input.input-text, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row select, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row textarea' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		// Input Border
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'primekit_elementor_wc_account_input_border',
		        'label' => esc_html__('Input Border', 'primekit-addons'),
		        'selector' => '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row input.input-text, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row select, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row textarea',
		    ]
		);

		// Input Border Radius
		$this->add_responsive_control(
		    'primekit_elementor_wc_account_input_border_radius',
		    [
		        'label' => esc_html__('Input Border Radius', 'primekit-addons'),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => ['px', '%'],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row input.input-text, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row select, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		// Input Background Color
		$this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
		        'name' => 'primekit_elementor_wc_account_input_background',
		        'label' => esc_html__('Input Background', 'primekit-addons'),
		        'types' => ['classic'],
		        'selector' => '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row input.input-text, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row select, {{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce .woocommerce-MyAccount-content .form-row textarea',
		    ]
		);

		$this->end_controls_section(); // End Input Style

		//Button Style
		$this->start_controls_section(
			'primekit_elementor_wc_account_button_style',
			[
				'label' => esc_html__( 'Button', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Button Typography
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'primekit_elementor_wc_account_button_typography',
		        'selector' => '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content .button',
		    ]
		);
		// Button Border
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'primekit_elementor_wc_account_button_border',
		        'label' => esc_html__('Border', 'primekit-addons'),
		        'selector' => '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content .button',
		    ]
		);
		// Button Border Radius
		$this->add_responsive_control(
		    'primekit_elementor_wc_account_button_border_radius',
		    [
		        'label' => esc_html__('Border Radius', 'primekit-addons'),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => ['px', '%'],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		// Button Padding
		$this->add_responsive_control(
		    'primekit_elementor_wc_account_button_padding',
		    [
		        'label' => esc_html__('Padding', 'primekit-addons'),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => ['px', 'em', '%'],
		        'selectors' => [
		            '{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		// Button Margin
		$this->add_responsive_control(
		    'primekit_elementor_wc_account_button_margin',
			[
				'label' => esc_html__('Margin', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		// Button Normal and Hover Styles
		$this->start_controls_tabs('primekit_elementor_wc_account_button_style_tabs');

		$this->start_controls_tab(
			'primekit_elementor_wc_account_button_normal',
			[
				'label' => esc_html__('Normal', 'primekit-addons'),
			]
		);
		// Button Text Color
		$this->add_control(
			'primekit_elementor_wc_account_button_text_color_normal',
			[
				'label' => esc_html__('Text Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content .button' => 'color: {{VALUE}};',
				],
			]
		);
		// Button Background Color
		$this->add_control(
			'primekit_elementor_wc_account_button_bg_color_normal',
			[
				'label' => esc_html__('Background Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content .button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab(); // End Normal

		// Button Hover
		$this->start_controls_tab(
			'primekit_elementor_wc_account_button_hover',
			[
				'label' => esc_html__('Hover', 'primekit-addons'),
			]
		);
		// Button hover Text Color
		$this->add_control(
			'primekit_elementor_wc_account_button_text_color_hover',
			[
				'label' => esc_html__('Text Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content .button:hover' => 'color: {{VALUE}};',
				],
			]
		);
		// Button hover Background Color
		$this->add_control(
			'primekit_elementor_wc_account_button_bg_color_hover',
			[
				'label' => esc_html__('Background Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-wc-account-page .woocommerce-MyAccount-content .button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab(); // End Hover

		$this->end_controls_tabs();	// End Tabs		

		$this->end_controls_section(); // End of Input Fields Style section

    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {

        include 'renderview.php';
    }
}