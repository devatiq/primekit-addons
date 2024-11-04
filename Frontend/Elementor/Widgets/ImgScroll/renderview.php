<?php
/**
 * Render View for Scrolling Text/Image
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_animationDuration = $primekit_settings['primekit_elementor_img_text_scroll_duration'] . 's';
$primekit_animationDirection = $primekit_settings['primekit_elementor_img_text_scroll_direction'];
$primekit_animationName = ($primekit_animationDirection == 'primekitltrscroll') ? 'primekitltrscroll' : 'primekitrtlscroll';
?>

<?php
if ( ! empty( $primekit_settings['primekit_elementor_img_text_scroll_list'] ) ) : ?>
    <div class="primekit-elementor-img-scroll-area">
        <div class="primekit-elementor-img-scroll-container">
        <div class="primekit-scroll-contents" style="animation: <?php echo $primekit_animationName . ' ' . $primekit_animationDuration; ?> linear 0s infinite;">
                <?php foreach ( $primekit_settings['primekit_elementor_img_text_scroll_list'] as $item ) : ?>
                    <div class="primekit-img-scroll-item">
                        <?php if ( ! empty( $item['primekit_elementor_img_text_scroll_image']['url'] ) ) : ?><figure class="primekit-img-scroll-img">
                            <img src="<?php echo esc_url( $item['primekit_elementor_img_text_scroll_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['primekit_elementor_img_text_scroll_title'] ); ?>">
                        </figure>
                        <?php endif; ?>
                        <?php if ( ! empty( $item['primekit_elementor_img_text_scroll_title'] ) ) : ?>
                            <div class="primekit-img-scroll-title"><?php echo esc_html( $item['primekit_elementor_img_text_scroll_title'] ); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div><!-- scroll contents -->
        </div>
    </div><!-- end image scrolling area -->
<?php endif; ?>
