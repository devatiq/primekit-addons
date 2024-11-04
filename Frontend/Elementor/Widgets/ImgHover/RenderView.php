<?php
/**
 * Render View file for Image Hover
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_imghover_image = $primekit_settings['primekit_elementor_imghover_image'];
$primekit_imghover_image_dimension = $primekit_settings['primekit_elementor_imghover_image_dimension'];
$primekit_imghover_title = $primekit_settings['primekit_elementor_imghover_title_text'];
$primekit_imghover_subtitle = $primekit_settings['primekit_elementor_imghover_sub_title_text'];
$primekit_imghover_link = $primekit_settings['primekit_elementor_imghover_link'];
?>

<!-- primekit Img Hover Area Start -->
<div class="primekit-elementor-img-hover-area">
    <div class="primekit-elementor-img-hover-wrap">
        <div class="primekit-elementor-img-hover-item">

             <?php
             if (!empty($primekit_imghover_image['id'])) {
             $primekit_image_id = $primekit_imghover_image['id'];
             $primekit_image_dimension = $primekit_imghover_image_dimension;

             $primekit_image_size = !empty($primekit_image_dimension) ? [$primekit_image_dimension['width'], $primekit_image_dimension['height']] : 'primekit_square_img';

             $primekit_image_array = wp_get_attachment_image_src($primekit_image_id, $primekit_image_size);
             $primekit_imghover_image_url = $primekit_image_array ? $primekit_image_array[0] : '';
           }

            if (empty($primekit_imghover_image_url)) {
            $primekit_imghover_image_url = plugins_url(trim(str_replace(WP_PLUGIN_DIR, '', PRIMEKIT_ELEMENTOR_PATH), '/') . '/assets/img/img-hover-placeholder.jpg');
           }
          ?>
           <img src="<?php echo esc_url($primekit_imghover_image_url); ?>" alt="<?php echo esc_html($primekit_imghover_title); ?>">

            <?php if (!empty($primekit_imghover_link['url'])) : ?>
              <a href="<?php echo esc_url($primekit_imghover_link['url']); ?>" <?php echo $primekit_imghover_link['is_external'] ? 'target="' . esc_attr('_blank') . '"' : ''; ?> <?php echo $primekit_imghover_link['nofollow'] ? 'rel="' . esc_attr('nofollow') . '"' : ''; ?>>

              <?php endif; ?>
                 <div class="primekit-img-hover-overlay"> 
                    <?php if (!empty($primekit_imghover_title)) : ?>
                        <h3 class="primekit-img-hover-title"><?php echo esc_html($primekit_imghover_title); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($primekit_imghover_subtitle)) : ?>
                        <p class="primekit-img-hover-subtitle"><?php echo esc_html($primekit_imghover_subtitle); ?></p>
                    <?php endif; ?>
                 </div>
            <?php if (!empty($primekit_imghover_link['url'])) : ?>
                </a>
            <?php endif; ?>
        </div><!-- /Img Hover item -->
    </div><!-- /Img Hover wrap -->
</div><!-- /Img Hover area -->
