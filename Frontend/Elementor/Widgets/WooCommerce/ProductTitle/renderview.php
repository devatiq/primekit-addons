<?php
/**
 * Render View for Product Ttitle Widget
 */
 if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_product_wc_title = get_the_title();

if ($primekit_product_wc_title) {
    $primekit_heading_tag = $this->get_settings('primekit_elementor_product_wc_title_tag');
    $primekit_alignment = $this->get_settings('primekit_elementor_product_wc_title_align');
    $primekit_text_color = $this->get_settings('primekit_elementor_product_wc_title_color');
    ?>

        <div class="primekit-elementor-product-wc-title-area">
            <<?php echo esc_html($primekit_heading_tag); ?> class="primekit-product-wc-title-tag"><?php echo esc_html($primekit_product_wc_title); ?></<?php echo esc_html($primekit_heading_tag); ?>>
        </div>
    <?php
}
?>
