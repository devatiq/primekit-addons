<?php
/**
 * Render View for Contact Info and Social Widget
 */
 if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div class="primekit-elementor-contact-social-info-area">

<?php if (isset($primekit_settings['primekit_elementor_contact_info_switch']) && $primekit_settings['primekit_elementor_contact_info_switch'] === 'yes') : ?>
    <div class="primekit-contact-info-area">
        <?php include 'contact-info.php'; ?>
    </div>
<?php endif;?>
    
    <?php if (isset($primekit_settings['primekit_elementor_contact_social_icon_switch']) && $primekit_settings['primekit_elementor_contact_social_icon_switch'] === 'yes') : ?>
    <div class="primekit-contact-info-social-icons">
        <?php include 'social-icons.php'; ?>
    </div>
<?php endif;?>

</div><!-- /end PrimeKit contact social area -->


	