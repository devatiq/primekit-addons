<?php
namespace PrimeKit\Frontend\Elementor\Widgets\CatInfo;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
    public function get_name()
	{
		return 'primekit-cat-info';
	}

	public function get_title()
	{
		return esc_html__('Post Category', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-apps primekit-addons-icon';
	}
	public function get_categories()
	{
		return ['primekit-category'];
	}
	public function get_keywords()
	{
		return ['prime', 'category', 'post'];
	}

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_post_cat_setting',
            [
                'label' => esc_html__('Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //type
        $this->add_control(
			'primekit_elementor_post_cat_type',
			[
				'label' => esc_html__( 'Display Style', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => [
					'inline' => esc_html__( 'Inline View', 'primekit-addons' ),
					'list'  => esc_html__( 'List View', 'primekit-addons' ),
				],
			]
		);

        //Alignment
		$this->add_responsive_control(
			'primekit_elementor_post_cat_align',
			[
				'label' => esc_html__( 'Alignment', 'primekit-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'primekit-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'primekit-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'primekit-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],				
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-post-cat' => 'text-align: {{VALUE}}',
				],
			]
		);

        //PrimeKit Notice
		$this->add_control(
			'primekit_elementor_addons_notice',
			[
				'type' => \Elementor\Controls_Manager::NOTICE,
				'notice_type' => 'warning',
				'dismissible' => false,
				'heading' => esc_html__('Created by PrimeKit', 'primekit-addons'),
				'content' => esc_html__('This amazing widget is built with PrimeKit Addons, making it super easy to create beautiful and functional designs.', 'primekit-addons'),
			]
		);

        $this->end_controls_section();

        // Category Info style section
        $this->start_controls_section(
            'primekit_elementor_post_cat_style_section',
            [
                'label' => esc_html__('Category Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //icon switch
        $this->add_control(
			'primekit_elementor_post_cat_icon',
			[
				'label' => esc_html__( 'Display Icon?', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'primekit-addons' ),
				'label_off' => esc_html__( 'No', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'condition' => [
                    'primekit_elementor_post_cat_type' => 'list'
                ],
			]
		);

        //blog info typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_post_cat_typography',
                'label' => esc_html__('Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-post-cat',
            ]
        );

        // text color
        $this->add_control(
            'primekit_elementor_post_cat_color',
            [
                'label' => esc_html__('Text Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-post-cat a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // hover color
        $this->add_control(
            'primekit_elementor_post_cat_hover_color',
            [
                'label' => esc_html__('Text Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#c436f7',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-post-cat a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // sep color
        $this->add_control(
            'primekit_elementor_post_cat_sep_color',
            [
                'label' => esc_html__('Separator Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-category-separator' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'primekit_elementor_post_cat_type' => 'inline'
                ],
            ]
        );

        //Separator space
        $this->add_responsive_control(
			'primekit_elementor_post_cat_sep_space',
			[
				'label' => esc_html__( 'Separator Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-category-separator' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_post_cat_type' => 'inline'
                ],
			]
		);

         // icon color
         $this->add_control(
            'primekit_elementor_post_cat_icon_color',
            [
                'label' => esc_html__('Icon Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-post-cat.cat-list-view i.eicon-chevron-double-right' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'primekit_elementor_post_cat_type' => 'list',
                    'primekit_elementor_post_cat_icon' => 'yes'
                ],
            ]
        );

        //Icon Size
        $this->add_responsive_control(
			'primekit_elementor_post_cat_icon_size',
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
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-post-cat.cat-list-view i.eicon-chevron-double-right' => 'font-size: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_post_cat_type' => 'list',
                    'primekit_elementor_post_cat_icon' => 'yes'
                ],
			]
		);

        //Item space
        $this->add_responsive_control(
			'primekit_elementor_post_cat_item_space',
			[
				'label' => esc_html__( 'Item Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-post-cat.cat-list-view div.primekit-ele-category-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_post_cat_type' => 'list',
                    'primekit_elementor_post_cat_icon' => 'yes'
                ],
			]
		);

        //Icon space
        $this->add_responsive_control(
			'primekit_elementor_post_cat_icon_space',
			[
				'label' => esc_html__( 'Icon Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 7,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-post-cat.cat-list-view i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'primekit_elementor_post_cat_type' => 'list',
                    'primekit_elementor_post_cat_icon' => 'yes'
                ],
			]
		);
       
        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
{
    $display_style = $this->get_settings_for_display('primekit_elementor_post_cat_type');
    if ($display_style === 'list') {
        include 'list-view.php';
    } else {
        include 'inline-view.php';
    }
}

}