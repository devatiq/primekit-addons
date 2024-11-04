<?php
/**
 * Render View file for Portfolio
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_portfolio_image = $primekit_settings['primekit_elementor_portfolio_image'];
$primekit_portfolio_image_dimension = $primekit_settings['primekit_elementor_portfolio_image_dimension'];
$primekit_portfolio_title = $primekit_settings['primekit_elementor_portfolio_title_text'];
$primekit_portfolio_subtitle = $primekit_settings['primekit_elementor_portfolio_sub_title_text'];
$primekit_portfolio_link = $primekit_settings['primekit_elementor_portfolio_link'];
?>

<!-- primekit Portfolio Area Start -->
<div class="primekit-elementor-portfolio-area">
    <div class="primekit-elementor-portfolio-wrap">
        <div class="primekit-elementor-portfolio-item">

             <?php
             if (!empty($primekit_portfolio_image['id'])) {
             $primekit_image_id = $primekit_portfolio_image['id'];
             $primekit_image_dimension = $primekit_portfolio_image_dimension;

             $primekit_image_size = !empty($primekit_image_dimension) ? [$primekit_image_dimension['width'], $primekit_image_dimension['height']] : 'primekit_square_img';

             $primekit_image_array = wp_get_attachment_image_src($primekit_image_id, $primekit_image_size);
             $primekit_portfolio_image_url = $primekit_image_array ? $primekit_image_array[0] : '';
           }

            if (empty($primekit_portfolio_image_url)) {
                $primekit_portfolio_image_url = PRIMEKIT_ELEMENTOR_ASSETS . '/img/port-placeholder.jpg';
           }
          ?>
           <img src="<?php echo esc_url($primekit_portfolio_image_url); ?>" alt="<?php echo esc_html($primekit_portfolio_title); ?>">

            <?php if (!empty($primekit_portfolio_link['url'])) : ?>
                <a href="<?php echo esc_url($primekit_portfolio_link['url']); ?>" <?php echo $primekit_portfolio_link['is_external'] ? 'target="' . esc_attr('_blank') . '"' : ''; ?> <?php echo $primekit_portfolio_link['nofollow'] ? 'rel="' . esc_attr('nofollow') . '"' : ''; ?>>
              <?php endif; ?>
                 <div class="primekit-portfolio-overlay"> 
                    <?php if (!empty($primekit_portfolio_title)) : ?>
                        <h3 class="primekit-portfolio-title"><?php echo esc_html($primekit_portfolio_title); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($primekit_portfolio_subtitle)) : ?>
                        <p class="primekit-portfolio-subtitle"><?php echo esc_html($primekit_portfolio_subtitle); ?></p>
                    <?php endif; ?>
                 </div>
            <?php if (!empty($primekit_portfolio_link['url'])) : ?>
                </a>
            <?php endif; ?>
        </div><!-- /portfolio item -->
    </div><!-- /portfolio wrap -->
</div><!-- /portfolio area -->
