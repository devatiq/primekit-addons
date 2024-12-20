<?php
/**
 * Render View for WooCommerce Product Cart
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly
$primekit_settings =  $this->get_settings_for_display();
?>

<div class="primekit-elementor-wc-cart-icon">
    <?php if ( WC()->cart ) : ?>
        <?php $count = WC()->cart->get_cart_contents_count(); ?>
        <a class="primekit-cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e('View your shopping cart', 'primekit-addons'); ?>">
            <i class="eicon-cart-solid"></i>
            <?php if('yes' == $primekit_settings['primekit_elementor_wc_product_cart_count_switch']) : ?>
                <span class="primekit-cart-contents-count"><?php echo esc_html( $count ); ?></span>
            <?php endif; ?>
        </a>
    <?php endif; ?>
</div><!-- /end woocommerce cart -->


