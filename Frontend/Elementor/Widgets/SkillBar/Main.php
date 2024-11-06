<?php
namespace PrimeKit\Frontend\Elementor\Widgets\SkillBar;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-skillbar';
    }
    
    public function get_title()
    {
        return esc_html__('Skill Bar', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-skill-bar primekit-addons-icon';
    }
    
    public function get_categories()
    {
        return ['primekit-category'];
    }
    
    public function get_keywords()
    {
        return ['PrimeKit', 'skill', 'bar'];
    }
    
    public function get_script_depends()
    {
        return ['primekit-jquery-appear', 'primekit-skill-bar'];
    }
    

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_skill_bar_settings',
            [
                'label' => esc_html__('Skill Settings', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //tooltip switch
        $this->add_control(
            'primekit_elementor_skill_bar_tooltip_switch',
            [
                'label' => esc_html__('Enable Tooltip', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        //tooltip right value
        $this->add_control(
            'primekit_elementor_skill_bar_percent_value_right',
            [
                'label' => esc_html__('Show Value on Right?', 'primekit-addons'),
                'description' => esc_html__('Show percentage value on right side.', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        //skill bar repeater
        $repeater = new \Elementor\Repeater();
        //circle skill text
        $repeater->add_control(
            'primekit_elementor_skill_bar_text',
            [
                'label' => esc_html__('Heading', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Skill Heading', 'primekit-addons'),
            ]
        );
        //circle skill percentage
        $repeater->add_control(
            'primekit_elementor_skill_bar_value',
            [
                'label' => esc_html__('Value', 'primekit-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 80,
            ]
        );
        $repeater->add_control(
            'primekit_elementor_skill_bar_color',
            [
                'label' => esc_html__('Progress Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area {{CURRENT_ITEM}}.primekit-ele-progress-bar-row .primekit-ele-progress-bar > span' => 'background-color: {{VALUE}}',
                ],
            ]
        );        
        $repeater->add_control(
            'primekit_elementor_skill_bar_tooltip_color',
            [
                'label' => esc_html__('Tooltip BG Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area {{CURRENT_ITEM}}.primekit-ele-progress-bar-row .primekit-ele-progress-bar .primekit_skills_bar_percent_tooltip' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .primekit-ele-skill-bar-area {{CURRENT_ITEM}}.primekit-ele-progress-bar-row .primekit-ele-progress-bar .primekit_skills_bar_percent_tooltip:after' => 'border-top-color: {{VALUE}}',
                ],
            ]
        );        
        $repeater->add_control(
            'primekit_elementor_skill_bar_tooltip_text_color',
            [
                'label' => esc_html__('Tooltip Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area {{CURRENT_ITEM}}.primekit-ele-progress-bar-row .primekit-ele-progress-bar .primekit_skills_bar_percent_tooltip' => 'color: {{VALUE}}',
                ],
            ]
        );        
        $this->add_control(
            'primekit_skills_bar_list',
            [
                'label' => esc_html__('Skill Bar', 'primekit-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'primekit_elementor_skill_bar_text' => esc_html__('Title #1', 'primekit-addons'),
                        'primekit_elementor_skill_bar_value' => esc_html__('80', 'primekit-addons'),
                    ],
                    [
                        'primekit_elementor_skill_bar_text' => esc_html__('Title #2', 'primekit-addons'),
                        'primekit_elementor_skill_bar_value' => esc_html__('75', 'primekit-addons'),
                    ],
                ],
                'title_field' => '{{{ primekit_elementor_skill_bar_text }}}',
            ]
        );
        $this->end_controls_section();

        //skill bar style
        $this->start_controls_section(
            'primekit_elementor_skill_bar_style_setting',
            [
                'label' => esc_html__('Skill Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //skill bar spacing
        $this->add_responsive_control(
            'primekit_elementor_skill_bar_spacing',
            [
                'label' => esc_html__('Item Spacing', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //skill height
        $this->add_responsive_control(
            'primekit_elementor_skill_bar_height',
            [
                'label' => esc_html__('Bar Height', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row .primekit-ele-progress-bar' => 'height: {{SIZE}}{{UNIT}};',
                ]

            ]
        );
        // skill bar heading typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_skill_bar_heading_typography',
                'label' => esc_html__('Heading Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row p.primekit-ele-progress-bar-text',
            ]
        );
        // skill bar heading color
        $this->add_control(
            'primekit_elementor_skill_bar_heading_color',
            [
                'label' => esc_html__('Heading Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row p.primekit-ele-progress-bar-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        // skill bar value typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_skill_bar_value_typography',
                'label' => esc_html__('Value Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row p.primekit-ele-progress-bar-text span',
                'condition' => [
                    'primekit_elementor_skill_bar_tooltip_switch!' => 'yes',
                    'primekit_elementor_skill_bar_percent_value_right' => 'yes',
                ]
            ]
        );
        // skill bar value color
        $this->add_control(
            'primekit_elementor_skill_bar_value_color',
            [
                'label' => esc_html__('Value Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row p.primekit-ele-progress-bar-text span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'primekit_elementor_skill_bar_tooltip_switch!' => 'yes',
                    'primekit_elementor_skill_bar_percent_value_right' => 'yes',
                ]
            ]
        );
        // skill bar empty fill color
        $this->add_control(
            'primekit_elementor_skill_bar_empty_fill_color',
            [
                'label' => esc_html__('Empty Prograss Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f5f5f5',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row .primekit-ele-progress-bar' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        // skill bar progress color
        $this->add_control(
            'primekit_elementor_skill_bar_progress_color',
            [
                'label' => esc_html__('Progress Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59a818',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row .primekit-ele-progress-bar > span' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

        //start control section for tooltip
        $this->start_controls_section(
            'primekit_elementor_skill_bar_tooltip',
            [
                'label' => esc_html__('Tooltip', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primekit_elementor_skill_bar_tooltip_switch' => 'yes',
                ],
            ]
        );
        //tooltip background color
        $this->add_control(
            'primekit_elementor_skill_bar_tooltip_background_color',
            [
                'label' => esc_html__('Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2B35FF',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row .primekit-ele-progress-bar .primekit_skills_bar_percent_tooltip' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row .primekit-ele-progress-bar .primekit_skills_bar_percent_tooltip:after' => 'border-top-color: {{VALUE}}',
                ]
            ]
        );
        //tooltip text color
        $this->add_control(
            'primekit_elementor_skill_bar_tooltip_text_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row .primekit-ele-progress-bar .primekit_skills_bar_percent_tooltip' => 'color: {{VALUE}}',
                ]
            ]
        );
        //tooltip typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_skill_bar_tooltip_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row .primekit-ele-progress-bar .primekit_skills_bar_percent_tooltip',
            ]
        );
        //tooltip offset
        $this->add_responsive_control(
            'primekit_elementor_skill_bar_tooltip_offset_top',
            [
                'label' => esc_html__('Offset Top', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row .primekit-ele-progress-bar .primekit_skills_bar_percent_tooltip' => 'top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        //tooltip offset right
        $this->add_responsive_control(
            'primekit_elementor_skill_bar_tooltip_offset_right',
            [
                'label' => esc_html__('Offset Right', 'primekit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-skill-bar-area .primekit-ele-progress-bar-row .primekit-ele-progress-bar .primekit_skills_bar_percent_tooltip' => 'right: {{SIZE}}{{UNIT}}',
                ]
            ],
        );


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