<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\BackToTop;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-back-top-top';
	}

	public function get_title()
	{
		return esc_html__('Back To Top', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-arrow-up primekit-addons-icon';
	}
	public function get_categories()
	{
		return ['primekit-category'];
	}
	public function get_keywords()
	{
		return ['prime', 'back', 'top', 'button'];
	}    	

		public function get_script_depends()
    {
        return ['primekit-back-to-top']; 
    }

	/**
	 * Register list widget controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'primekit_elementor_back_to_top_setting',
			[
				'label' => esc_html__( 'Settings', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Button type
		$this->add_control(
			'primekit_elementor_back_to_top_type',
			[
				'label' => esc_html__( 'Button Type', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => esc_html__( 'Icon', 'primekit-addons' ),
					'text'  => esc_html__( 'Text', 'primekit-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .your-class' => 'border-style: {{VALUE}};',
				],
			]
		);

		//Button text
		$this->add_control(
			'primekit_elementor_back_to_top_text',
			[
				'label' => esc_html__( 'Button Text', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Top', 'primekit-addons' ),
				'condition' => [
					'primekit_elementor_back_to_top_type' => 'text'
				],
			]
		);

		//display switch
		$this->add_control(
			'primekit_elementor_back_to_top_display_switch',
			[
				'label' => esc_html__( 'Show Always?', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'always_on' => esc_html__( 'Yes', 'primekit-addons' ),
				'always_off' => esc_html__( 'No', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'always_off',
			]
		);

		//Button Position
		$this->add_control(
			'primekit_elementor_back_to_top_position',
			[
				'label' => esc_html__( 'Position', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'fixed',
				'options' => [
					'relative' => esc_html__( 'Relative', 'primekit-addons' ),
					'fixed'  => esc_html__( 'Fixed', 'primekit-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top' => 'position: {{VALUE}};',
				],
			]
		);

		//Bottom position
		$this->add_responsive_control(
			'primekit_elementor_back_to_top_bottom_pos',
			[
				'label' => esc_html__( 'Position from bottom', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_back_to_top_position' => 'fixed',
				],
			]
		);

		//Right position
		$this->add_responsive_control(
			'primekit_elementor_back_to_top_right_pos',
			[
				'label' => esc_html__( 'Position from right', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_back_to_top_position' => 'fixed',
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
				'heading' => esc_html__( 'Created by PrimeKit', 'primekit-addons' ),
				'content' => esc_html__( 'This amazing widget is built with PrimeKit Addons, making it super easy to create beautiful and functional designs.', 'primekit-addons' ),
			]
		);
		
        $this->end_controls_section();//end setting section

		//Style Section
		$this->start_controls_section(
			'primekit_elementor_back_to_top_style',
			[
				'label' => esc_html__( 'Button Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Background Color
		$this->add_control(
			'primekit_elementor_back_to_top_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#0349e7',
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Background Hover Color
		$this->add_control(
			'primekit_elementor_back_to_top_bg_hov_color',
			[
				'label' => esc_html__( 'Hover Background Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#a03bf4',
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Icon Color
		$this->add_control(
			'primekit_elementor_back_to_top_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_back_to_top_type' => 'icon'
				],
			]
		);

		//Icon Hover Color
		$this->add_control(
			'primekit_elementor_back_to_top_icon_hov_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top:hover svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_back_to_top_type' => 'icon'
				],
			]
		);

		//Text Color
		$this->add_control(
			'primekit_elementor_back_to_top_text_color',
			[
				'label' => esc_html__( 'Text Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top' => 'color: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_back_to_top_type' => 'text'
				],
			]
		);

		//Text Color
		$this->add_control(
			'primekit_elementor_back_to_top_text_hov_color',
			[
				'label' => esc_html__( 'Text Hover Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'primekit_elementor_back_to_top_type' => 'text'
				],
			]
		);

		//Text Typograghy
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'primekit-addons' ),
				'name' => 'primekit_elementor_back_to_top_text_typography',
				'selector' => '{{WRAPPER}} #primekit-back-to-top',
				'condition' => [
					'primekit_elementor_back_to_top_type' => 'text'
				],
			]
		);

		//Icon Size
		$this->add_responsive_control(
			'primekit_elementor_back_to_top_icon_size',
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
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'primekit_elementor_back_to_top_type' => 'icon',
				],
			]
		);

		//Button Spacing
		$this->add_responsive_control(
			'primekit_elementor_back_to_top_spacing',
			[
				'label' => esc_html__( 'Button Spacing', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => 10,
					'right' => 20,
					'bottom' => 10,
					'left' => 20,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Button Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_back_to_top_border',
				'selector' => '{{WRAPPER}} #primekit-back-to-top',
			]
		);

		//Button Border Radius
		$this->add_responsive_control(
			'primekit_elementor_back_to_top_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default' => [
					'top' => 6,
					'right' => 6,
					'bottom' => 6,
					'left' => 6, 
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} #primekit-back-to-top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();//end style section

    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'renderview.php';
    }
}