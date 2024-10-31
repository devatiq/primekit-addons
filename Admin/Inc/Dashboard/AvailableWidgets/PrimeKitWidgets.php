<?php
namespace PrimeKit\Admin\Inc\Dashboard\AvailableWidgets;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use PrimeKit\Admin\Inc\Dashboard\AvailableWidgets\RegularTab;

class PrimeKitWidgets
{
    // Variables.
    protected $regular_tab;
    /**
     * PrimeKitWidgets constructor.
     *
     * Initializes the PrimeKitWidgets by setting up the classes and hooking into the WordPress
     * 'admin_menu' action to add the "Available Widgets" submenu.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        // Hook to add the submenu.
        add_action('admin_menu', [$this, 'add_widgets_submenu']);
        
        // Classes initialization.
        $this->classes_init();
    }

    /**
     * Adds the "Available Widgets" submenu page to the PrimeKit settings menu.
     *
     * @since 1.0.0
     */
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

    /**
     * Renders the "Available Widgets" page in the PrimeKit admin dashboard.
     *
     * This function outputs the HTML for the "Available Widgets" page, which includes
     * tabbed navigation for "Regular" and "WooCommerce" widgets. The content for each
     * tab is dynamically displayed based on the selected tab. The "Regular" tab lists
     * the regular widgets available in PrimeKit, while the "WooCommerce" tab provides
     * a placeholder for WooCommerce widgets.
     *
     * @since 1.0.0
     */
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
    /**
     * Renders a wrapper for displaying a list of widgets.
     *
     * This function can be used to render a list of available widgets in the
     * PrimeKit admin dashboard. It renders a heading with the given title and
     * displays the available widgets within a wrapper element. The content of
     * the wrapper is rendered via a callback function, which should be provided
     * when calling this function.
     *
     * @param string $title Optional. The title to display above the list of
     *                      widgets. Defaults to 'Widgets List'.
     * @param callable $callback Optional. The callback function to use for
     *                           rendering the list of widgets. If not provided,
     *                           a default message is displayed.
     *
     * @since 1.0.0
     */
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
    
    /**
     * Renders a list of regular widgets.
     *
     * This function is a wrapper for {@see render_widgets_wrapper} that renders a
     * list of regular widgets. It displays a heading with the given title and
     * calls the `regular_widgets_display` method from the `RegularTab` class to
     * render the list of widgets.
     *
     * @since 1.0.0
     */
    public function render_regular_widgets_list() {
        $this->render_widgets_wrapper(
            esc_html__('List of regular widgets available in PrimeKit.', 'primekit-addons'),
            [RegularTab::class, 'regular_widgets_display']
        );
    }
    
    /**
     * Renders a single available widget.
     *
     * This function renders a single widget with an option to toggle it on or off.
     * It displays the widget title, icon, and a toggle switch. The toggle switch
     * is used to save the widget setting in the database.
     *
     * The function takes the following parameters:
     *  - $widget_name: The option name for the widget setting.
     *  - $title: The title of the widget.
     *  - $icon_url: The URL of the widget icon.
     *  - $is_free: Whether the widget is free or pro.
     *  - $widget_url: The URL of the widget.
     *
     * @param string $widget_name The option name for the widget setting.
     * @param string $title The title of the widget.
     * @param string $icon_url The URL of the widget icon.
     * @param bool   $is_free Whether the widget is free or pro.
     * @param string $widget_url The URL of the widget.
     *
     * @since 1.0.0
     */
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

    /**
     * Initializes the classes required for the Available Widgets page.
     *
     * Currently, this only initializes classes which is used
     * to display the list of available widgets.
     *
     * @since 1.0.0
     */
    public function classes_init()
    {
       $this->regular_tab = new RegularTab();
    }
    

}