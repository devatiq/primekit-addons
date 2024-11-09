<?php
/**
 * Render View for WooCommerce Account Page
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();

$primekit_wc_style = $primekit_settings['primekit_elementor_wc_account_style_orientation'] == 'vertical' ? ' primekit-ele-wc-my-account-vertical' : '';

?>

<div class="primekit-elementor-wc-account-page<?php echo esc_attr($primekit_wc_style); ?>">
    <?php echo do_shortcode( '[woocommerce_my_account]' ); ?>
</div><!-- /end primekit-elementor-wc-account-page -->