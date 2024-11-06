<?php
/**
 * Render View for Single Image Scroll
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();

$primekit_image = $primekit_settings['primekit_elementor_single_img_scroll_image'];
$primekit_image_alt = $primekit_settings['primekit_elementor_single_img_scroll_alt_text'];
$primekit_badge_text = $primekit_settings['primekit_elementor_single_img_scroll_badge_text'];
$primekit_show_badge = $primekit_settings['primekit_elementor_single_img_scroll_badge_switch'] === 'yes';

// Default image URL
$primekit_image_url = \Elementor\Utils::get_placeholder_image_src();

// Check if a custom image was chosen and retrieve the URL.
if (!empty($primekit_image['id'])) {
    // Get the image URL based on the selected size.
    $primekit_image_array = wp_get_attachment_image_src($primekit_image['id'], $primekit_settings['thumbnail_size']);
    if ($primekit_image_array) {
        $primekit_image_url = $primekit_image_array[0];
    }
} elseif (!empty($primekit_image['url'])) {
    // Use the custom URL if provided.
    $primekit_image_url = $primekit_image['url'];
}
?>

<div class="primekit-elementor-single-img-scroll-area">
    <div class="primekit-elementor-single-img-scroll-wrap">
        <figure class="primekit-img-scroller-container">
            <img src="<?php echo esc_url($primekit_image_url); ?>" alt="<?php echo esc_html($primekit_image_alt); ?>">
        </figure>
        <?php if ($primekit_show_badge): ?>
            <div class="primekit-img-scroller-badge">
                <?php echo esc_html($primekit_badge_text); ?>
            </div>
        <?php endif; ?>
    </div>
</div><!-- end single image scrolling area -->



<script>
    jQuery(document).ready(function ($) {
        var $imageContainer = $('.primekit-elementor-single-img-scroll-area');
        $imageContainer.hover(function () {
            var $this = $(this);
            var $imgContainer = $this.find('.primekit-img-scroller-container');
            var imgHeight = $imgContainer.find('img').height();
            var containerHeight = $this.height();
            var differenceHeight = imgHeight - containerHeight;

            $imgContainer.css('transform', 'translateY(-' + differenceHeight + 'px)');
        }, function () {
            $(this).find('.primekit-img-scroller-container').css('transform', 'translateY(0)');
        });
    });
</script>