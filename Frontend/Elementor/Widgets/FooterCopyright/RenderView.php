<?php
/**
 * Render View file for Footer Copyright
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$settings = $this->get_settings_for_display();


?>
<?php if(!empty($settings['heading_widget_title'])) : ?>
<h2 class="primekit-footer-copyright-title"><?php echo esc_html($settings['heading_widget_title']); ?></h2>
<?php endif; ?>


<?php echo wp_kses_post($settings['copyright_description']); ?>