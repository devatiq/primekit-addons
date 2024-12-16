<?php
namespace PrimeKit\Frontend\Elementor\Widgets\Lottie;

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Main extends Widget_Base
{
	public function get_name()
	{
		return 'primekit-lottie-icon';
	}

	public function get_title()
	{
		return esc_html__('Lottie Icon', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-lottie primekit-addons-icon';
	}

	public function get_categories()
	{
		return ['primekit-category'];
	}

	public function get_keywords()
	{
		return ['prime', 'lottie', 'icon'];
	}

    protected function register_controls() {
        $this->start_controls_section(
            'primekit-elementor-lottie-icon-content',
            [
                'label' => esc_html__( 'Content', 'primekit-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'source',
			[
				'label' => esc_html__( 'Source', 'primekit-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'media_file',
				'options' => [
					'media_file' => esc_html__( 'Media File', 'primekit-addons' ),
					'external_url' => esc_html__( 'External URL', 'primekit-addons' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'source_external_url',
			[
				'label' => esc_html__( 'External URL', 'primekit-addons' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'source' => 'external_url',
				],
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Enter your URL', 'primekit-addons' ),
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'source_json',
			[
				'label' => esc_html__( 'Upload JSON File', 'primekit-addons' ),
				'type' => Controls_Manager::MEDIA,
				'media_types' => [ 'application/json' ],
				'frontend_available' => true,
				'condition' => [
					'source' => 'media_file',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'primekit-addons' ),
				'type' => Controls_Manager::CHOOSE,
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
				'prefix_class' => 'elementor%s-align-',
				'default' => 'center',
			]
		);

		$this->add_control(
			'caption_source',
			[
				'label' => esc_html__( 'Caption', 'primekit-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'primekit-addons' ),
					'title' => esc_html__( 'Title', 'primekit-addons' ),
					'caption' => esc_html__( 'Caption', 'primekit-addons' ),
					'custom' => esc_html__( 'Custom', 'primekit-addons' ),
				],
				'condition' => [
					'source!' => 'external_url',
					'source_json[url]!' => '',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'caption',
			[
				'label' => esc_html__( 'Custom Caption', 'primekit-addons' ),
				'type' => Controls_Manager::TEXT,
				'render_type' => 'none',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'caption_source',
							'value' => 'custom',
						],
						[
							'name' => 'source',
							'value' => 'external_url',
						],
					],
				],
				'dynamic' => [
					'active' => true,
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => esc_html__( 'Link', 'primekit-addons' ),
				'type' => Controls_Manager::SELECT,
				'render_type' => 'none',
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'primekit-addons' ),
					'custom' => esc_html__( 'Custom URL', 'primekit-addons' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'custom_link',
			[
				'label' => esc_html__( 'Link', 'primekit-addons' ),
				'type' => Controls_Manager::URL,
				'render_type' => 'none',
				'placeholder' => esc_html__( 'Enter your URL', 'primekit-addons' ),
				'condition' => [
					'link_to' => 'custom',
				],
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
				'show_label' => false,
				'frontend_available' => true,
			]
		);

        $this->end_controls_section();//end content

		//settings section
		$this->start_controls_section( 'primekit-lottie-settings', [
			'label' => esc_html__( 'Settings', 'primekit-addons' ),
		] );

		$this->add_control(
			'trigger',
			[
				'label' => esc_html__( 'Trigger', 'primekit-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'arriving_to_viewport',
				'options' => [
					'arriving_to_viewport' => esc_html__( 'Viewport', 'primekit-addons' ),
					'on_click' => esc_html__( 'On Click', 'primekit-addons' ),
					'on_hover' => esc_html__( 'On Hover', 'primekit-addons' ),
					'bind_to_scroll' => esc_html__( 'Scroll', 'primekit-addons' ),
					'none' => esc_html__( 'None', 'primekit-addons' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'viewport',
			[
				'label' => esc_html__( 'Viewport', 'primekit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'render_type' => 'none',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'trigger',
							'operator' => '===',
							'value' => 'arriving_to_viewport',
						],
						[
							'name' => 'trigger',
							'operator' => '===',
							'value' => 'bind_to_scroll',
						],
					],
				],
				'default' => [
					'sizes' => [
						'start' => 0,
						'end' => 100,
					],
					'unit' => '%',
				],
				'labels' => [
					__( 'Bottom', 'primekit-addons' ),
					__( 'Top', 'primekit-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'effects_relative_to',
			[
				'label' => esc_html__( 'Effects Relative To', 'primekit-addons' ),
				'type' => Controls_Manager::SELECT,
				'render_type' => 'none',
				'condition' => [
					'trigger' => 'bind_to_scroll',
				],
				'default' => 'viewport',
				'options' => [
					'viewport' => esc_html__( 'Viewport', 'primekit-addons' ),
					'page' => esc_html__( 'Entire Page', 'primekit-addons' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Loop', 'primekit-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'render_type' => 'none',
				'condition' => [
					'trigger!' => 'bind_to_scroll',
				],
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'number_of_times',
			[
				'label' => esc_html__( 'Times', 'primekit-addons' ),
				'type' => Controls_Manager::NUMBER,
				'render_type' => 'none',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'trigger',
							'operator' => '!==',
							'value' => 'bind_to_scroll',
						],
						[
							'name' => 'loop',
							'operator' => '===',
							'value' => 'yes',
						],
					],
				],
				'min' => 0,
				'step' => 1,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'link_timeout',
			[
				'label' => esc_html__( 'Link Timeout', 'primekit-addons' ) . ' (ms)',
				'type' => Controls_Manager::NUMBER,
				'render_type' => 'none',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'link_to',
							'operator' => '===',
							'value' => 'custom',
						],
						[
							'name' => 'trigger',
							'operator' => '===',
							'value' => 'on_click',
						],
						[
							'name' => 'custom_link[url]',
							'operator' => '!==',
							'value' => '',
						],
					],
				],
				'description' => esc_html__( 'Redirect to link after selected timeout', 'primekit-addons' ),
				'min' => 0,
				'max' => 5000,
				'step' => 1,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'on_hover_out',
			[
				'label' => esc_html__( 'On Hover Out', 'primekit-addons' ),
				'type' => Controls_Manager::SELECT,
				'render_type' => 'none',
				'condition' => [
					'trigger' => 'on_hover',
				],
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'primekit-addons' ),
					'reverse' => esc_html__( 'Reverse', 'primekit-addons' ),
					'pause' => esc_html__( 'Pause', 'primekit-addons' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'hover_area',
			[
				'label' => esc_html__( 'Hover Area', 'primekit-addons' ),
				'type' => Controls_Manager::SELECT,
				'render_type' => 'none',
				'condition' => [
					'trigger' => 'on_hover',
				],
				'default' => 'animation',
				'options' => [
					'animation' => esc_html__( 'Animation', 'primekit-addons' ),
					'column' => esc_html__( 'Column', 'primekit-addons' ),
					'section' => esc_html__( 'Section', 'primekit-addons' ),
					'container' => esc_html__( 'Container', 'primekit-addons' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'play_speed',
			[
				'label' => esc_html__( 'Play Speed', 'primekit-addons' ) . ' (x)',
				'type' => Controls_Manager::SLIDER,
				'render_type' => 'none',
				'condition' => [
					'trigger!' => 'bind_to_scroll',
				],
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'size_units' => [ 'px' ],
				'dynamic' => [
					'active' => true,
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'start_point',
			[
				'label' => esc_html__( 'Start Point', 'primekit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'frontend_available' => true,
				'render_type' => 'none',
				'default' => [
					'size' => 0,
					'unit' => '%',
				],
				'size_units' => [ '%' ],
			]
		);

		$this->add_control(
			'end_point',
			[
				'label' => esc_html__( 'End Point', 'primekit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'frontend_available' => true,
				'render_type' => 'none',
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'size_units' => [ '%' ],
			]
		);

		$this->add_control(
			'reverse_animation',
			[
				'label' => esc_html__( 'Reverse', 'primekit-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'render_type' => 'none',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'trigger',
							'operator' => '!==',
							'value' => 'bind_to_scroll',
						],
						[
							'name' => 'trigger',
							'operator' => '!==',
							'value' => 'on_hover',
						],
					],
				],
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'renderer',
			[
				'label' => esc_html__( 'Renderer', 'primekit-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'svg',
				'options' => [
					'svg' => esc_html__( 'SVG', 'primekit-addons' ),
					'canvas' => esc_html__( 'Canvas', 'primekit-addons' ),
				],
				'separator' => 'before',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'lazyload',
			[
				'label' => esc_html__( 'Lazy Load', 'primekit-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
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

		$this->end_controls_section(); // end Settings

		//Style
		$this->start_controls_section(
			'primekit-elementor-lottie-icon-style',
			[
				'label' => esc_html__( 'Lottie', 'primekit-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'primekit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'em' => [
						'max' => 100,
					],
					'rem' => [
						'max' => 100,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--lottie-container-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' => esc_html__( 'Max Width', 'primekit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'em' => [
						'max' => 100,
					],
					'rem' => [
						'max' => 100,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--lottie-container-max-width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs( 'image_effects' );

			$this->start_controls_tab( 'normal',
				[
					'label' => esc_html__( 'Normal', 'primekit-addons' ),
				]
			);

			$this->add_control(
				'opacity',
				[
					'label' => esc_html__( 'Opacity', 'primekit-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 1,
							'min' => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}}' => '--lottie-container-opacity: {{SIZE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' => 'css_filters',
					'selector' => '{{WRAPPER}} .e-lottie__container',
				]
			);

			// Normal.
			$this->end_controls_tab();

			$this->start_controls_tab( 'hover',
				[
					'label' => esc_html__( 'Hover', 'primekit-addons' ),
				]
			);

			$this->add_control(
				'opacity_hover',
				[
					'label' => esc_html__( 'Opacity', 'primekit-addons' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 1,
							'min' => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}}' => '--lottie-container-opacity-hover: {{SIZE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' => 'css_filters_hover',
					'selector' => '{{WRAPPER}} .e-lottie__container:hover',
				]
			);

			$this->add_control(
				'background_hover_transition',
				[
					'label' => esc_html__( 'Transition Duration', 'primekit-addons' ) . ' (s)',
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 3,
							'step' => 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}}' => '--lottie-container-transition-duration-hover: {{SIZE}}s',
					],
				]
			);

			// Hover.
			$this->end_controls_tab();

		// Image effects.
		$this->end_controls_tabs();

		// lottie style.
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_caption',
			[
				'label' => esc_html__( 'Caption', 'primekit-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_source!' => 'none',
				],
			]
		);

		$this->add_control(
			'caption_align',
			[
				'label' => esc_html__( 'Alignment', 'primekit-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}}' => '--caption-text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'primekit-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => '--caption-color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .e-lottie__caption',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_responsive_control(
			'caption_space',
			[
				'label' => esc_html__( 'Spacing', 'primekit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 10,
					],
					'rem' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--caption-margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

    }

    protected function render() {      
		include 'renderview.php';
    }
}