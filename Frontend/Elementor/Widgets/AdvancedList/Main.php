<?php

namespace PrimeKit\Frontend\Elementor\Widgets\AdvancedList;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-advanced-list';
    }

    public function get_title()
    {
        return esc_html__('Advanced List', 'primekit-addons');
    }

    public function get_icon()
    {
        return 'eicon-editor-list-ul primekit-addons-icon';
    }

    public function get_categories()
    {
        return ['primekit-category'];
    }

    public function get_keywords()
    {
        return ['prime', 'advance', 'list'];
    }

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Advanced List', 'primekit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // List Repeater 
        $this->add_control(
            'primekit_advanced_list_items',
            [
                'label' => esc_html__('', 'primekit-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    //Title
                    [
                        'name' => 'list_title',
                        'label' => esc_html__('Title', 'primekit-addons'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('List Title', 'primekit-addons'),
                        'label_block' => true,
                        'dynamic' => [
                            'active' => true
                        ]
                    ],
                    // Sub Title
                    [
                        'name' => 'list_sub_title',
                        'label' => esc_html__('Sub Title', 'primekit-addons'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('List Sub Title', 'primekit-addons'),
                        'label_block' => true,
                        'dynamic' => [
                            'active' => true
                        ]
                    ],
                    [
                        'name' => 'list_assets_option',
                        'label' => esc_html__('Assets Type', 'primekit-addons'),
                        'type' => \Elementor\Controls_Manager::CHOOSE,
                        'default' => 'solid',
                        'options' => [
                            'icon' => [
                                'title' => esc_html__('Icon', 'primekit-addons'),
                                'icon' => 'eicon-star',
                            ],
                            'image' => [
                                'title' => esc_html__('Image', 'primekit-addons'),
                                'icon' => 'eicon-image-bold',
                            ],
                            'number' => [
                                'title' => esc_html__('Number Count', 'primekit-addons'),
                                'icon' => 'eicon-number-field',
                            ],
                        ],
                    ],
                    // Icon Control 
                    [
                        'name' => 'list_assets_icon',
                        'label' => esc_html__('Icon', 'primekit-addons'),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'condition' => [
                            'list_assets_option' => 'icon',
                        ],
                        'default' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ]
                    ],

                    // Image Control 
                    [
                        'name' => 'list_assets_img',
                        'label' => esc_html__('Choose Image', 'primekit-addons'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'condition' => [
                            'list_assets_option' => 'image',
                        ],
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                ],
                'default' => [
                    [
                        'list_title' => esc_html__('Title #2', 'primekit-addons'),
                        'list_sub_title' => esc_html__('Subtitle', 'primekit-addons'),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );




        $this->end_controls_section();
        // End content tab

        // Start Style Tab
        $this->start_controls_section(
            'primekit_advanced_list_style',
            [
                'label' => esc_html__('List Item', 'primekit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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