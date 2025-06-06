
<?php
/**
 * Single Blog Full Width
 *
 * This template is used to display single blog posts.
 *
 * @package PrimeKit\Admin\Inc\ThemeBuilder\Inc\Templates
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

\Elementor\Plugin::$instance->frontend->add_body_class( 'elementor-template-full-width' );

get_header();
/**
 * Before Header-Footer page template content.
 *
 * Fires before the content of Elementor Header-Footer page template.
 *
 * @since 2.0.0
 */
do_action( 'elementor/page_templates/header-footer/before_content' );

    echo '<main class="primekit-single-post">';
    while ( have_posts() ) :
        the_post();
        if( !\Elementor\Plugin::$instance->preview->is_preview_mode() ){
            do_action( 'primekit_single_post_content' );
        }else{            
            the_content();
        }
    endwhile; // end of the loop. 

    echo '</main>';
/**
 * After Header-Footer page template content.
 *
 * Fires after the content of Elementor Header-Footer page template.
 *
 * @since 2.0.0
 */
do_action( 'elementor/page_templates/header-footer/after_content' );

get_footer();