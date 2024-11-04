<?php 
namespace PrimeKit\Frontend\Elementor\Widgets\ImgScroll;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base {

	public function get_name()
	{
		return 'primekit-image-scroll';
	}
	
	public function get_title()
	{
		return esc_html__('Image & Text Scroll', 'primekit-addons');
	}
	
	public function get_icon()
	{
		return 'eicon-slider-album primekit-addons-icon';
	}
	
	public function get_categories()
	{
		return ['primekit-category'];
	}
	
	public function get_keywords()
	{
		return ['prime', 'image', 'scroll', 'text'];
	}
	

	/**
	 * Register list widget controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'primekit_elementor_img_text_scroll_settings',
			[
				'label' => esc_html__( 'Settings', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Animation Duration
		$this->add_control(
			'primekit_elementor_img_text_scroll_duration',
			[
				'label' => esc_html__( 'Animation Duration (seconds)', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 20,
			]
		);

		//Animation direction
		$this->add_responsive_control(
            'primekit_elementor_img_text_scroll_direction',
            [
                'label' => esc_html__( 'Direction', 'primekit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'primekitrtlscroll',
                'options' => [
                    'primekitltrscroll'    => [
                        'title' => esc_html__( 'Left to Right', 'primekit-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'primekitrtlscroll' => [
                        'title' => esc_html__( 'Right to Left', 'primekit-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .primekit-archive-title-tag' => 'text-align: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_section();//end settings

		//Contents
		$this->start_controls_section(
			'primekit_elementor_img_text_scroll_contents',
			[
				'label' => esc_html__( 'Contents', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Scroll item
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'primekit_elementor_img_text_scroll_title',
			[
				'label' => esc_html__( 'Title', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Scroll Title' , 'primekit-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'primekit_elementor_img_text_scroll_image',
			[
				'label' => esc_html__( 'Choose Image', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'primekit_elementor_img_text_scroll_list',
			[
				'label' => esc_html__( 'Scroll Items', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'primekit_elementor_img_text_scroll_title' => esc_html__( 'Title 1', 'primekit-addons' ),
					],
					[
						'primekit_elementor_img_text_scroll_title' => esc_html__( 'Title 2', 'primekit-addons' ),
					],
					[
						'primekit_elementor_img_text_scroll_title' => esc_html__( 'Title 3', 'primekit-addons' ),
					],
					[
						'primekit_elementor_img_text_scroll_title' => esc_html__( 'Title 4', 'primekit-addons' ),
					],
					[
						'primekit_elementor_img_text_scroll_title' => esc_html__( 'Title 5', 'primekit-addons' ),
					],
					[
						'primekit_elementor_img_text_scroll_title' => esc_html__( 'Title 6', 'primekit-addons' ),
					],
					[
						'primekit_elementor_img_text_scroll_title' => esc_html__( 'Title 7', 'primekit-addons' ),
					],
					[
						'primekit_elementor_img_text_scroll_title' => esc_html__( 'Title 8', 'primekit-addons' ),
					],
					[
						'primekit_elementor_img_text_scroll_title' => esc_html__( 'Title 9', 'primekit-addons' ),
					],
				],
				'title_field' => '{{{ primekit_elementor_img_text_scroll_title }}}',
			]
		);

	   $this->end_controls_section(); //end contents

	   //Box Style
		$this->start_controls_section(
			'primekit_elementor_img_text_scroll_box_style',
			[
				'label' => esc_html__( 'Box Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Box Padding
		$this->add_control(
			'primekit_elementor_img_text_scroll_box_space',
			[
				'label' => esc_html__( 'Box Space', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
					'top' => 20,
					'right' => 20,
					'bottom' => 20,
					'left' => 20,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-img-scroll-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'primekit_elementor_img_text_scroll_box_border',
				'selector' => '{{WRAPPER}} .primekit-img-scroll-item',
			]
		);

		//Box Radius
		$this->add_control(
			'primekit_elementor_img_text_scroll_box_radius',
			[
				'label' => esc_html__( 'Border Radius', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
					'top' => 6,
					'right' => 6,
					'bottom' => 6,
					'left' => 6,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-img-scroll-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); //end box style

	   //Item Style
		$this->start_controls_section(
			'primekit_elementor_img_text_scroll_style',
			[
				'label' => esc_html__( 'Item Style', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Item Width
		$this->add_responsive_control(
			'primekit_elementor_img_text_scroll_width',
			[
				'label' => esc_html__( 'Item Width', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 600,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 200,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-img-scroll-item' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}; flex-basis: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Item height
		$this->add_responsive_control(
			'primekit_elementor_img_text_scroll_height',
			[
				'label' => esc_html__( 'Item Height', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 600,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 200,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-img-scroll-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Item gap
		$this->add_responsive_control(
			'primekit_elementor_img_text_scroll_gap',
			[
				'label' => esc_html__( 'Item Gap', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .primekit-scroll-contents' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Background Color
		$this->add_control(
			'primekit_elementor_img_text_scroll_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f1f1f1',
				'selectors' => [
					'{{WRAPPER}} .primekit-img-scroll-item' => 'background-color: {{VALUE}}',
				],
			]
		);

		//Text Color
		$this->add_control(
			'primekit_elementor_img_text_scroll_text_color',
			[
				'label' => esc_html__( 'Title Color', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .primekit-img-scroll-title' => 'color: {{VALUE}}',
				],
			]
		);

		//Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_img_text_scroll_text_typography',
				'label' => esc_html__( 'Title Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-img-scroll-title',
			]
		);


		$this->end_controls_section(); //end item style

    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'renderview.php';
    }
}