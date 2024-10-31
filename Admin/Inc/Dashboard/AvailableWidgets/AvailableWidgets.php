<?php
namespace PrimeKit\Admin\Inc\Dashboard\AvailableWidgets;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class AvailableWidgets
{
    public function __construct()
    {
        // Hook to add the submenu
        add_action('admin_menu', [$this, 'add_widgets_submenu']);
    }

    public function add_widgets_submenu()
    {
        add_submenu_page(
            'primekit_settings',             // Parent slug (the top-level menu slug)
            __('Available Widgets', 'primekit-addons'), // Page title
            __('Available Widgets', 'primekit-addons'), // Menu title
            'manage_options',                // Capability
            'primekit_available_widgets',    // Submenu slug
            [$this, 'render_available_widgets_page']    // Callback function
        );
    }

    public function render_available_widgets_page()
    {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html__('Available Widgets', 'primekit-addons'); ?></h1>

            <h2 class="nav-tab-wrapper">
                <a href="#regular" class="nav-tab nav-tab-active"><?php echo esc_html__('Regular', 'primekit-addons'); ?></a>
                <a href="#woocommerce" class="nav-tab"><?php echo esc_html__('WooCommerce', 'primekit-addons'); ?></a>
            </h2>

            <div id="regular" class="tab-content">
                <h3><?php echo esc_html__('Regular Widgets', 'primekit-addons'); ?></h3>
                <?php $this->render_regular_widgets_list(); ?>
            </div>

            <div id="woocommerce" class="tab-content" style="display: none;">
                <h3><?php echo esc_html__('WooCommerce Widgets', 'primekit-addons'); ?></h3>
                <p><?php echo esc_html__('List of WooCommerce widgets available in PrimeKit.', 'primekit-addons'); ?></p>
            </div>
        </div>
        <?php
    }

    public function render_regular_widgets_list()
    {
        ?>
        <p><?php echo esc_html__('List of regular widgets available in PrimeKit.', 'primekit-addons'); ?></p>

        <!-- Available widgets area -->
        <div class="primekit-available-widgets-area">
            <!-- Widgets Wrapper -->
            <div class="primekit-available-widgets-wrapper">

                <!-- Single Widget -->
                <div class="primekit-available-single-widget">
                    <div class="primekit-available-single-widget-header">
                        <div class="primekit-availability-text"><?php echo esc_html__('Free', 'primekit-addons'); ?></div>
                        <div class="primekit-available-single-switch">
                            <?php
                            $option = get_option('primekit_animated_text_field');
                            ?>
                            <label class="primekit-switch">
                                <input type="checkbox" name="primekit_animated_text_field" value="1" <?php checked(1, $option, true); ?>>
                                <span class="primekit-slider primekit-round"></span>
                                <span class="primekit-switch-label primekit-switch-on">on</span>
                                <span class="primekit-switch-label primekit-switch-off">off</span>
                            </label>
                        </div>
                    </div>
                    <div class="primekit-widget-icon">
                        <img src="<?php echo esc_url(PRIMEKIT_ADMIN_ASSETS . '/img/icons/archive-title.svg'); ?>" alt="">
                    </div>
                    <div class="primekit-widget-title">
                        <h3><a href=""
                                target="_blank"><?php echo esc_html__('Advanced Animated Text', 'primekit-addons'); ?></a></h3>
                    </div>
                </div>
                <!-- Single Widget -->





            </div><!--/ Widgets Wrapper -->
        </div><!--/ Available widgets area -->

        <?php
    }

}