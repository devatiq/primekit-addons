<?php
/**
 * Render View for Flip Box Widget
 */

 if (!defined('ABSPATH')) exit; // Exit if accessed directly

 $primekit_settings = $this->get_settings_for_display();
 
 $primekit_elementor_flip_box_type = $primekit_settings['primekit_elementor_flip_box_icon_img_selection'];
 $primekit_flip_front_icon = $primekit_settings['primekit_elementor_flip_box_front_icon'];
 $primekit_flip_front_image = $primekit_settings['primekit_elementor_flip_box_front_image'];
 $primekit_flip_front_title = $primekit_settings['primekit_elementor_flip_box_front_title'];
 $primekit_flip_front_desc = $primekit_settings['primekit_elementor_flip_box_front_desc'];
 $primekit_flip_back_title = $primekit_settings['primekit_elementor_flip_box_back_title'];
 $primekit_flip_back_desc = $primekit_settings['primekit_elementor_flip_box_back_desc'];
 $primekit_flip_back_btn_text = $primekit_settings['primekit_elementor_flip_box_back_btn'];
 $primekit_flip_back_btn_link = $primekit_settings['primekit_elementor_flip_box_back_btn_link'];
$primekit_flip_back_btn_link_url = $primekit_flip_back_btn_link['url'];
$primekit_flip_back_btn_link_is_external = $primekit_flip_back_btn_link['is_external'] ? ' target="_blank"' : '';
$primekit_flip_back_btn_link_nofollow = $primekit_flip_back_btn_link['nofollow'] ? ' rel="nofollow"' : '';
$primekit_flip_direction = $primekit_settings['primekit_elementor_page_title_align'];
$primekit_flip_direction_class = !empty($primekit_flip_direction) ? $primekit_flip_direction : 'primekit-right-flip';
 ?>
 
 <div class="primekit-elementor-flip-box-area <?php echo esc_attr($primekit_flip_direction_class); ?>">
	 <div class="primekit-flip-box">
	 <div class="primekit-flip-box-front">
    <?php 
    // Check the selection type
    if ($primekit_elementor_flip_box_type === 'icon' && !empty($primekit_flip_front_icon)) : ?>
        <div class="primekit-flip-box-icon">
            <?php \Elementor\Icons_Manager::render_icon($primekit_flip_front_icon, ['aria-hidden' => 'true']); ?>
        </div>
    <?php elseif ($primekit_elementor_flip_box_type === 'image' && !empty($primekit_flip_front_image)) : ?>
        <div class="primekit-flip-box-image">
            <img src="<?php echo esc_url($primekit_flip_front_image['url']); ?>" alt="<?php echo esc_html($primekit_flip_front_title); ?>">
        </div>
    <?php endif; ?>

    <?php if (!empty($primekit_flip_front_title)) : ?>
        <h2><?php echo esc_html($primekit_flip_front_title); ?></h2>
    <?php endif; ?>

    <?php if (!empty($primekit_flip_front_desc)) : ?>
        <p class="primekit-front-description"><?php echo esc_html($primekit_flip_front_desc); ?></p>
    <?php endif; ?>
</div><!-- end front -->

		 <div class="primekit-flip-box-back">
			 <?php if (!empty($primekit_flip_back_title)) : ?>
				 <h3><?php echo esc_html($primekit_flip_back_title); ?></h3>
			 <?php endif; ?>
 
			 <?php if (!empty($primekit_flip_back_desc)) : ?>
				 <p class="primekit-back-description"><?php echo esc_html($primekit_flip_back_desc); ?></p>
			 <?php endif; ?>
 
			 <?php if (!empty($primekit_flip_back_btn_text)) : ?>
				<div class="primekit-flip-back-btn">
                <a href="<?php echo esc_url($primekit_flip_back_btn_link_url); ?>" <?php echo esc_attr($primekit_flip_back_btn_link_is_external); ?> <?php echo esc_attr($primekit_flip_back_btn_link_nofollow); ?>>
               <?php echo esc_html($primekit_flip_back_btn_text); ?>
               </a></div>
            <?php endif; ?>
		 </div><!-- end back -->
	 </div>
 </div><!-- end flip box area --> 