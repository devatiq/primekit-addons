<?php 
/**
 * Elementor functions
 *
 * @package PrimeKit
 * @subpackage Public/Elementor/Inc
 */
namespace PrimeKit\Frontend\Elementor\Inc;

/**
 * don't call the file directly.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This class is responsible for some helper functions and actions for the Elementor Addons.
 *
 * @package PrimeKit\Frontend\Elementor\Inc
 * @since 1.0.0
 */
class Functions {
    
    
    /**
     * Constructor for the Functions class.
     *
     * Initializes the PrimeKit Elementor category and hooks into the WordPress
     * 'after_setup_theme' action to register custom thumbnail sizes.
     *
     * @since 1.0.0
     */
    public function __construct() {
        //add PrimeKit Elementor Category
        add_action('elementor/elements/categories_registered', [$this, 'primekit_addons_widget_categories']);
        // Hook into WordPress after theme setup
		add_action('after_setup_theme', array($this, 'primekit_elementor_custom_thumbnail_size'));
    }

    
    /**
     * Registers PrimeKit Elementor category.
     *
     * @param \Elementor\Elements_Manager $elements_manager Elements manager instance.
     *
     * @since 1.0.0
     *
     * @return void
     */
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

    /**
     * Registers custom image sizes for use in Elementor widgets.
     *
     * This function defines several custom thumbnail sizes for displaying
     * images in Elementor widgets.
     *
     * @return void
     */
	function primekit_elementor_custom_thumbnail_size()
	{
		// Register a custom thumbnail size
		add_image_size('primekit-elementor-post', 635, 542, true);
		add_image_size('primekit_blog_list_thumb', 600, 450, true);
		add_image_size('primekit_blog_grid_thumb', 900, 600, true);
		add_image_size('primekit_square_img', 800, 800, true);
	}

}


