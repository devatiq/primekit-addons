<?php
/**
 * Section Title Widget Render View
 */
 if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_sec_divider_visible = $primekit_settings['primekit_elementor_sec_title_div'] === 'yes';
?>

<div class="primekit-elementor-title-align">

    <<?php echo esc_html($primekit_settings['primekit_elementor_sec_title_tag']); ?> class="primekit-elementor-sec-title">
        <span class="primekit-elementor-sec-title-one"><?php echo esc_html($primekit_settings['primekit_elementor_sec_title_one']); ?></span> <span class="primekit-elementor-sec-title-two"><?php echo esc_html($primekit_settings['primekit_elementor_sec_title_two']); ?></span>
    </<?php echo esc_html($primekit_settings['primekit_elementor_sec_title_tag']); ?>>

    <?php if ($primekit_sec_divider_visible) : ?>
        <div class="primekit-elementor-sec-title-divider"></div>
    <?php endif; ?>

</div><!-- section title area -->