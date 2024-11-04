<?php
/**
 * Render View file for Dual Button widget
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();

$primekit_btn1_txt = $primekit_settings['primekit_elementor_dual_button_text_left'];
$primekit_btn1_is = $primekit_settings['primekit_elementor_dual_button_icon_left_switch'];
$primekit_mid_sw = $primekit_settings['primekit_elementor_dual_button_middle_text_switch'];
$primekit_left_icon_position = $primekit_settings['primekit_elementor_dual_button_left_icon_position'] ? $primekit_settings['primekit_elementor_dual_button_left_icon_position'] : 'right';
$primekit_right_icon_position = $primekit_settings['primekit_elementor_dual_button_right_icon_position'] ? $primekit_settings['primekit_elementor_dual_button_right_icon_position'] : 'right';
$primekit_mid_txt = $primekit_settings['primekit_elementor_dual_button_text_middle'] ? $primekit_settings['primekit_elementor_dual_button_text_middle'] : 'OR';
$primekit_btn2_txt = $primekit_settings['primekit_elementor_dual_button_text_right'];
$primekit_btn2_is = $primekit_settings['primekit_elementor_dual_button_icon_right_switch'];


if ( ! empty( $primekit_settings['primekit_elementor_dual_button_url_left']['url'] ) ) {
    $this->add_link_attributes( 'primekit_elementor_dual_button_url_left', $primekit_settings['primekit_elementor_dual_button_url_left'] );
}

if ( ! empty( $primekit_settings['primekit_elementor_dual_button_url_right']['url'] ) ) {
    $this->add_link_attributes( 'primekit_elementor_dual_button_url_right', $primekit_settings['primekit_elementor_dual_button_url_right'] );
}
?>

<!-- Dual Button Area -->
<div class="primekit-dual-button-area">

    <!--Single Button-->
    <div class="primekit-dual-button primekit-dual-button-one">
        <a <?php echo $this->get_render_attribute_string('primekit_elementor_dual_button_url_left'); ?>>
        
            <?php 
                if('right' == $primekit_left_icon_position) {
                    echo esc_html($primekit_btn1_txt);  
                }    
            
                if('yes' == $primekit_btn1_is) {
                \Elementor\Icons_Manager::render_icon( $primekit_settings['primekit_elementor_dual_button_icon_left'], [ 'aria-hidden' => 'true' ] );  
                
                }

                if('left' == $primekit_left_icon_position) {
                    echo esc_html($primekit_btn1_txt);  
                }        
            ?> 
        </a>
        <?php if('yes' == $primekit_mid_sw) : ?>
            <span class="primekit-dual-button-middle-text"><?php echo esc_html($primekit_mid_txt); ?></span>
        <?php endif; ?>
    </div><!--/ Single Button-->

    <!--Single Button-->
    <div class="primekit-dual-button primekit-dual-button-two">
        <a <?php echo $this->get_render_attribute_string('primekit_elementor_dual_button_url_right'); ?>>
            
        <?php
            if('right' == $primekit_right_icon_position) {
                echo esc_html($primekit_btn2_txt);  
            }           

            if('yes' == $primekit_btn2_is) {
                 \Elementor\Icons_Manager::render_icon( $primekit_settings['primekit_elementor_dual_button_icon_right'], [ 'aria-hidden' => 'true' ] ); 
            }

            if('left' == $primekit_right_icon_position) {
                echo esc_html($primekit_btn2_txt);
            }
                 
        ?>
        </a>
    </div><!--/ Single Button-->

 
</div><!-- Dual Button Area -->