<?php
/**
 * Render View file for Popup.
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
$settings = $this->get_settings_for_display();

$id = $this->get_id();

$text = $settings['primekit_elementor_popup_text'];
// content type
$primekit_popup_content_type = $settings['primekit_elementor_popup_content_type'];
$primekit_content_class = ' primekit-popup-content-' . $settings["primekit_elementor_popup_content_type"];
$primekit_popup_type_class = $primekit_content_class . ' primekit-popup-' . $settings["primekit_elementor_popup_type"];
$popup_img_alt_text = $settings['primekit_elementor_popup_img_alt_text'];

?>
<div class="primekit-popup-area">
    <?php if ('text' == $settings['primekit_elementor_popup_content_type'] && !empty($text)): ?>
        <div class="primekit-popup-trigger" data-popup-content="#primekit-popup-content-<?php echo esc_attr($id); ?>"><button class="primekit-popup-content-text">
                <?php echo esc_html($text); ?>
            </button></div>

    <?php elseif ('image' == $primekit_popup_content_type): ?>

        <div class="primekit-popup-trigger <?php echo esc_attr($primekit_popup_type_class); ?>"
            data-popup-content="#primekit-popup-content-<?php echo esc_attr($id); ?>">
            <img src="<?php echo esc_url($settings['primekit_elementor_popup_image']['url']); ?>"
                alt="<?php echo esc_attr($popup_img_alt_text); ?>">
        </div>

    <?php elseif ('icon' == $primekit_popup_content_type): ?>
        <?php if (!empty($settings['primekit_elementor_popup_icon']['library'])): ?>
            <div class="primekit-popup-trigger <?php echo esc_attr($primekit_popup_type_class); ?>"
                data-popup-content="#primekit-popup-content-<?php echo esc_attr($id); ?>">
                <?php \Elementor\Icons_Manager::render_icon($settings['primekit_elementor_popup_icon'], ['aria-hidden' => 'true']); ?>
            </div>
        <?php else: ?>

            <div class="primekit-popup-trigger <?php echo esc_attr($primekit_popup_type_class); ?>"
                data-popup-content="#primekit-popup-content-<?php echo esc_attr($id); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
                    <circle cx="50" cy="50" r="50" fill="#448E08" />
                    <path d="M65.0894 49.4997L41.9171 63.0569L41.7624 36.2106L65.0894 49.4997Z" fill="white" />
                </svg>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ('yt-video' == $settings['primekit_elementor_popup_type']): ?>

        <div id="primekit-popup-content-<?php echo esc_attr($id); ?>" class="primekit-popup-overlay">
            <div class="primekit-popup">
                <span class="primekit-popup-close"><i class="eicon-editor-close"></i></span>
                <?php if (!empty($settings['primekit_elementor_popup_video'])): ?>
                    <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($settings['primekit_elementor_popup_video']); ?>"></iframe>
                <?php else: ?>
                    <p>
                        <?php echo esc_html__('Not a valid video', 'primekit-addons'); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

    <?php elseif ('vm-video' == $settings['primekit_elementor_popup_type']): ?>
        <div id="primekit-popup-content-<?php echo esc_attr($id); ?>" class="primekit-popup-overlay">
            <div class="primekit-popup">
                <span class="primekit-popup-close"><i class="eicon-editor-close"></i></span>
                <?php if (!empty($settings['primekit_elementor_popup_vimeo_video'])): ?>
                    <iframe
                        src="https://player.vimeo.com/video/<?php echo esc_attr($settings['primekit_elementor_popup_vimeo_video']); ?>"
                        frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen></iframe>
                <?php else: ?>
                    <p>
                        <?php echo esc_html__('Not a valid video', 'primekit-addons'); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    <?php elseif ('gmap' == $settings['primekit_elementor_popup_type']): ?>
        <div id="primekit-popup-content-<?php echo esc_attr($id); ?>" class="primekit-popup-overlay">
            <div class="primekit-popup">
                <span class="primekit-popup-close"><i class="eicon-editor-close"></i></span>
                <?php if (!empty($settings['primekit_elementor_popup_gmap'])): ?>
                    <iframe src="<?php echo esc_attr($settings['primekit_elementor_popup_gmap']); ?>"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <?php else: ?>
                    <p>
                        <?php echo esc_html__('Not a valid google map', 'primekit-addons'); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

    <?php endif; ?>
</div>