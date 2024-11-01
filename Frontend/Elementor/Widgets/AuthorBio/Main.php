<?php
namespace PrimeKit\Frontend\Elementor\Widgets\AuthorBio;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

class Main extends Widget_Base
{

    public function get_name()
	{
		return 'primekit-blog-author';
	}

	public function get_title()
	{
		return esc_html__('Author Bio', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-user-circle-o primekit-addons-icon';
	}
	public function get_categories()
	{
		return ['primekit-category'];
	}
	public function get_keywords()
	{
		return ['prime', 'author', 'bio'];
	}


    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'primekit_elementor_author_bio_setting',
            [
                'label' => esc_html__('Setting', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        //Author bio text
        $this->add_control(
            'primekit_elementor_author_bio_text',
            [
                'label' => esc_html__('Author Bio Text', 'primekit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('About Author', 'primekit-addons'),
            ]
        );

         //Author bio link
         $this->add_control(
            'primekit_elementor_author_bio_link_switch',
            [
                'label' => esc_html__('View All Posts Link', 'primekit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'primekit-addons'),
                'label_off' => esc_html__('Hide', 'primekit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->end_controls_section();

        // blog info style section
        $this->start_controls_section(
            'primekit_elementor_author_bio_style_section',
            [
                'label' => esc_html__('Author Style', 'primekit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
            );


            // Background color
          $this->add_control(
            'primekit_elementor_author_bio_bg_color',
            [
                'label' => esc_html__('Background Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ececec',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-author-bio-area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Title color
        $this->add_control(
            'primekit_elementor_author_bio_title_color',
            [
                'label' => esc_html__('Title Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .abc-author-bio-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        //Author Title Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_author_bio_typography',
                'label' => esc_html__('Title Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .abc-author-bio-title',
            ]
        );

        // text color
                $this->add_control(
                    'primekit_elementor_author_bio_text_color',
                    [
                        'label' => esc_html__('Text Color', 'primekit-addons'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#444444',
                        'selectors' => [
                            '{{WRAPPER}} .primekit-ele-authorright' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                 //Author Text Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'primekit_elementor_author_bio_text_typography',
                'label' => esc_html__('Text Typography', 'primekit-addons'),
                'selector' => '{{WRAPPER}} .primekit-ele-authorright',
            ]
        );

        // link color
        $this->add_control(
            'primekit_elementor_author_bio_link_color',
            [
                'label' => esc_html__('Link Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#0dbad1',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-authorright a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // link hover color
        $this->add_control(
            'primekit_elementor_author_bio_link_hover_color',
            [
                'label' => esc_html__('Link Hover Color', 'primekit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#02363d',
                'selectors' => [
                    '{{WRAPPER}} .primekit-ele-authorright a:hover' => 'color: {{VALUE}};',
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