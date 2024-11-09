<?php
/**
 * Render View for WooCommerce Product Summary Area
 */

 if (!defined('ABSPATH')) exit; // Exit if accessed directly

 global $product;
 $product = wc_get_product(get_the_ID());

 if (!$product) {
    echo esc_html__('This product does not exist', 'primekit-addons');
    return;
} ?>

<div class="primekit-elementor-wc-product-short-desc">
<?php wc_get_template('single-product/short-description.php'); ?>
</div><!-- /end short description -->