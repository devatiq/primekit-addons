<?php
namespace PrimeKit\Admin\Inc\Dashboard\Settings;

class Settings {

    public function __construct() {
        add_action('admin_menu', [$this, 'register_submenu_page'], 99);
    }

    public function register_submenu_page() {
        add_submenu_page(
            'primekit_home',        // Parent slug
            'Settings',      // Page title
            'Settings',      // Menu title
            'manage_options',           // Capability required
            'primekit_settings', // Menu slug
            [$this, 'render_additional_settings_page'], // Callback function
            99                          // Position - ensures it's at the end
        );
    }

    public function render_additional_settings_page() {
        ?>
        <div class="wrap">
            <h1>Additional Settings</h1>
            <form method="post" action="options.php">
                <?php
                // Output settings fields and save options
                settings_fields('primekit_additional_settings_group');
                do_settings_sections('primekit_additional_settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
