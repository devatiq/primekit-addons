<?php

namespace PrimeKit\Frontend\Elementor\Widgets\Copyright;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-copyright';
    }
    
    public function get_title()
    {
        return esc_html__('Copyright', 'primekit-addons');
    }
    
    public function get_icon()
    {
        return 'eicon-email-field primekit-addons-icon';
    }
    
    public function get_categories()
    {
        return ['primekit-category'];
    }
    
    public function get_keywords()
    {
        return ['prime', 'copyright', 'copy'];
    }    
    
    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_copyright_setting',
            [
                'label' => esc_html__('Contents', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        // Before Text
        $this->add_control(
            'primekit_before_text',
            [
                'label' => esc_html__('Before Text', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your before text here', 'primekit-addons'),
                'label_block' => true,
                'default' => esc_html__('Copyright', 'primekit-addons'),
            ]
        );

        // Copyright Year
        $this->add_control(
            'primekit_copyright_year',
            [
                'label' => esc_html__('Copyright Year', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'primekit-addons'),
                'label_off' => esc_html__('No', 'primekit-addons'),
                'return_value' => 'yes',
                'default'   => 'yes',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'primekit_copyright_year_format',
            [
                'label' => esc_html__('Year Format', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'Y' => esc_html__('Default Year', 'primekit-addons'),
                    'y' => esc_html__('Short Year', 'primekit-addons'),
                ],
                'condition' => [
                    'primekit_copyright_year' => 'yes',
                ],
                'default' => 'Y',
            ]
        );
        // After Text
        $this->add_control(
            'primekit_after_text',
            [
                'label' => esc_html__('After Text', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your after text here', 'primekit-addons'),
                'label_block' => true,
                'default' => esc_html__('All rights reserved.', 'primekit-addons'),
            ]
        );

        $this->end_controls_section(); // End Section

        // Start Section for Style
        $this->start_controls_section(
            'primekit_copyright_style',
            [
                'label' => esc_html__('Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,                
            ]
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