<?php 
namespace PrimeKit\Admin\Inc\Dashboard\AvailableWidgets;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use PrimeKit\Admin\Inc\Dashboard\AvailableWidgets\PrimeKitWidgets;

class RegularTab {

    /**
     * Regular constructor.
     */
    public function __construct() {
        // Initialize the Regular class
    }

    /**
     * Display a list of available widgets by calling the render method.
     */
    public static function regular_widgets_display() {
        // Call the static method to render each widget
        PrimeKitWidgets::primekit_available_widget(
            'primekit_animated_text_field',               // Widget option name
            esc_html__('Advanced Animated Text', 'primekit-addons'), // Widget title
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/archive-title.svg', // Widget icon URL
            true,                                         // Is it free?
            'https://demo.primekitaddons.com/widgets/animated-text' // Widget URL
        );

        PrimeKitWidgets::primekit_available_widget(
            'primekit_pro_widget_field',
            esc_html__('Premium Animated Slider', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/archive-title.svg', // Widget icon URL
            false,
            'https://demo.primekitaddons.com/widgets/premium-slider'
        );
        
    }
}
