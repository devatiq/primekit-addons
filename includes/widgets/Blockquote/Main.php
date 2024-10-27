<?php 
namespace PrimeKit\Includes\Widgets\Blockquote;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use PrimeKit\Includes\Widgets\BaseWidget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Elementor List Widget.
 */
class Main extends BaseWidget {

	    // define protected variables...
		protected $name = 'primekit-block-quote';
		protected $title = 'Blockquote';
		protected $icon = 'eicon-blockquote';
		protected $categories = [
			'primekit-category'
		];		
		protected $keywords = [
			'prime', 'quote', 'blockquote',
		];

	/**
	 * Register list widget controls.
	 */
	protected function register_controls() {
		//Template
		$this->start_controls_section(
			'primekit-elementor-block-quote',
			[
				'label' => esc_html__( 'Contents', 'primekit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Alignment
		$this->add_responsive_control(
			'primekit_elementor_block_quote_align',
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
					'{{WRAPPER}} .primekit-elementor-block-quote-area' => 'text-align: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'primekit_elementor_block_quote_text',
			[
				'label' => esc_html__( 'Quote Text', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Something is better than nothing!', 'primekit-addons' ),
				'placeholder' => esc_html__( 'Type blockquote text here', 'primekit-addons' ),
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

        //Blockquote style
		
        $this->start_controls_section(
            'primekit_elementor_block_quote_style',
            [
                'label' => esc_html__('Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'primekit_elementor_block_quote_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#cccccc',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-block-quote-area .primekit-quote-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_block_quote_color',
			[
				'label' => esc_html__( 'Text Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#053d58',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-block-quote-area blockquote' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'primekit_elementor_block_quote_border_color',
			[
				'label' => esc_html__( 'Border Color', 'primekit-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#59a818',
				'selectors' => [
					'{{WRAPPER}} .primekit-elementor-block-quote-area blockquote' => 'border-left-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'primekit_elementor_block_quote_typography',
				'label' => esc_html__( 'Typography', 'primekit-addons' ),
				'selector' => '{{WRAPPER}} .primekit-elementor-block-quote-area blockquote',
			]
		);

		//end of blockquote
        $this->end_controls_section();

    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'renderview.php';
    }
}