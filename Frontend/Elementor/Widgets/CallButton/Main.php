<?php
namespace PrimeKit\Frontend\Elementor\Widgets\CallButton;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;

/**
 * Elementor List Widget.
 */
class Main extends Widget_Base
{

	public function get_name()
	{
		return 'primekit-call-button';
	}

	public function get_title()
	{
		return esc_html__('Sticky Call Button', 'primekit-addons');
	}

	public function get_icon()
	{
		return 'eicon-tel-field primekit-addons-icon';
	}

	public function get_categories()
	{
		return ['primekit-category'];
	}

	public function get_keywords()
	{
		return ['prime', 'call', 'button', 'mobile'];
	}

	public function get_style_depends()
    {
    return ['elementor-icons'];
    }


	protected function register_controls()
	{
		//Template
		$this->start_controls_section(
			'primekit_sticky_call_button_content',
			[
				'label' => esc_html__('Button Content', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//icon switch
		$this->add_control(
			'primekit_sticky_call_button_show_icon',
			[
				'label' => esc_html__( 'Show Icon', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'primekit-addons' ),
				'label_off' => esc_html__( 'Hide', 'primekit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

			//text switch
			$this->add_control(
				'primekit_sticky_call_button_show_text',
				[
					'label' => esc_html__( 'Show Text', 'primekit-addons' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'primekit-addons' ),
					'label_off' => esc_html__( 'Hide', 'primekit-addons' ),
					'return_value' => 'yes',
					'default' => 'label_off',
				]
			);

		//icon
		$this->add_control(
			'primekit_sticky_call_button_icon',
			[
				'label' => esc_html__( 'Icon', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-phone-alt',
					'library' => 'fa-solid',
				],
				'condition' =>[
					'primekit_sticky_call_button_show_icon' => 'yes',
				],
			]
		);

		//Text
		$this->add_control(
			'primekit_sticky_call_button_text',
			[
				'label' => esc_html__( 'Button Text', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Call Now', 'primekit-addons' ),
				'condition' =>[
					'primekit_sticky_call_button_show_text' => 'yes',
				],
			]
		);

		//Link

		$this->add_control(
			'primekit_sticky_call_button_link',
			[
				'label' => esc_html__( 'Button Link', 'primekit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		//button style
		$this->start_controls_section(
			'primekit_sticky_call_button_style',
			[
				'label' => esc_html__('Style', 'primekit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//end of sticky button style
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