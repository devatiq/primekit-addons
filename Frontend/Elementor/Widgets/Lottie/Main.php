<?php
namespace PrimeKit\Frontend\Elementor\Widgets\Lottie;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;

class Main extends \Elementor\Widget_Base
{
	/**
	 * Return the name of this widget.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_name()
	{
		return 'primekit-lottie';
	}

	/**
	 * Return the title of this widget.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_title()
	{
		return esc_html__('Lottie', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-lottie primekit-addons-icon';
	}

	/**
	 * Return the list of categories that the widget belongs to.
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function get_categories()
	{
		return ['primekit-category'];
	}

	/**
	 * Return the list of keywords associated with this widget.
	 *
	 * @return array
	 * @since 1.0.0
	 */

	public function get_keywords()
	{
		return ['lottie', 'animation', 'json', 'gif', 'interactive'];
	}

	/**
	 * Return the list of script dependencies required by this widget.
	 *
	 * @return array An array of script handles.
	 * @since 1.0.0
	 */

	/**
	 * Retrieve the list of script dependencies required by this widget.
	 *
	 * @return array An array of script handles.
	 * @since 1.0.0
	 */

	public function get_script_depends()
	{
		return ['primekit-lottie', 'primekit-lottie-init'];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'lottie_section_content',
			[
				'label' => esc_html__('Content', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'lottie_source',
			[
				'label' => esc_html__('Source', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'media_file',
				'options' => [
					'media_file' => esc_html__('Media File', 'primekit-addons'),
					'external_url' => esc_html__('External URL', 'primekit-addons'),
				],
			]
		);

		$this->add_control(
			'lottie_media_file',
			[
				'label' => esc_html__('Upload JSON File', 'primekit-addons'),
				'type' => Controls_Manager::MEDIA,
				'media_types' => ['application/json'],
				'condition' => [
					'lottie_source' => 'media_file',
				],
			]
		);

		$this->add_control(
			'lottie_external_url',
			[
				'label' => esc_html__('External URL', 'primekit-addons'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('https://example.com/animation.json', 'primekit-addons'),
				'condition' => [
					'lottie_source' => 'external_url',
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__('Autoplay', 'primekit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => esc_html__('Loop', 'primekit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'loop_count',
			[
				'label' => esc_html__('Loop Count', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					],
				],
				'condition' => [
					'loop' => 'yes',
				],
			]
		);

		$this->add_control(
			'reverse',
			[
				'label' => esc_html__('Reverse', 'primekit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);

		$this->add_control(
			'render_type',
			[
				'label' => esc_html__('Render Type', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'svg',
				'options' => [
					'svg' => esc_html__('SVG', 'primekit-addons'),
					'canvas' => esc_html__('Canvas', 'primekit-addons'),
				],
			]
		);

		$this->add_control(
			'on_hover_action',
			[
				'label' => esc_html__('On Hover', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('None', 'primekit-addons'),
					'play' => esc_html__('Play', 'primekit-addons'),
					'pause' => esc_html__('Pause', 'primekit-addons'),
					'reverse' => esc_html__('Reverse', 'primekit-addons'),
				],
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => esc_html__('Speed', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 1,
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'lottie_section_style',
			[
				'label' => esc_html__('Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'lottie_alignment',
			[
				'label' => esc_html__('Alignment', 'primekit-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'primekit-addons'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'primekit-addons'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'primekit-addons'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'display: flex; justify-content: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'lottie_width',
			[
				'label' => esc_html__('Width', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'], // Allow pixels and percentage
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-lottie-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'lottie_opacity',
			[
				'label' => esc_html__('Opacity', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 1,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-lottie-wrapper' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .primekit-lottie-wrapper',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the Lottie animation widget.
	 *
	 * This function retrieves the widget settings, including the Lottie animation
	 * source, playback options, and rendering preferences. It then outputs the
	 * HTML markup required to display the Lottie animation on the frontend.
	 *
	 * If the animation URL is not provided, a message is displayed prompting the
	 * user to provide a valid JSON file.
	 *
	 * The function supports various settings such as autoplay, loop, reverse
	 * playback, rendering type, hover actions, and animation speed.
	 *
	 * @since 1.0.0
	 */

	protected function render()
	{
		include 'renderview.php';
	}


}