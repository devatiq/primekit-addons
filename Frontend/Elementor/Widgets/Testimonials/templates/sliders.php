<?php
/**
 * Render View file for PrimeKit Testimonial Slider.
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_unique_id = $this->get_id();

// query testimonial from elementor settings
$primekit_repeater_testimonial = $primekit_settings['primekit_testimonial_repeater'];

// get all testimonial settings
$primekit_testimonial_column = $primekit_settings['primekit_ele_testimonial_column_desktop'] ? $primekit_settings['primekit_ele_testimonial_column_desktop'] : 3;
$primekit_testimonial_tab = $primekit_settings['primekit_ele_testimonial_column_tab'] ? $primekit_settings['primekit_ele_testimonial_column_tab'] : 1;
$primekit_testimonial_mobile = $primekit_settings['primekit_ele_testimonial_column_mobile'] ? $primekit_settings['primekit_ele_testimonial_column_mobile'] : 1;
$primekit_testimonial_autoplay = $primekit_settings['primekit_ele_testimonial_autoplay'] ? $primekit_settings['primekit_ele_testimonial_autoplay'] : 'false';
$primekit_testimonial_arrow = $primekit_settings['primekit_ele_testimonial_slider_arrow'] ? $primekit_settings['primekit_ele_testimonial_slider_arrow'] : 'false';
$primekit_autplay_delay = $primekit_settings['primekit_ele_testimonial_autoplay_delay'] ? $primekit_settings['primekit_ele_testimonial_autoplay_delay'] : 3000;

// Autoplay configuration
if ($primekit_testimonial_autoplay === 'true') {
    $autoplay_config = [
        'delay' => $primekit_autplay_delay,
        'disableOnInteraction' => false,
    ];
} else {
    $autoplay_config = false;
}

$breakpoints = wp_json_encode([
    '1000' => ['slidesPerView' => $primekit_testimonial_column, 'spaceBetween' => 30],
    '600' => ['slidesPerView' => $primekit_testimonial_tab, 'spaceBetween' => 30],
    '300' => ['slidesPerView' => $primekit_testimonial_mobile, 'spaceBetween' => 10],
]);
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        PrimeKitTestimonialSliderinitialize('<?php echo esc_js($primekit_unique_id); ?>');
    });
</script>


<!-- Start Testimonial Wrapper -->
<div class="primekit-testimonial-wrapper-area">
    <div class="primekit-testimonial-wrapper">

        <!-- Testimonial Slider -->
        <div class="primekit-testimonial-slider swiper swiper-container"
            id="primekit-testimonial-slider-<?php echo esc_attr($primekit_unique_id); ?>"
            data-breakpoints='<?php echo esc_attr($breakpoints); ?>'
            data-next-el="#primekit-testi-nav-right<?php echo esc_attr($primekit_unique_id); ?>"
            data-autoplay-config='<?php echo esc_attr(wp_json_encode($autoplay_config)); ?>'
            data-prev-el="#primekit-testi-nav-left<?php echo esc_attr($primekit_unique_id); ?>">
            <div class="swiper-wrapper">
                <?php
                if (!empty($primekit_repeater_testimonial)):
                    foreach ($primekit_repeater_testimonial as $primekit_testimonial):
                        $testimonial_name = $primekit_testimonial['testimonial_name'];
                        $testimonial_designation = $primekit_testimonial['testimonial_designation'];
                        $testimonial_feedback = $primekit_testimonial['testimonial_feedback'];
                        $testimonial_rating = $primekit_testimonial['testimonial_rating'];
                        $testimonial_img = $primekit_testimonial['testimonial_client_image'];

                        ?>
                        <!--Single Testimonial-->
                        <div class="primekit-testimonial-single-item swiper-slide">
                            <!--Header Part-->
                            <div class="primekit-testimonial-header">
                                <!--Client Image-->
                                <?php if ('yes' == $primekit_settings['primekit_ele_testimonial_client_image_switch']): ?>
                                    <div class="primekit-testimonial-client-img" id="primekit-testimonial-client-img">
                                        <?php if (!empty($testimonial_img['url'])): ?>
                                            <img src="<?php echo esc_url($testimonial_img['url']); ?>"
                                                alt="<?php echo esc_attr($testimonial_name); ?>">
                                        <?php else: ?>
                                            <img src="<?php echo esc_url(PRIMEKIT_ELEMENTOR_ASSETS . '/img/member-placeholder.jpg'); ?>"
                                                alt="<?php esc_attr_e('Client image placeholder', 'primekit-addons'); ?>">
                                        <?php endif; ?>

                                    </div>
                                <?php endif; ?><!--/ Client Image-->

                                <div class="primekit-testimonial-client-info">
                                    <?php if (!empty($testimonial_name)): ?>
                                        <h3><?php echo esc_html($testimonial_name); ?></h3>
                                    <?php endif; ?>

                                    <?php if (!empty($testimonial_designation)): ?>
                                        <p><?php echo esc_html($testimonial_designation); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div><!--/ Header Part-->

                            <!--Rating Part-->
                            <div class="primekit-testimonial-rating">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    $star_class = ($i <= $testimonial_rating) ? 'eicon-star' : ' ';
                                    echo '<i class="' . esc_attr($star_class) . '"></i>';
                                } ?>
                            </div><!--/ Rating Part-->

                            <?php if (!empty($testimonial_feedback)): ?>
                                <!--Content Part-->
                                <div class="primekit-testimonial-content">
                                    <p><?php echo esc_html($testimonial_feedback); ?></p>
                                </div><!--/ Content Part-->
                            <?php endif; ?>

                            <!--Quote Part-->
                            <div class="primekit-testimonial-quote">

                                <?php
                                if (!empty($primekit_settings['primekit_ele_testimonial_item_quote_icon']['library'])):
                                    \Elementor\Icons_Manager::render_icon($primekit_settings['primekit_ele_testimonial_item_quote_icon'], ['aria-hidden' => 'true']);
                                else:
                                    ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="68" height="50" viewBox="0 0 68 50" fill="none">
                                        <mask id="mask0_147_7210" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0"
                                            width="68" height="50">
                                            <path d="M68 0H0V49.8333H68V0Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_147_7210)">
                                            <path
                                                d="M18.4355 0.958008C27.4644 0.958008 33.9999 8.62457 33.9999 19.7796C33.9999 36.0712 21.8354 47.6097 4.41985 49.833C4.08581 49.8628 3.75216 49.773 3.47656 49.5792C3.20097 49.3853 3.00094 49.0996 2.91119 48.7717C2.82144 48.4439 2.84762 48.0944 2.9852 47.7841C3.12279 47.4738 3.36294 47.2224 3.66425 47.0731C10.3509 44.0831 13.751 40.2497 14.1666 36.4547C14.4006 35.2745 14.2186 34.0483 13.6524 32.9903C13.0862 31.9324 12.1718 31.1099 11.0688 30.6663C6.11989 29.478 2.83325 23.2297 2.83325 16.7897C2.83325 12.5909 4.47708 8.56403 7.40306 5.59502C10.329 2.62601 14.2975 0.958008 18.4355 0.958008Z"
                                                fill="white" />
                                            <path
                                                d="M52.4351 0.958008C61.464 0.958008 67.9995 8.62457 67.9995 19.7796C67.9995 36.0712 55.835 47.6097 38.4195 49.833C38.0854 49.8628 37.7518 49.773 37.4762 49.5792C37.2006 49.3853 37.0006 49.0996 36.9108 48.7717C36.8211 48.4439 36.8473 48.0944 36.9848 47.7841C37.1224 47.4738 37.3626 47.2224 37.6639 47.0731C44.3506 44.0831 47.7507 40.2497 48.1662 36.4547C48.4002 35.2745 48.2182 34.0483 47.652 32.9903C47.0858 31.9324 46.1714 31.1099 45.0684 30.6663C40.1195 29.478 36.8329 23.2297 36.8329 16.7897C36.8329 12.5909 38.4767 8.56403 41.4027 5.59502C44.3287 2.62601 48.2972 0.958008 52.4351 0.958008Z"
                                                fill="white" />
                                        </g>
                                    </svg>
                                <?php endif; ?>
                            </div><!--Quote Part-->
                        </div><!--/ Single Testimonial-->
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
            <!-- Add Pagination -->
            <?php if ('true' == $primekit_settings['primekit_ele_testimonial_slider_pagination']): ?>
                <div class="swiper-pagination primekit-testimonial-slider-pagination"></div>
            <?php endif; ?>
        </div><!--/ Testimonial Slider -->
        <?php
        if ('true' == $primekit_settings['primekit_ele_testimonial_slider_arrow']):
            ?>
            <div class="primekit-testimonial-slider-nav-bar primekit-test-nav-hide-in-mobile">
                <!-- Add Navigation -->
                <button type="button" class="primekit-testimonial-arrow primekit-testimonial-arrow-left"
                    id="primekit-testi-nav-left<?php echo esc_attr($primekit_unique_id); ?>"><svg id="fi_2985161"
                        enable-background="new 0 0 128 128" height="512" viewBox="0 0 128 128" width="512"
                        xmlns="http://www.w3.org/2000/svg">
                        <path id="Left_Arrow_4_"
                            d="m84 108c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656l40-40c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-37.172 37.172 37.172 37.172c1.563 1.563 1.563 4.094 0 5.656-.781.781-1.805 1.172-2.828 1.172z">
                        </path>
                    </svg></button>
                <button type="button" class="primekit-testimonial-arrow primekit-testimonial-arrow-right"
                    id="primekit-testi-nav-right<?php echo esc_attr($primekit_unique_id); ?>"><svg id="fi_2985162"
                        enable-background="new 0 0 128 128" height="512" viewBox="0 0 128 128" width="512"
                        xmlns="http://www.w3.org/2000/svg">
                        <path id="Left_Arrow_4_"
                            d="m84 108c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656l40-40c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-37.172 37.172 37.172 37.172c1.563 1.563 1.563 4.094 0 5.656-.781.781-1.805 1.172-2.828 1.172z">
                        </path>
                    </svg></button>
            </div>
        <?php endif; ?>
    </div>
</div><!--/ End Testimonial Wrapper -->