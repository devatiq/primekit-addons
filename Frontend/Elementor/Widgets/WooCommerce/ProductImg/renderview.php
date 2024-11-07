<?php
/**
 * Render View for WooCommerce Product Image with Gallery, Zoom, and Sale Flash
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $product;
$product = wc_get_product(get_the_ID());
$primekit_settings = $this->get_settings_for_display();
$primekit_sales_flash = $primekit_settings['primekit_elementor_wc_product_sales_switch'];
$primekit_magnify_icon = $primekit_settings['primekit_elementor_wc_product_zoom_icon_switch'];

if (!$product) {
    echo esc_html__('This product does not exist', 'primekit-addons');
    return;
}
primekit_wc_load_assets_dependencies(); ?>

<div class="primekit-elementor-wc-product-img-area<?php if ('yes' !== $primekit_magnify_icon) { echo ' no-magnify-icon'; } ?>">
    <?php
if ('yes' === $primekit_sales_flash) {
    wc_get_template('loop/sale-flash.php');
} ?>


<?php wc_get_template('single-product/product-image.php'); ?>
</div><!-- /product image -->

<?php
if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
    ?>
    <script>
        jQuery('.woocommerce-product-gallery').each(function () {
            jQuery(this).wc_product_gallery();
        });
    </script>
    <?php
}

/**
 * Load necessary scripts and styles for WooCommerce product gallery
 */
function primekit_wc_load_assets_dependencies() {
    if (current_theme_supports('wc-product-gallery-zoom')) {
        wp_enqueue_script('zoom');
    }
    if (current_theme_supports('wc-product-gallery-slider')) {
        wp_enqueue_script('flexslider');
    }
    if (current_theme_supports('wc-product-gallery-lightbox')) {
        wp_enqueue_script('photoswipe-ui-default');
        wp_enqueue_style('photoswipe-default-skin');
        add_action('wp_footer', 'woocommerce_photoswipe');
    }
    wp_enqueue_script('wc-single-product');
    wp_enqueue_style('photoswipe');
    wp_enqueue_style('photoswipe-default-skin');
    wp_enqueue_style('woocommerce_prettyPhoto_css');
}
?>
