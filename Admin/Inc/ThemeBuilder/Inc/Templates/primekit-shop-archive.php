<?php
/*
 * WooCommerce Shop Archive Template
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

\Elementor\Plugin::$instance->frontend->add_body_class( 'elementor-template-full-width' );

get_header();

/**
 * Before Elementor Header-Footer content.
 */
do_action( 'elementor/page_templates/header-footer/before_content' );

echo '<main class="primekit-shop-archive">';

if ( ! \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
    do_action( 'primekit_shop_archive_content' );
} else {
    echo '<div class="primekit-container">';
    woocommerce_content();
    echo '</div>';
}

echo '</main>';

/**
 * After Elementor Header-Footer content.
 */
do_action( 'elementor/page_templates/header-footer/after_content' );

get_footer();
