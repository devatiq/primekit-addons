<?php
/**
 * Render View for PrimeKit WordPress Menu
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

use PrimeKit\Frontend\Elementor\Inc\WalkerMenu;

$primekit_settings = $this->get_settings_for_display();

// Extract the selected menu slug
$primekit_selected_menu_slug = !empty($primekit_settings['primekit_elementor_wp_menu_selection']) ? $primekit_settings['primekit_elementor_wp_menu_selection'] : '';

?>

<div class="primekit-elementor-wp-menu-area">
    <?php
    if (!empty($primekit_selected_menu_slug)) {
        wp_nav_menu(array(
            'menu' => $primekit_selected_menu_slug,
            'container' => 'nav',
            'container_class' => 'primekit-wp-menu-container',
            'walker' => new WalkerMenu(),
        ));
    } else {
        echo '<p>' . esc_html__('Menu not selected or found.', 'primekit-addons') . '</p>';
    }
    ?>
</div><!-- /end PrimeKit wp menu area -->

<div class="primekit-mob-menu-icon-wrap">
 <div class="primekit-responsive-menu"><svg ViewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" id="fi_4543046"><g id="Layer_13" data-name="Layer 13"><path d="m30 7a1 1 0 0 1 -1 1h-26a1 1 0 0 1 0-2h26a1 1 0 0 1 1 1zm-5 8h-22a1 1 0 0 0 0 2h22a1 1 0 0 0 0-2zm-9 9h-13a1 1 0 0 0 0 2h13a1 1 0 0 0 0-2z"></path></g></svg></div>
   <div class="primekit-mobilemenu">
    <?php
    if (!empty($primekit_selected_menu_slug)) {
        wp_nav_menu(array(
            'menu' => $primekit_selected_menu_slug,
            'container' => 'nav',
            'container_class' => 'primekit-wp-menu-mobile-container',
        ));
    } else {
        echo '<p>' . esc_html__('Menu not selected or found.', 'primekit-addons') . '</p>';
    }
    ?>
    </div><!-- /end mobile menu -->
</div><!-- /end menu icon wrap -->
