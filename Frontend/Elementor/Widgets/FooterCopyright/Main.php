<?php

namespace PrimeKit\Frontend\Elementor\Widgets\FooterCopyright;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;


class Main extends Widget_Base
{
    public function get_name()
    {
        return 'primekit-footer-copyright';
    }

    public function get_title()
    {
        return esc_html__('Footer Copyright', 'primekit-addons');
    }

    public function get_icon()
    {
        return 'eicon-single-post primekit-addons-icon';
    }

    public function get_categories()
    {
        return ['primekit-category'];
    }

    public function get_keywords()
    {
        return ['primekit', 'copyright', 'footer'];
    }

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        
        $this->start_controls_section(
			'primekit-footer-copyright-content',
			[
				'label' => esc_html__( 'Content', 'primekit-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'heading_widget_title',
			[
				'label' => esc_html__( 'Title', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'primekit-addons' ),
				'placeholder' => esc_html__( 'Type your title here', 'primekit-addons' ),
			]
		);

        $this->add_control(
			'copyright_description',
			[
				'label' => esc_html__( 'Description', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Type your description here', 'primekit-addons' ),
			]
		);



        $this->end_controls_section();

        $this->start_controls_section(
			'primekit-footer-copyright-style',
			[
				'label' => esc_html__( 'Style', 'primekit-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-footer-copyright-title' => 'color: {{VALUE}}',
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
        include 'RenderView.php';
    }


}