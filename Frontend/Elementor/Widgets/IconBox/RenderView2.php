<?php
/**
 * Render View file for PrimeKit Iconbox 2.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Icons_Manager;
$primekit_settings = $this->get_settings_for_display();
?>

<!--Single Icon Box-->
<div class="primekit-single-icon-box-two-area">
    <div class="primekit-single-icon-box-two">
        <div class="primekit-single-icon-box-two-icon">
            <!--Icon-->
            <div class="primekit-ele-icon-box2-icon">
                <?php
                if (!empty($primekit_settings['primekit_elementor_icon_box_icon']['value'])) {
                    Icons_Manager::render_icon($primekit_settings['primekit_elementor_icon_box_icon'], ['aria-hidden' => 'true']);
                } else {
                    echo '<i class="eicon-device-responsive"></i>';
                }
                ?>
            </div><!--/ Icon-->
        </div>
        <div class="primekit-elementor-icon-box-content">
            <h4 class="primekit-elementor-icon-box-title">
                <?php echo esc_html($primekit_settings['primekit_elementor_icon_box_title']); ?>
            </h4>
            <p class="primekit-elementor-icon-box-desc">
                <?php echo esc_html($primekit_settings['primekit_elementor_icon_box_desc']); ?>
            </p>
        </div>
    </div>
</div><!--/ Single Icon Box-->