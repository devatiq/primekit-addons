<?php
namespace PrimeKit\Frontend\Elementor\Widgets\GlassCard;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base
{

	public function get_name()
	{
		return 'primekit-GlassCard';
	}

	public function get_title()
	{
		return esc_html__('Glass Card', 'primekit-addons');
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
		return ['prime', 'glass', 'card'];
	}

	/**
	 * Register list widget controls.
	 */
	protected function register_controls()
	{
		//Template
		$this->start_controls_section(
			'primekit-glass-card-contents',
			[
				'label' => esc_html__('Contents', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'card_icon',
			[
				'label' => esc_html__('Icon', 'primekit-addons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'card_title',
			[
				'label' => esc_html__('Title', 'primekit-addons'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title', 'primekit-addons'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'card_number',
			[
				'label' => esc_html__('Card Number', 'primekit-addons'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('01', 'primekit-addons'),
				'label_block' => true,
			]
		);

		$this->end_controls_section();


		//Card Style
		$this->start_controls_section(
			'primekit-glass-card-style',
			[
				'label' => esc_html__('Card Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Gap
		$this->add_responsive_control(
			'card_gap',
			[
				'label' => esc_html__('Gap', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-glass-card' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Card Width
		$this->add_responsive_control(
			'card_width',
			[
				'label' => esc_html__('Card Width', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 50,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 260,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-glass-card-area' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Label for .primekit-glass-card-area
		$this->add_control(
			'glass_card_area_label',
			[
				'label' => esc_html__('Outer Card', 'primekit-addons'),
				'type' => Controls_Manager::HEADING,
			]
		);
		//Glass Card Area Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'glass_card_area_bg',
				'label' => esc_html__('Background', 'primekit-addons'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .primekit-glass-card-area',
			]
		);
		// Border for outer card
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'outer_card_border',
				'label' => esc_html__('Border', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-glass-card-area',
			]
		);

		// Border Radius for outer card
		$this->add_control(
			'outer_card_border_radius',
			[
				'label' => esc_html__('Border Radius', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default' => [
					'top' => 15,
					'right' => 15,
					'bottom' => 15,
					'left' => 15,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-glass-card-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Spacer between groups
		$this->add_control(
			'glass_card_bg_divider',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Label for .primekit-glass-card
		$this->add_control(
			'glass_card_inner_label',
			[
				'label' => esc_html__('Inner Card', 'primekit-addons'),
				'type' => Controls_Manager::HEADING,
			]
		);
		// Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'label' => esc_html__('Border', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-glass-card',
			]
		);
		//Border Radius
		$this->add_control(
			'card_inner_border_radius',
			[
				'label' => esc_html__('Border Radius', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default' => [
					'top' => 15,
					'right' => 15,
					'bottom' => 15,
					'left' => 15,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-glass-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		//Glass Card Inner Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'glass_card_inner_bg',
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .primekit-glass-card',
			]
		);

		$this->add_control(
			'card_padding',
			[
				'label' => esc_html__('Padding', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'top' => 30,
					'right' => 30,
					'bottom' => 30,
					'left' => 30,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-glass-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); //end card style

		//Icon Style
		$this->start_controls_section(
			'primekit-glass-card-icon-style',
			[
				'label' => esc_html__('Icon Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 20,
						'step' => 0.1,
					],
					'rem' => [
						'min' => 0,
						'max' => 20,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-glass-card-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .primekit-glass-card-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .primekit-glass-card-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .primekit-glass-card-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); //end icon style


		//Title Style
		$this->start_controls_section(
			'primekit-glass-card-title-style',
			[
				'label' => esc_html__('Title Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .primekit-glass-card-footer h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .primekit-glass-card-footer h2',
			]
		);
		$this->end_controls_section(); //end title style

		//Number Style
		$this->start_controls_section(
			'primekit-glass-card-number-style',
			[
				'label' => esc_html__('Number Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_stroke_color',
			[
				'label' => esc_html__('Stroke Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0, 0, 0, 0.2)',
				'selectors' => [
					'{{WRAPPER}} .primekit-outline-text' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_stroke_width',
			[
				'label' => esc_html__('Stroke Width', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-outline-text' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		//Number Color
		$this->add_control(
			'number_color',
			[
				'label' => esc_html__('Number Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .primekit-outline-text' => 'color: {{VALUE}};',
				],
			]
		);

		//Number Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .primekit-outline-text',
			]
		);

		$this->end_controls_section(); //end number style

	}

	/**
	 * Render the widget output on the frontend.
	 */
	protected function render()
	{
		include 'renderview.php';
	}
}