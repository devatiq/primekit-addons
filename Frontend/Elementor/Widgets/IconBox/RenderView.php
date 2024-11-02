<?php
/**
 * Render View file for PrimeKit Iconbox one.
 */
 if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Icons_Manager;
$primekit_settings = $this->get_settings_for_display();
$primekit_button_link = $primekit_settings['primekit_elementor_icon_box_button_link'];
$primekit_url = isset($primekit_button_link['url']) ? esc_url($primekit_button_link['url']) : '#';
$primekit_is_external = !empty($primekit_button_link['is_external']) ? ' target="_blank"' : '';
$primekit_nofollow = !empty($primekit_button_link['nofollow']) ? ' rel="nofollow"' : '';
?>

<!--Single Icon Box-->
<div class="primekit-elementor-icon-box-area">
    <div class="primekit-elementor-icon-box">
        <div class="primekit-elementor-icon-box-icon">
            <!--Icon BG shape-->
            <div class="primekit-ele-icon-box-normal">
                <?php Icons_Manager::render_icon( $primekit_settings['primekit_elementor_icon_box_icon_shape'], [ 'aria-hidden' => 'true' ] ); ?>
            </div><!--/ Icon BG shape-->  

            <!--Icon-->
            <div class="primekit-ele-icon-box-hover">
            <?php
                if (!empty($primekit_settings['primekit_elementor_icon_box_icon']['value'])) {
                    Icons_Manager::render_icon($primekit_settings['primekit_elementor_icon_box_icon'], ['aria-hidden' => 'true']);
                } else {
                    echo '<i class="eicon-device-responsive"></i>';
                }
                ?>
            </div>  <!--Icon-->       
        </div>
        <?php if(!empty($primekit_settings['primekit_elementor_icon_box_title']) || !empty($primekit_settings['primekit_elementor_icon_box_desc'])) : ?>
            <div class="primekit-elementor-icon-box-content">
                <?php if(!empty($primekit_settings['primekit_elementor_icon_box_title'])) : ?>
                    <h4 class="primekit-elementor-icon-box-title"><?php echo esc_html($primekit_settings['primekit_elementor_icon_box_title']); ?></h4>
                <?php endif; ?>
                <?php if(!empty($primekit_settings['primekit_elementor_icon_box_desc'])) : ?>
                    <p class="primekit-elementor-icon-box-desc"><?php echo esc_html($primekit_settings['primekit_elementor_icon_box_desc']); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($primekit_settings['primekit_elementor_icon_box_button_text'])) : ?>
            <div class="primekit-elementor-icon-box-button">
            <a href="<?php echo esc_attr($primekit_url); ?>" class="primekit-elementor-button-link" <?php echo esc_attr($primekit_is_external . $primekit_nofollow); ?>>
    <?php echo esc_html($primekit_settings['primekit_elementor_icon_box_button_text']); ?> <i class="eicon-arrow-right"></i>
           </a>
            </div>
        <?php endif; ?>
    </div>
</div><!--/ Single Icon Box-->