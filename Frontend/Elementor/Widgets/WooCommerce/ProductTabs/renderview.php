<?php
/**
 * Render View for WooCommerce Product Data Tabs
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $product;
$product = wc_get_product(get_the_ID());

if (!$product) {
    echo esc_html__('This product does not exist', 'primekit-addons');
    return;
}

if ( $product ) {
    setup_postdata( $product->get_id() );
}

?>

<div class="primekit-elementor-wc-product-tabs">
    <?php 
    wc_get_template( 'single-product/tabs/tabs.php' ); 
    ?>
</div><!-- /end primekit product data tabs -->

<?php
wp_reset_postdata();
?>

