<?php
/**
 * Render View file for PrimeKit Contact form 7 Widget.
 */

 if (!defined('ABSPATH')) exit; // Exit if accessed directly

 $primekit_settings   = $this->get_settings_for_display();

 $this->add_render_attribute( 'primekit_ele_contact_form_attr', 'id', 'primekit-ele-contact-form-wrapper' );
 $this->add_render_attribute( 'shortcode', 'id', $primekit_settings['primekit_ele_contact_form_shortcode'] );
 $shortcode = sprintf( '[contact-form-7 %s]', $this->get_render_attribute_string( 'shortcode' ) );

?>

<div class="primekit-ele-contact-form-7-area">
     <div <?php echo esc_attr($this->get_render_attribute_string('primekit_ele_contact_form_attr')); ?>>
         <?php
             if( !empty( $primekit_settings['primekit_ele_contact_form_shortcode'] ) ){
                 echo do_shortcode( $shortcode ); 
             }else{
                 echo '<div class="form_no_select">' .esc_html__('Please Select contact form.', 'primekit-addons'). '</div>';
             }
         ?>
     </div>
</div><!-- end contact form 7 -->