<?php
/**
 * Render View file for ABC Counter.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings   = $this->get_settings_for_display();
use Elementor\Icons_Manager;
?>

<div class="primekit-ele-countdown-area">
    <div class="primekit-ele-countdown-wrap">

       <div class="primekit-ele-countdown-icon">
         <!--icon-->
            <span class="primekit-counter-icon">
    <?php Icons_Manager::render_icon( $primekit_settings['primekit_elementor_counter_icon'], [ 'aria-hidden' => 'true' ] ); ?>
</span>
<!--/ icon-->
       </div>

     <div class="primekit-ele-counter">
    <span class="primekit-counter"><?php echo esc_html($primekit_settings['primekit_elementor_counter_number']); ?></span> <span class="primekit-ele-counter-suffix"><?php echo esc_html($primekit_settings['primekit_elementor_counter_suffix']); ?></span>
     </div>

     <div class="primekit-ele-count-title">
        <h3><?php echo esc_html($primekit_settings['primekit_elementor_counter_title']); ?></h3>
      </div>

    </div>
</div><!-- end counter area -->