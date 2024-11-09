<?php
/**
 * Render View for PrimeKit Image Gallery Widget
 */
if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

$settings = $this->get_settings_for_display();
$id = $this->get_id();

?>
<div class="primekit-photos-gallery" id="primekit-photos-gallery-<?php echo esc_attr($id); ?>"
     data-primekit-config='<?php echo esc_html(wp_json_encode(array(
         'close_on_content_click' => $settings['primekit_elementor_gallery_close_button'] == 'true' ? true : false,
         'show_close_btn' => $settings['primekit_elementor_gallery_close_button'] == 'true' ? true : false,
         'gallery_enabled' => true,
         'preload' => [0, 1],
         'zoom_enabled' => true,
         'zoom_duration' => 300
     ))); ?>'>
	<?php if (!empty($settings['primekit_elementor_gallery'])) { ?>
		<?php foreach ($settings['primekit_elementor_gallery'] as $image) {

			// Get the caption based on the selected title option
			$caption = '';
			$caption_type = $settings['primekit_elementor_gallery_title'];
			if ($caption_type == 'caption' && !empty(wp_get_attachment_caption($image['id']))) {
				$caption = wp_get_attachment_caption($image['id']);
			} elseif ($caption_type == 'title' && !empty(get_post_field('post_title', $image['id']))) {
				$caption = get_post_field('post_title', $image['id']);
			} elseif ($caption_type == 'description' && !empty(get_post_field('post_content', $image['id']))) {
				$caption = get_post_field('post_content', $image['id']);
			} elseif ($caption_type == 'alt' && !empty(get_post_meta($image['id'], '_wp_attachment_image_alt', true))) {
				$caption = get_post_meta($image['id'], '_wp_attachment_image_alt', true);
			}

			// Get the full image URL for primekit-data-url
			$full_image_url = $image['url'];

			// Get cropped image dimensions using Elementor's Group_Control_Image_Size
			$cropped_image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($image['id'], 'primekit_elementor_gallery_dimensions', $settings);

			// If no cropped image is available, use the full image URL as a fallback
			$img_src = $cropped_image_url ? $cropped_image_url : $full_image_url;
			?>
			<span primekit-data-url="<?php echo esc_attr($image['url']); ?>" title="<?php echo esc_attr($caption); ?>"
				class="primekit-photos-gallery-item">
				<div class="primekit-image-gallery-container">
					<img src="<?php echo esc_attr($img_src); ?>" alt="<?php echo esc_attr($caption); ?>">
					<?php if (!empty($caption)) { ?>
						<span class="primekit-photos-gallery-caption"><?php echo esc_html($caption); ?></span>
					<?php } ?>
				</div>
			</span>

		<?php } ?>
	<?php } else { ?>
		<!-- Placeholder images if no gallery images are set -->
		<span primekit-data-url="<?php echo esc_url(PRIMEKIT_ELEMENTOR_ASSETS); ?>/img/member-placeholder.jpg">
			<img src="<?php echo esc_url(PRIMEKIT_ELEMENTOR_ASSETS); ?>/img/member-placeholder.jpg">
		</span>
		<span primekit-data-url="<?php echo esc_url(PRIMEKIT_ELEMENTOR_ASSETS); ?>/img/member-placeholder.jpg">
			<img src="<?php echo esc_url(PRIMEKIT_ELEMENTOR_ASSETS); ?>/img/member-placeholder.jpg">
		</span>
		<span primekit-data-url="<?php echo esc_url(PRIMEKIT_ELEMENTOR_ASSETS); ?>/img/member-placeholder.jpg">
			<img src="<?php echo esc_url(PRIMEKIT_ELEMENTOR_ASSETS); ?>/img/member-placeholder.jpg">
		</span>
	<?php } ?>
</div>