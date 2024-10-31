<?php
namespace PrimeKit\Frontend\Elementor\Widgets\ArchiveTitle;

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * ABC Archive Title Widget.
 * @since 1.0.0
 */
class Main extends Widget_Base {

    public function get_name()
	{
		return 'primekit-archive-title';
	}

	public function get_title()
	{
		return esc_html__('Archive Title', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-archive-title';
	}
	public function get_categories()
	{
		return ['primekit-category'];
	}
	public function get_keywords()
	{
		return ['prime', 'archive', 'title', 'archive title'];
	}
    

    protected function register_controls() {
        $this->start_controls_section(
            'primekit-elementor-archive-title',
            [
                'label' => esc_html__( 'Archive Title Settings', 'primekit-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'primekit_elementor_archive_title_tag',
            [
                'label' => esc_html__('Archive Title Tag', 'primekit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h1',
                'options' => [
                    'h1' => esc_html__('H1', 'primekit-addons'),
                    'h2' => esc_html__('H2', 'primekit-addons'),
                    'h3' => esc_html__('H3', 'primekit-addons'),
                    'h4' => esc_html__('H4', 'primekit-addons'),
                    'h5' => esc_html__('H5', 'primekit-addons'),
                    'H6' => esc_html__('H6', 'primekit-addons'),
                ],
            ]
        );

        $this->add_responsive_control(
            'primekit_elementor_archive_title_align',
            [
                'label' => esc_html__( 'Alignment', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
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
                    '{{WRAPPER}} .primekit-archive-title-tag' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'primekit_elementor_archive_title_color',
            [
                'label' => esc_html__( 'Color', 'primekit-addons' ),
                'type'  => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .primekit-archive-title-tag' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_archive_title_typography',
                'label' => esc_html__( 'Typography', 'primekit-addons' ),
                'selector' => '{{WRAPPER}} .primekit-archive-title-tag',
            ]
        );

        //PrimeKit Notice
		$this->add_control(
			'primekit_elementor_addons_notice',
			[
				'type' => \Elementor\Controls_Manager::NOTICE,
				'notice_type' => 'warning',
				'dismissible' => false,
				'heading' => esc_html__( 'Created by PrimeKit', 'primekit-addons' ),
				'content' => esc_html__( 'This amazing widget is built with PrimeKit Addons, making it super easy to create beautiful and functional designs.', 'primekit-addons' ),
			]
		);

        $this->end_controls_section();
    }

    protected function render() {      
		include 'renderview.php';
    }
}