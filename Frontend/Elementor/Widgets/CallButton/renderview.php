<?php
/**
 * Render View for PrimeKit Call Button Widget
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Fetch widget settings
$primekit_settings = $this->get_settings_for_display();

$primekit_show_icon = $primekit_settings['primekit_sticky_call_button_show_icon'] === 'yes';
$primekit_show_text = $primekit_settings['primekit_sticky_call_button_show_text'] === 'yes';
$primekit_icon = !empty($primekit_settings['primekit_sticky_call_button_icon']) ? $primekit_settings['primekit_sticky_call_button_icon'] : '';
$primekit_text = !empty($primekit_settings['primekit_sticky_call_button_text']) ? $primekit_settings['primekit_sticky_call_button_text'] : '';
$primekit_link = !empty($primekit_settings['primekit_sticky_call_button_link']['url']) ? $primekit_settings['primekit_sticky_call_button_link']['url'] : '#';
$primekit_link_external = !empty($primekit_settings['primekit_sticky_call_button_link']['is_external']) ? 'target="_blank"' : '';
$primekit_link_nofollow = !empty($primekit_settings['primekit_sticky_call_button_link']['nofollow']) ? 'rel="nofollow"' : '';
?>

<div class="primekit-sticky-call-button-area">
    <a href="<?php echo esc_url($primekit_link); ?>" class="primekit-sticky-call-button" <?php echo $primekit_link_external; ?> <?php echo $primekit_link_nofollow; ?>>
        <?php if ($primekit_show_icon && !empty($primekit_icon['value'])): ?>
            <span class="primekit-call-button-icon">
                <?php \Elementor\Icons_Manager::render_icon($primekit_icon, ['aria-hidden' => 'true']); ?>
            </span>
        <?php endif; ?>

        <?php if ($primekit_show_text && $primekit_text): ?>
            <span class="primekit-call-button-text">
                <?php echo esc_html($primekit_text); ?>
            </span>
        <?php endif; ?>
    </a>
</div><!-- end primekit sticky call button -->
