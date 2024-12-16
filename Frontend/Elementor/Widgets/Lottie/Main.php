<?php
namespace PrimeKit\Frontend\Elementor\Widgets\Lottie;

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

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
				'label' => esc_html__( 'Source', 'elementor-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'media_file',
				'options' => [
					'media_file' => esc_html__( 'Media File', 'elementor-pro' ),
					'external_url' => esc_html__( 'External URL', 'elementor-pro' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'source_external_url',
			[
				'label' => esc_html__( 'External URL', 'elementor-pro' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'source' => 'external_url',
				],
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Enter your URL', 'elementor-pro' ),
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'source_json',
			[
				'label' => esc_html__( 'Upload JSON File', 'elementor-pro' ),
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
				'label' => esc_html__( 'Alignment', 'elementor-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'elementor-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-pro' ),
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
				'label' => esc_html__( 'Caption', 'elementor-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'elementor-pro' ),
					'title' => esc_html__( 'Title', 'elementor-pro' ),
					'caption' => esc_html__( 'Caption', 'elementor-pro' ),
					'custom' => esc_html__( 'Custom', 'elementor-pro' ),
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
				'label' => esc_html__( 'Custom Caption', 'elementor-pro' ),
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
				'label' => esc_html__( 'Link', 'elementor-pro' ),
				'type' => Controls_Manager::SELECT,
				'render_type' => 'none',
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'elementor-pro' ),
					'custom' => esc_html__( 'Custom URL', 'elementor-pro' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'custom_link',
			[
				'label' => esc_html__( 'Link', 'elementor-pro' ),
				'type' => Controls_Manager::URL,
				'render_type' => 'none',
				'placeholder' => esc_html__( 'Enter your URL', 'elementor-pro' ),
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

        $this->end_controls_section();//end content

		//Title Style
		$this->start_controls_section(
            'primekit-elementor-lottie-icon-style',
            [
                'label' => esc_html__( 'Style', 'primekit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		//color
		$this->add_control(
			'primekit-elementor-site-title-color',
			[
				'label' => esc_html__( 'Title Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-ele-site-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();//end site title style

    }

    protected function render() {      
		include 'renderview.php';
    }
}