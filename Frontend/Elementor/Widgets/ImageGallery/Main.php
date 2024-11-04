<?php
namespace PrimeKit\Frontend\Elementor\Widgets\ImageGallery;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base
{

	public function get_name()
	{
		return 'primekit-ImageGallery';
	}
	
	public function get_title()
	{
		return esc_html__('Image Gallery', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-gallery-grid primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-category'];
	}
	
	public function get_keywords()
	{
		return ['prime', 'gallery', 'image'];
	}
	
	public function get_style_depends()
	{
		return ['primekit-magnific-popup'];
	}
	
	public function get_script_depends()
	{
		return ['primekit-magnific-popup'];
	}
	

	/**
	 * Register list widget controls.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'primekit_elementor_gallery_contents',
			[
				'label' => esc_html__('Contents', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'primekit_elementor_gallery',
			[
				'label' => esc_html__('Add Images', 'primekit-addons'),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => true,
				'default' => [],
			]
		);

		$this->end_controls_section();//end after text style

		$this->start_controls_section(
			'primekit_elementor_gallery_setting',
			[
				'label' => esc_html__('Options', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		//column
		$this->add_responsive_control(
			'primekit_elementor_gallery_column',
			[
				'label' => esc_html__('Column', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__('1', 'primekit-addons'),
					'2' => esc_html__('2', 'primekit-addons'),
					'3' => esc_html__('3', 'primekit-addons'),
					'4' => esc_html__('4', 'primekit-addons'),
					'5' => esc_html__('5', 'primekit-addons'),
					'6' => esc_html__('6', 'primekit-addons'),
				],
				'default' => '3',
				'tablet_default' => '2',
				'selectors' => [
					'{{WRAPPER}} .primekit-photos-gallery' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'primekit_elementor_gallery_dimensions', // Unique name for the control
				'default' => 'full', // Default image size
				'exclude' => [], 
				'include' => [], 
				'description' => esc_html__('Choose the image size or set custom dimensions.', 'primekit-addons'),
			]
		);
		

		$this->end_controls_section();//end options setting


		$this->start_controls_section(
			'primekit_elementor_gallery_popup_setting',
			[
				'label' => esc_html__('Popup Settings', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		//show title select options
		$this->add_responsive_control(
			'primekit_elementor_gallery_title',
			[
				'label' => esc_html__('Show Title', 'primekit-addons'),
				'type' => Controls_Manager::SELECT,
				'description' => esc_html__('Choose which text to show in the popup.', 'primekit-addons'),
				'options' => [
					'caption' => esc_html__('Caption', 'primekit-addons'),
					'title' => esc_html__('Title', 'primekit-addons'),
					'alt' => esc_html__('Alt', 'primekit-addons'),
					'description' => esc_html__('Description', 'primekit-addons'),
					'none' => esc_html__('None', 'primekit-addons'),
				],
				'default' => 'title',
			]
		);

		//close Icon
		$this->add_control(
			'primekit_elementor_gallery_close_button',
			[
				'label' => esc_html__('Display Close Icon?', 'primekit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'primekit-addons'),
				'label_off' => esc_html__('No', 'primekit-addons'),
				'description' => esc_html__('Enable or disable the close icon for the popup.', 'primekit-addons'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		$this->end_controls_section();

		//style for the gallary
		$this->start_controls_section(
			'primekit_elementor_gallery_style',
			[
				'label' => esc_html__('Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//gap
		$this->add_responsive_control(
			'primekit_elementor_gallery_gap',
			[
				'label' => esc_html__('Gap', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-photos-gallery' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//image border radius
		$this->add_responsive_control(
			'primekit_elementor_gallery_image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .primekit-photos-gallery span img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//image border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_gallery_image_border',
				'label' => esc_html__('Border', 'primekit-addons'),
				'selector' => '{{WRAPPER}} .primekit-photos-gallery span img',
			]
		);

		$this->end_controls_section();

		//add style for popup
		$this->start_controls_section(
			'primekit_elementor_gallery_popup_style',
			[
				'label' => esc_html__('Popup', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//popup image width
		$this->add_responsive_control(
			'primekit_elementor_gallery_popup_image_width',
			[
				'label' => esc_html__('Image Width', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'selectors' => [
					'.primekit-photos-gallery-popup .mfp-content img.mfp-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//popup image height
		$this->add_responsive_control(
			'primekit_elementor_gallery_popup_image_height',
			[
				'label' => esc_html__('Image Height', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'selectors' => [
					'.primekit-photos-gallery-popup .mfp-content img.mfp-img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//popup image border radius
		$this->add_responsive_control(
			'primekit_elementor_gallery_popup_image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'primekit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'.primekit-photos-gallery-popup .mfp-content img.mfp-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//popup image border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_gallery_popup_image_border',
				'label' => esc_html__('Border', 'primekit-addons'),
				'selector' => '.primekit-photos-gallery-popup .mfp-content img.mfp-img',
			]
		);

		//close button color
		$this->add_control(
			'primekit_elementor_gallery_popup_close_button_color',
			[
				'label' => esc_html__('Close Icon Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.primekit-photos-gallery-popup button.mfp-close' => 'color: {{VALUE}};',
				],
			]
		);

		//close button size
		$this->add_responsive_control(
			'primekit_elementor_gallery_popup_close_button_size',
			[
				'label' => esc_html__('Close Icon Size', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'selectors' => [
					'.primekit-photos-gallery-popup button.mfp-close' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // end: Section


		//add style for navigation
		$this->start_controls_section(
			'primekit_elementor_gallery_popup_navigation_style',
			[
				'label' => esc_html__('Popup Navigation', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'primekit_elementor_gallery_popup_navigation_size',
			[
				'label' => esc_html__('Size', 'primekit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'selectors' => [
					'.primekit-photos-gallery-popup .mfp-arrow svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_gallery_popup_navigation_color',
			[
				'label' => esc_html__('Color', 'primekit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.primekit-photos-gallery-popup .mfp-arrow svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // end: Section
	}

	/**
	 * Render the widget output on the frontend.
	 */
	protected function render()
	{
		include 'renderview.php';
	}
}