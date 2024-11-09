<?php
/**
 * Render View for WooCommerce Product Meta
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $product;
$product = wc_get_product(get_the_ID());

if (!$product) {
    echo esc_html__('This product does not exist', 'primekit-addons');
    return;
}

$primekit_settings = $this->get_settings_for_display();
$primekit_show_sku = $primekit_settings['primekit_elementor_wc_product_meta_sku_switch'] === 'yes';
$primekit_show_category = $primekit_settings['primekit_elementor_wc_product_meta_category_switch'] === 'yes';
$primekit_show_tags = $primekit_settings['primekit_elementor_wc_product_meta_tags_switch'] === 'yes';
$primekit_show_divider = $primekit_settings['primekit_elementor_wc_product_meta_div_switch'] === 'yes';
?>

<div class="primekit-elementor-wc-product-meta">

    <?php do_action('woocommerce_product_meta_start'); ?>

    <!-- Display SKU if enabled and available -->
    <?php if ($primekit_show_sku && $product->get_sku()): ?>
        <div class="primekit-product-sku">
            <span class="label"><?php esc_html_e('SKU', 'primekit-addons'); ?></span>
            <span class="value">: <?php echo esc_html($product->get_sku()); ?></span>
        </div>
    <?php endif; ?>

    <?php if ($primekit_show_divider && $primekit_show_category && $primekit_show_sku): ?>
        <div class="primekit-meta-divider"></div>
    <?php endif; ?>

    <!-- Display Categories if enabled and available -->
    <?php if ($primekit_show_category && wc_get_product_category_list($product->get_id())): ?>
        <div class="primekit-product-categories">
            <span class="label"><?php esc_html_e('Categories', 'primekit-addons'); ?></span>
            <span class="value">: <?php echo wp_kses_post(wc_get_product_category_list($product->get_id())); ?></span>
        </div>
    <?php endif; ?>


    <?php if ($primekit_show_divider && $primekit_show_tags && wc_get_product_tag_list($product->get_id())): ?>
        <div class="primekit-meta-divider"></div>
    <?php endif; ?>

    <!-- Display Tags if enabled and available -->
    <?php if ($primekit_show_tags && wc_get_product_tag_list($product->get_id())): ?>
        <div class="primekit-product-tags">
            <span class="label"><?php esc_html_e('Tags', 'primekit-addons'); ?></span>
            <span class="value">: <?php echo wp_kses_post(wc_get_product_tag_list($product->get_id())); ?></span>
        </div>
    <?php endif; ?>


    <?php do_action('woocommerce_product_meta_end'); ?>

</div><!-- /end primekit product meta -->