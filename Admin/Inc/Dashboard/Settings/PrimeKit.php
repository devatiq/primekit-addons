<?php 
namespace PrimeKit\Admin\Inc\Dashboard\Settings;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class PrimeKit {

    public function __construct() {
        // Hook for adding the settings page to the admin menu
        add_action('admin_menu', [$this, 'add_settings_page']);
        
    }

    public function add_settings_page() {
        add_menu_page(
            __('PrimeKit Settings', 'primekit-addons'),
            __('PrimeKit', 'primekit-addons'),
            'manage_options',
            'primekit_home',
            [$this, 'render_settings_page'],
            PRIMEKIT_ADMIN_ASSETS . '/img/primekit-icon.svg',   
            22       
        );
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
           
            <div id="primekit-custom-header" class="primekit-custom-header">
                <!-- Banner -->
                <div class="primekit-banner-area">
                    <h1><?php echo esc_html__("Welcome to", "primekit-addons"); ?> <?php echo esc_html(PRIMEKIT_NAME); ?></h1>  
                    <p class="primekit-banner-version"><?php echo esc_html__("Version: ", "primekit-addons"); ?> <?php echo esc_html(PRIMEKIT_VERSION); ?></p>              
                    <!-- Buttons -->
                    <div class="primekit-resource-buttons">                
                                            
                        <a href="https://demo.primekitaddons.com/addons-widgets/" target="_blank" class="button"><?php echo esc_html__("Demos", "primekit-addons"); ?></a>
                        
                        <a href="https://primekitaddons.com/documentation/" class="button" target="_blank"><?php echo esc_html__("Documentation", "primekit-addons"); ?></a>
                       
                        <a href="https://primekitaddons.com/contact-us/" target="_blank" class="button"><?php echo esc_html__("Support", "primekit-addons"); ?></a>     
                        
                        <a href="<?php echo esc_url(admin_url( 'admin.php?page=primekit_available_widgets' )); ?>" class="button"><?php echo esc_html__( 'Avilable Widgets', 'primekit-addons' ); ?><span class="dashicons dashicons-arrow-right-alt"></span></a>
                    </div>
                </div>         
            </div>
    
        </div>
        <?php
    }
}