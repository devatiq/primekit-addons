<?php 
namespace PrimeKit\Public\Elementor\Inc;

/**
 * don't call the file directly.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Functions {
    
    /**
     * Constructor.
     */
    public function __construct() {


        add_action('elementor/elements/categories_registered', [$this, 'primekit_addons_widget_categories']);
    }

    //add PrimeKit Elementor Category

    function primekit_addons_widget_categories($elements_manager)
    {
        $elements_manager->add_category(
            'primekit-category',
            [
                'title' => esc_html__('PrimeKit Elements', 'primekit-addons'),
                'icon' => 'eicon-kit-plugins',
            ]
        );
    }



}