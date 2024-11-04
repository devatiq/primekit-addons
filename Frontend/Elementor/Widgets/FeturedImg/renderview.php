<?php
/**
 * Render View for ABC Featured Image Widget
 */
 if (!defined('ABSPATH')) exit; // Exit if accessed directly
 ?>

<?php
$primekit_post_id = get_the_ID();
$primekit_image_url = get_the_post_thumbnail_url($primekit_post_id, 'full');

if ($primekit_image_url) {
    ?>
    <div class="primekit-elementor-feat-img-area">
        <img src="<?php echo esc_url($primekit_image_url); ?>" alt="<?php echo esc_attr(get_the_title($primekit_post_id)); ?>">
    </div>
    <?php
} else {
    echo esc_html__('No featured image found', 'primekit-addons');
}
?>


