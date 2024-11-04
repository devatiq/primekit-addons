<?php
/**
 * Render View for Count Down
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_count_down_expired_text = isset($primekit_settings['primekit_elementor_count_down_expired_text']) ? $primekit_settings['primekit_elementor_count_down_expired_text'] : 'Expired';
$primekit_count_down_exp_btn = isset($primekit_settings['primekit_elementor_count_down_exp_btn']) ? $primekit_settings['primekit_elementor_count_down_exp_btn'] : 'no';
$primekit_count_down_expired_btn_text = isset($primekit_settings['primekit_elementor_count_down_expired_btn_text']) ? $primekit_settings['primekit_elementor_count_down_expired_btn_text'] : 'View Now';
$primekit_count_down_expired_btn_link = isset($primekit_settings['primekit_elementor_count_down_expired_btn_link']['url']) ? $primekit_settings['primekit_elementor_count_down_expired_btn_link']['url'] : '#';
$primekit_count_down_expired_btn_link_is_external = isset($primekit_settings['primekit_elementor_count_down_expired_btn_link']['is_external']) && $primekit_settings['primekit_elementor_count_down_expired_btn_link']['is_external'] ? ' target="_blank"' : '';
$primekit_count_down_expired_btn_link_nofollow = isset($primekit_settings['primekit_elementor_count_down_expired_btn_link']['nofollow']) && $primekit_settings['primekit_elementor_count_down_expired_btn_link']['nofollow'] ? ' rel="nofollow"' : '';

?>

<div class="primekit-elementor-count-down-area" data-countdown="<?php echo esc_attr($primekit_settings['primekit_elementor_count_down_timer']); ?>">
  <div id="primekitcountdisplay">
    <div id="primekitcounttime">
    <?php if ( 'yes' === $primekit_settings['primekit_elementor_count_down_days_switch'] ) : ?>
      <div class='primekit-count-down-single primekit-count-days'><span class="primekit-count-num-days">00</span><span class="primekit-count-down-label primekit-count-days-label"><?php echo esc_html($primekit_settings['primekit_elementor_count_down_days_label'] ?? 'Days'); ?></span></div>
      <?php endif; ?>

      <?php if ( 'yes' === $primekit_settings['primekit_elementor_count_down_hours_switch'] ) : ?>
      <div class='primekit-count-down-single primekit-count-hours'><span class="primekit-count-num-hours">00</span><span class="primekit-count-down-label primekit-count-hours-label"><?php echo esc_html($primekit_settings['primekit_elementor_count_down_hours_label'] ?? 'Hours'); ?></span></div>
      <?php endif; ?>

      <?php if ( 'yes' === $primekit_settings['primekit_elementor_count_down_mins_switch'] ) : ?>
      <div class='primekit-count-down-single primekit-count-minutes'><span class="primekit-count-num-minutes">00</span><span class="primekit-count-down-label primekit-count-mins-label"><?php echo esc_html($primekit_settings['primekit_elementor_count_down_mins_label'] ?? 'Minutes'); ?></span></div>
      <?php endif; ?>

      <?php if ( 'yes' === $primekit_settings['primekit_elementor_count_down_secs_switch'] ) : ?>
      <div class='primekit-count-down-single primekit-count-seconds'><span class="primekit-count-num-seconds">00</span><span class="primekit-count-down-label primekit-count-secs-label"><?php echo esc_html($primekit_settings['primekit_elementor_count_down_secs_label'] ?? 'Seconds'); ?></span></div>
      <?php endif; ?>
    </div>
    <div id="primekitcountexpired">
      <?php echo esc_html($primekit_count_down_expired_text); ?>
      <?php if ('yes' === $primekit_count_down_exp_btn): ?>
        <div class="primekit-expired-btn">
        <a href="<?php echo esc_url($primekit_count_down_expired_btn_link); ?>"<?php echo esc_attr($primekit_count_down_expired_btn_link_is_external . $primekit_count_down_expired_btn_link_nofollow); ?> class=""><?php echo esc_html($primekit_count_down_expired_btn_text); ?></a>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div><!-- end count down area -->

