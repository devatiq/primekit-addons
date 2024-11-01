<?php
/**
 * Render View file for PrimeKit Business Hours widget
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();

$primekit_title = $primekit_settings['primekit_elementor_business_hours_section_title'];
$primekit_repeater = $primekit_settings['primekit_elementor_business_hours_repeater'];

?>

<!--Business Hours Area-->
<div class="primekit-business-hours-area">
    <div class="primekit-business-hours">
        <ul>
            <?php if(!empty($primekit_title)) : ?>
                <!--Working Hour Title-->
                <li class="primekit-business-hour-title"><?php echo esc_html($primekit_title); ?></li><!--/ Working Hour Title-->
            <?php endif; ?>
            <?php if(!empty($primekit_repeater)) : foreach($primekit_repeater as $business_item) : ?>
                <!-- Working Hour Single Item -->
                <li class="primekit-business-hour-item elementor-repeater-item-<?php echo esc_attr( $business_item['_id'] ); ?>">
                    <span class="primekit-business-hour-day"><?php echo esc_html($business_item['primekit_elementor_business_hours_days']); ?></span>
                    <span class="primekit-business-hour-time"><?php echo esc_html($business_item['primekit_elementor_business_hours_time']); ?></span>
                </li><!--/ Working Hour Single Item -->
            <?php endforeach; endif; ?>
        </ul>
    </div>
</div>