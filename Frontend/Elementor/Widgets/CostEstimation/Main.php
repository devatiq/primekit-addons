<?php
namespace PrimeKit\Frontend\Elementor\Widgets\CostEstimation;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-cost-estimation';
    }

    public function get_title()
    {
        return esc_html__('Cost Estimation', 'primekit-addons');
    }

    public function get_icon()
    {
        return 'eicon-call-to-action primekit-addons-icon';
    }

    public function get_categories()
    {
        return ['primekit-category'];
    }

    public function get_keywords()
    {
        return ['cost', 'estimation', 'cost calculator', 'calculator'];
    }

    public function get_script_depends()
    {
        return ['primekit-cost-estimation'];
    }


    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {
        // Fetch saved package names from the dashboard settings
        $cost_estimation_options = get_option('primekit_cost_estimation_options', []);
        $package_1 = isset($cost_estimation_options['cost_estimation_package_1']) ? esc_html($cost_estimation_options['cost_estimation_package_1']) : '';
        $package_2 = isset($cost_estimation_options['cost_estimation_package_2']) ? esc_html($cost_estimation_options['cost_estimation_package_2']) : '';
        $package_3 = isset($cost_estimation_options['cost_estimation_package_3']) ? esc_html($cost_estimation_options['cost_estimation_package_3']) : '';

        // Generate the dynamic URL to the settings page
        $settings_url = admin_url('admin.php?page=primekit_settings&tab=cost_estimation');

        // Check if any of the package names are empty
        if (empty($package_1) || empty($package_2) || empty($package_3)) {
            // If any package names are missing, show an alert field in Elementor
            $this->start_controls_section(
                'primekit_cost_calculator_alert_section',
                [
                    'label' => esc_html__('Alert', 'primekit-addons'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );


            $this->add_control(
                'primekit_cost_calculator_alert',
                [
                    'type' => \Elementor\Controls_Manager::ALERT,
                    'alert_type' => 'warning',
                    'heading' => esc_html__('Package Names Missing', 'primekit-addons'),
                    'content' => sprintf(
                        // Translators: %1$s and %2$s are HTML links to the settings page.
                        esc_html__('Package names are not configured yet. Please go to the %1$ssettings page%2$s to configure them.', 'primekit-addons'),
                        '<a href="' . esc_url($settings_url) . '" target="_blank">',
                        '</a>'
                    ),
                ]
            );


            $this->end_controls_section();
        } else {
            // Content Tab Start
            $this->start_controls_section(
                'primekit_cost_calculator_content_section',
                [
                    'label' => esc_html__('Cost Estimation Items', 'primekit-addons'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
            $this->add_control(
                'primekit_cost_package_alert',
                [
                    'type' => \Elementor\Controls_Manager::ALERT,
                    'alert_type' => 'info',
                    'heading' => esc_html__('info', 'primekit-addons'),
                    'content' => sprintf(
                        // Translators: %1$s and %2$s are HTML links to the settings page.
                        esc_html__('Package names can be modified here. Please go to the %1$ssettings page%2$s in the dashboard to configure them.', 'primekit-addons'),
                        '<a href="' . esc_url($settings_url) . '" target="_blank">',
                        '</a>'
                    ),
                ]
            );


            // Create the repeater
            $repeater = new \Elementor\Repeater();

            // Add Title control for each repeater item
            $repeater->add_control(
                'page_list',
                [
                    'label' => esc_html__('Title', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('Page #1', 'primekit-addons'),
                    'label_block' => true,
                ]
            );

            // Add first dropdown control for Package 1
            $repeater->add_control(
                'primekit_cost_calculator_pack_1',
                [
                    'label' => esc_html__('Package 1', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'primekit_c_p_low',
                    'options' => [
                        'primekit_c_p_low' => esc_html($package_1),
                        'primekit_c_p_medium' => esc_html($package_2),
                        'primekit_c_p_high' => esc_html($package_3),
                    ],
                ]
            );

            // Add first package price control for Package 1
            $repeater->add_control(
                'primekit_cost_calculator_price_1',
                [
                    'label' => esc_html__('Package 1 Price', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 0,
                    'step' => 1,
                    'default' => 100,
                ]
            );

            // Add second dropdown control for Package 2
            $repeater->add_control(
                'primekit_cost_calculator_pack_2',
                [
                    'label' => esc_html__('Package 2', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'primekit_c_p_medium',
                    'options' => [
                        'primekit_c_p_low' => esc_html($package_1),
                        'primekit_c_p_medium' => esc_html($package_2),
                        'primekit_c_p_high' => esc_html($package_3),
                    ],
                ]
            );

            // Add second package price control for Package 2
            $repeater->add_control(
                'primekit_cost_calculator_price_2',
                [
                    'label' => esc_html__('Package 2 Price', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 0,
                    'step' => 1,
                    'default' => 200,
                ]
            );

            // Add third dropdown control for Package 3
            $repeater->add_control(
                'primekit_cost_calculator_pack_3',
                [
                    'label' => esc_html__('Package 3', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'primekit_c_p_high',
                    'options' => [
                        'primekit_c_p_low' => esc_html($package_1),
                        'primekit_c_p_medium' => esc_html($package_2),
                        'primekit_c_p_high' => esc_html($package_3),
                    ],
                ]
            );

            // Add third package price control for Package 3
            $repeater->add_control(
                'primekit_cost_calculator_price_3',
                [
                    'label' => esc_html__('Package 3 Price', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 0,
                    'step' => 1,
                    'default' => 400,
                ]
            );

            // Add repeater to the controls
            $this->add_control(
                'primekit_cost_cal_pages_list',
                [
                    'label' => esc_html__('Pages List', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'page_list' => esc_html__('Page #1', 'primekit-addons'),
                            'primekit_cost_calculator_pack_1' => 'primekit_c_p_low',
                            'primekit_cost_calculator_price_1' => 100,
                            'primekit_cost_calculator_pack_2' => 'primekit_c_p_medium',
                            'primekit_cost_calculator_price_2' => 200,
                            'primekit_cost_calculator_pack_3' => 'primekit_c_p_high',
                            'primekit_cost_calculator_price_3' => 400,
                        ],
                        [
                            'page_list' => esc_html__('Page #2', 'primekit-addons'),
                            'primekit_cost_calculator_pack_1' => 'primekit_c_p_low',
                            'primekit_cost_calculator_price_1' => 200,
                            'primekit_cost_calculator_pack_2' => 'primekit_c_p_medium',
                            'primekit_cost_calculator_price_2' => 300,
                            'primekit_cost_calculator_pack_3' => 'primekit_c_p_high',
                            'primekit_cost_calculator_price_3' => 500,
                        ],
                        [
                            'page_list' => esc_html__('Page #3', 'primekit-addons'),
                            'primekit_cost_calculator_pack_1' => 'primekit_c_p_low',
                            'primekit_cost_calculator_price_1' => 400,
                            'primekit_cost_calculator_pack_2' => 'primekit_c_p_medium',
                            'primekit_cost_calculator_price_2' => 600,
                            'primekit_cost_calculator_pack_3' => 'primekit_c_p_high',
                            'primekit_cost_calculator_price_3' => 800,
                        ],
                    ],
                    'title_field' => '{{{ page_list }}}', // Dynamically show the title in the repeater list
                ]
            );

            $this->end_controls_section(); // end: Section


            // Section: Labels
            $this->start_controls_section(
                'labels_section',
                [
                    'label' => esc_html__('Options', 'primekit-addons'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

            // Label for the heading
            $this->add_control(
                'primekit_cost_calculator_heading',
                [
                    'label' => esc_html__('Heading Label', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('COMPLEXITY', 'primekit-addons'),
                    'description' => esc_html__('Label for the heading.', 'primekit-addons'),
                ]
            );

            // Label for the range slider
            $this->add_control(
                'primekit_cost_calculator_slider_label',
                [
                    'label' => esc_html__('Range Slider Label', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('NUMBER OF PAGES', 'primekit-addons'),
                    'description' => esc_html__('Label for the range slider.', 'primekit-addons'),
                ]
            );

            // Label for the total
            $this->add_control(
                'primekit_cost_calculator_total_label',
                [
                    'label' => esc_html__('Total Label', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('Total', 'primekit-addons'),
                    'description' => esc_html__('Label for the total.', 'primekit-addons'),
                ]
            );

            //label for the button
            $this->add_control(
                'primekit_cost_calculator_button_label',
                [
                    'label' => esc_html__('Button Label', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('Send Request', 'primekit-addons'),
                    'description' => esc_html__('Label for the button.', 'primekit-addons'),
                ]
            );
            //button url
            $this->add_control(
                'primekit_cost_calculator_button_url',
                [
                    'label' => esc_html__('Button URL', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('#', 'primekit-addons'),
                    'description' => esc_html__('Enter the URL for the button.', 'primekit-addons'),
                ]
            );

            // Currency field
            $this->add_control(
                'primekit_cost_calculator_currency',
                [
                    'label' => esc_html__('Currency', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '$',
                    'description' => esc_html__('Enter the currency symbol.', 'primekit-addons'),
                ]
            );


            // Default value field
            $this->add_control(
                'primekit_cost_calculator_default_value',
                [
                    'label' => esc_html__('Default Slider Value', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '2',
                    'description' => esc_html__('Enter the default value for the range slider.', 'primekit-addons'),
                ]
            );


            $this->end_controls_section(); // end labels section

            // Section: Style
            $this->start_controls_section(
                'general_style_section',
                [
                    'label' => esc_html__('General Style', 'primekit-addons'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            //width of the widget
            $this->add_responsive_control(
                'primekit_cost_calculator_width',
                [
                    'label' => esc_html__('Width', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 300,
                            'max' => 2000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-calculator' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // Background for the widget
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'primekit_cost_calculator_background',
                    'label' => esc_html__('Background', 'primekit-addons'),
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .primekit-pricing-calculator',
                ]
            );

            // Border for the widget
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'primekit_cost_calculator_border',
                    'label' => esc_html__('Border', 'primekit-addons'),
                    'selector' => '{{WRAPPER}} .primekit-pricing-calculator',
                ]
            );

            // Border radius for the widget
            $this->add_responsive_control(
                'primekit_cost_calculator_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-calculator' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Margin for the widget
            $this->add_responsive_control(
                'primekit_cost_calculator_margin',
                [
                    'label' => esc_html__('Margin', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-calculator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Padding for the widget
            $this->add_responsive_control(
                'primekit_cost_calculator_padding',
                [
                    'label' => esc_html__('Padding', 'primekit-addons'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-calculator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Box Shadow for the widget
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'primekit_cost_calculator_box_shadow',
                    'label' => esc_html__('Box Shadow', 'primekit-addons'),
                    'selector' => '{{WRAPPER}} .primekit-pricing-calculator',
                ]
            );

            $this->end_controls_section(); // end: Style

            /**
             * Style Tab
             */
            $this->start_controls_section(
                'style_label',
                [
                    'label' => esc_html__('Label', 'primekit-addons'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            // heading typography
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'primekit_cost_calculator_heading_label_typography',
                    'label' => esc_html__('Heading Typography', 'primekit-addons'),
                    'selector' => '{{WRAPPER}} .primekit-pricing-cal-heading h2',
                ]
            );

            //heading color
            $this->add_control(
                'primekit_cost_calculator_heading_label_color',
                [
                    'label' => esc_html__('Heading Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'description' => esc_html__('Set the color of the main heading text in the pricing calculator section.', 'primekit-addons'),
                    'default' => '#000',
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-heading h2' => 'color: {{VALUE}}',
                    ],
                ]
            );

            // total typography
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'primekit_cost_calculator_total_label_typography',
                    'label' => esc_html__('Total Text Typography', 'primekit-addons'),
                    'selector' => '{{WRAPPER}} .primekit-pricing-cal-total-price p:not(#primekit-total-price)',
                ]
            );

            // total label color
            $this->add_control(
                'primekit_cost_calculator_total_label_color',
                [
                    'label' => esc_html__('Total Text Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'description' => esc_html__('Set the color of the "Total" label that appears before the total price.', 'primekit-addons'),
                    'default' => '#000',
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-total-price p:not(#primekit-total-price)' => 'color: {{VALUE}}',
                    ],
                ]
            );

            // total amount typography
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'primekit_cost_calculator_total_amount_typography',
                    'label' => esc_html__('Total Amount Typography', 'primekit-addons'),
                    'selector' => '{{WRAPPER}} .primekit-pricing-cal-total-price #primekit-total-price',
                ]
            );

            // total amount color
            $this->add_control(
                'primekit_cost_calculator_total_amount_color',
                [
                    'label' => esc_html__('Total Amount Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'description' => esc_html__('Set the color of the total amount in the pricing calculator.', 'primekit-addons'),
                    'default' => '#000',
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-total-price #primekit-total-price' => 'color: {{VALUE}}',
                    ],
                ]
            );


            $this->end_controls_section(); // end label style section

            // start package name style section
            $this->start_controls_section(
                'primekit_cost_calculator_package_name_style',
                [
                    'label' => esc_html__('Package Name', 'primekit-addons'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            // package label typography
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'primekit_cost_calculator_package_label_typography',
                    'label' => esc_html__('Typography', 'primekit-addons'),
                    'selector' => '{{WRAPPER}} .primekit-pricing-option .primekit-pricing-label-text',
                    'description' => esc_html__('Customize the typography for the package labels (e.g., Low, Medium, High) displayed next to each pricing option.', 'primekit-addons'),
                ]
            );

            // package label
            $this->add_control(
                'primekit_cost_calculator_package_label_color',
                [
                    'label' => esc_html__('Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'description' => esc_html__('Set the color for the package labels (e.g., Low, Medium, High) displayed next to each pricing option.', 'primekit-addons'),
                    'default' => '#666',
                    'selectors' => [
                        '{{WRAPPER}}  .primekit-pricing-option .primekit-pricing-label-text' => 'color: {{VALUE}}',
                    ],
                ]
            );
            //package name gap
            $this->add_responsive_control(
                'primekit_cost_calculator_package_label_gap',
                [
                    'label' => esc_html__('Gap', 'primekit-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'description' => esc_html__('Set the space (gap) between the package labels (e.g., Low, Medium, High) in the pricing options.', 'primekit-addons'),
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-label .primekit-pricing-options' => 'gap: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            // radio bullet size
            $this->add_responsive_control(
                'primekit_cost_calculator_package_radio_size',
                [
                    'label' => esc_html__('Button Size', 'primekit-addons'),
                    'description' => esc_html__('Adjust the size of the radio buttons used for package selection in the pricing options.', 'primekit-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-options .primekit-cost-est-pack-radio' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            // radio color
            $this->add_control(
                'primekit_cost_calculator_package_radio_color',
                [
                    'label' => esc_html__('Button Color', 'primekit-addons'),
                    'description' => esc_html__('Choose the color for the border of the radio buttons in the pricing options.', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#c634f7',
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-options .primekit-cost-est-pack-radio' => 'border-color: {{VALUE}}',
                    ],
                ]
            );

            // active radio color
            $this->add_control(
                'primekit_cost_calculator_package_active_radio_color',
                [
                    'label' => esc_html__('Active Button Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'description' => esc_html__('Set the background and border color for the radio button when it is selected (active state).', 'primekit-addons'),
                    'default' => '#c634f7',
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-options .primekit-pricing-option input[type="radio"]:checked + .primekit-cost-est-pack-radio' => 'background-color: {{VALUE}};border-color:{{VALUE}}',
                    ],
                ]
            );

            $this->end_controls_section(); // end package name style section


            // add style section for slider
            $this->start_controls_section(
                'primekit_cost_calculator_slider_style',
                [
                    'label' => esc_html__('Range Slider', 'primekit-addons'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );
            // add typography and color
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'primekit_cost_calculator_slider_heading_typography',
                    'label' => esc_html__('Heading Typography', 'primekit-addons'),
                    'description' => esc_html__('Customize the typography for the main heading of the range slider section.', 'primekit-addons'),
                    'selector' => '{{WRAPPER}} .primekit-pricing-cal-pages-top h2',
                ]
            );

            //range slider heading
            $this->add_control(
                'primekit_cost_calculator_slider_heading_color',
                [
                    'label' => esc_html__('Heading Color', 'primekit-addons'),
                    'description' => esc_html__('Set the color for the main heading in the range slider section.', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#666666',
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-pages-top h2' => 'color: {{VALUE}}',
                    ],
                ]
            );

            // Add typography settings for the slider's page number display
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'primekit_cost_calculator_slider_page_number_typography',
                    'label' => esc_html__('Page Number Typography', 'primekit-addons'),
                    'description' => esc_html__('Customize the typography for the page numbers displayed in the range slider section.', 'primekit-addons'),
                    'selector' => '{{WRAPPER}} .primekit-pricing-cal-pages-top p,{{WRAPPER}} .primekit-pricing-cal-range-bottom p',
                ]
            );

            // Add color control for the slider's page number display
            $this->add_control(
                'primekit_cost_calculator_slider_page_number_color',
                [
                    'label' => esc_html__('Page Number Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'description' => esc_html__('Set the color for the page numbers in the range slider, including both the top and bottom sections.', 'primekit-addons'),
                    'default' => '#666666',
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-pages-top p' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .primekit-pricing-cal-range-bottom p' => 'color: {{VALUE}}',
                    ],
                ]
            );

            // Add control for the active (filled) slider color
            $this->add_control(
                'slider_active_color',
                [
                    'label' => esc_html__('Slider Active Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#c634f7',
                    'selectors' => [
                        '{{WRAPPER}} .primekit-range-slider' => '--active-color: {{VALUE}};',
                    ],
                ]
            );

            // Add control for the inactive (unfilled) slider color
            $this->add_control(
                'slider_inactive_color',
                [
                    'label' => esc_html__('Slider Inactive Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ddd',
                    'selectors' => [
                        '{{WRAPPER}} .primekit-range-slider' => '--inactive-color: {{VALUE}};',
                    ],
                ]
            );

            // Add control for the thumb color
            $this->add_control(
                'slider_thumb_color',
                [
                    'label' => esc_html__('Slider Pointer Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#c634f7',
                    'selectors' => [
                        '{{WRAPPER}} .primekit-range-slider' => '--thumb-color: {{VALUE}};',
                    ],
                ]
            );


            $this->end_controls_section(); // end range slider style section


            // Style section for the button
            $this->start_controls_section(
                'style_button',
                [
                    'label' => esc_html__('Button', 'primekit-addons'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'button_alignment',
                [
                    'label' => esc_html__('Alignment', 'primekit-addons'),
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
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-submit-button' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );


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
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 200,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-submit-button a' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_padding',
                [
                    'label' => esc_html__('Padding', 'primekit-addons'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-submit-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_margin',
                [
                    'label' => esc_html__('Margin', 'primekit-addons'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-submit-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'label' => esc_html__('Typography', 'primekit-addons'),
                    'selector' => '{{WRAPPER}} .primekit-pricing-cal-submit-button a',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'button_border',
                    'label' => esc_html__('Border', 'primekit-addons'),
                    'selector' => '{{WRAPPER}} .primekit-pricing-cal-submit-button a',
                ]
            );

            $this->add_responsive_control(
                'button_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'primekit-addons'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-submit-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );


            $this->start_controls_tabs('button_style_tabs');

            $this->start_controls_tab('button_style_normal_tab', [
                'label' => esc_html__('Normal', 'primekit-addons'),
            ]);
            $this->add_control(
                'button_text_color',
                [
                    'label' => esc_html__('Text Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-submit-button a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'button_background',
                    'label' => esc_html__('Background', 'primekit-addons'),
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .primekit-pricing-cal-submit-button a',
                ]
            );
            $this->end_controls_tab();

            $this->start_controls_tab('button_style_hover_tab', [
                'label' => esc_html__('Hover', 'primekit-addons'),
            ]);

            $this->add_control(
                'button_text_color_hover',
                [
                    'label' => esc_html__('Text Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-submit-button a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'button_background_hover',
                    'label' => esc_html__('Background', 'primekit-addons'),
                    'types' => ['classic', 'gradient'],
                    'exclude' => ['image'],
                    'selector' => '{{WRAPPER}} .primekit-pricing-cal-submit-button a:hover',
                ]
            );

            $this->add_control(
                'button_border_color_hover',
                [
                    'label' => esc_html__('Border Color', 'primekit-addons'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .primekit-pricing-cal-submit-button a:hover' => 'border-color: {{VALUE}}',
                    ],
                ]
            );


            $this->end_controls_tab();

            $this->end_controls_tabs(); // end button style tabs

            $this->end_controls_section(); // end button style section
        }
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'RenderView.php';
    }


}