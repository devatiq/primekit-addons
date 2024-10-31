<?php
namespace PrimeKit\Admin\Inc\Dashboard\AvailableWidgets;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use PrimeKit\Admin\Inc\Dashboard\AvailableWidgets\RegularTab;

class PrimeKitWidgets
{
    protected $regular_tab;
    public function __construct()
    {
        // Hook to add the submenu.
        add_action('admin_menu', [$this, 'add_widgets_submenu']);
        
        // Classes initialization.
        $this->classes_init();
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
    public function render_widgets_wrapper($title = 'Widgets List', $callback = null) {
        ?>
        <p><?php echo esc_html($title); ?></p>
    
        <!-- Available widgets area -->
        <div class="primekit-available-widgets-area">
            <!-- Widgets Wrapper -->
            <div class="primekit-available-widgets-wrapper">
                <?php
                // Check if the callback is provided and callable
                if (is_callable($callback)) {
                    call_user_func($callback);
                } else {
                    echo '<p>' . esc_html__('No widgets to display.', 'primekit-addons') . '</p>';
                }
                ?>
            </div><!--/ Widgets Wrapper -->
        </div><!--/ Available widgets area -->
        <?php
    }    
    
    public function render_regular_widgets_list() {
        $this->render_widgets_wrapper(
            esc_html__('List of regular widgets available in PrimeKit.', 'primekit-addons'),
            [RegularTab::class, 'regular_widgets_display']
        );
    }
    
    public static function primekit_available_widget($widget_name, $title, $icon_url, $is_free = true, $widget_url = '#') {
        $option = get_option($widget_name); 
    
        // Determine the availability text based on $is_free
        $availability_text = $is_free ? esc_html__('Free', 'primekit-addons') : esc_html__('Pro', 'primekit-addons');    
        ?>
        <div class="primekit-available-single-widget">
            <div class="primekit-available-single-widget-header">
                <div class="primekit-availability-text"><?php echo esc_html($availability_text); ?></div>
                <div class="primekit-available-single-switch">
                    <label class="primekit-switch">
                        <input type="checkbox" name="<?php echo esc_attr($widget_name); ?>" value="1" <?php checked(1, $option, true); ?>>
                        <span class="primekit-slider primekit-round"></span>
                        <span class="primekit-switch-label primekit-switch-off"><?php echo esc_html__('off', 'primekit-addons'); ?></span>
                        <span class="primekit-switch-label primekit-switch-on"><?php echo esc_html__('on', 'primekit-addons'); ?></span>
                    </label>
                </div>
            </div>
            <div class="primekit-widget-icon">
                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_html($title); ?>">
            </div>
            <div class="primekit-widget-title">
                <h3><a href="<?php echo esc_url($widget_url); ?>" target="_blank"><?php echo esc_html($title); ?></a></h3>
            </div>
        </div>
        <?php
    }

    public function classes_init()
    {
       $this->regular_tab = new RegularTab();
    }
    

}