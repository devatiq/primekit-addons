<?php
namespace PrimeKit\Admin\Inc\ThemeBuilder;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use PrimeKit\Admin\Inc\ThemeBuilder\Classes\PostTypes;
use PrimeKit\Admin\Inc\ThemeBuilder\Classes\MetaBox;
use PrimeKit\Admin\Inc\ThemeBuilder\Classes\ModalMarkup;
use PrimeKit\Admin\Inc\ThemeBuilder\Admin\ConditionManager;
use PrimeKit\Admin\Inc\ThemeBuilder\Inc\Hooks\TemplateContentHooks;
use PrimeKit\Admin\Inc\ThemeBuilder\Classes\TemplateOverride;
use PrimeKit\Admin\Inc\ThemeBuilder\Admin\Menus;
use PrimeKit\Admin\Inc\ThemeBuilder\Admin\Column;
class ThemeBuilder
{
    protected $post_types;

    protected $meta_box;

    protected $modal_markup;

    protected $condition_manager;

    protected $template_content_hooks;

    protected $template_override;

    protected $admin_menu;
    protected $column;
    /**
     * Theme Builder constructor.
     *
     * Initializes the class, registers the hooks.
     *
     * @since 1.0.0
     */
    public function __construct()    
    {
        
        $this->setConstants(); // Set the constants.

        $this->classes_initialize(); // Initialize the class.


        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));

        add_action('wp_ajax_primekit_library_new_post', array($this, 'handle_new_template_submission'));
        add_action('single_template', array($this, 'load_canvas_template'));

        add_action('get_header', array($this, 'primekit_override_header'));
        add_action('get_footer', [$this, 'primekit_override_footer']);
        add_action('primekit_footer', [$this, 'primekit_render_footer']);
        add_action('primekit_header', [$this, 'primekit_render_header']);
        add_action('wp_enqueue_scripts', array($this, 'enqueue_elementor_styles_scripts'));

    }

    public function setConstants() {
        define('PRIMEKIT_TB_PATH', plugin_dir_path(__FILE__));
        define('PRIMEKIT_TB_ASSETS', plugin_dir_url(__FILE__) . 'assets');
    }

    /**
     * Override the header template.
     *
     * If a header template is assigned in the theme builder, this function will
     * load that template instead of the default header.php.
     *
     * @since 1.0.0
     */
    public function primekit_override_header()
    {
        if (self::should_display_template('header')) {
            require_once PRIMEKIT_TB_PATH . '/inc/templates/primekit-header.php';
            $templates = [];
            $templates[] = 'header.php';
            remove_all_actions('wp_head');
            ob_start();
            locate_template($templates, true);
            ob_get_clean();
        }
    }


    /**
     * Render the header template.
     *
     * This method is responsible for rendering the header template which is set in the elementor page settings.
     * It is hooked in the `primekit_header` action.
     *
     * @since 1.0.0
     */
    public function primekit_render_header()
    {
        ?>
        <header class="primekit-custom-header dynamic-header">
            <div class="primekit-container">
                <?php echo self::get_header_content(); ?>
            </div>
        </header>
        <?php
    }

    /**
     * Retrieves the ID of the header template.
     *
     * @since 1.0.0
     * @return int|false The ID of the header template, or false if not found.
     */
    public static function primekit_get_header_id()
    {
        $header_id = self::get_template_id('header');

        if ('' === $header_id) {
            $header_id = false;
        }

        return apply_filters('primekit_get_header_id', $header_id);
    }


    /**
     * Gets the ID of a template by type.
     *
     * @param string $type The type of template to retrieve (e.g. 'header', 'footer', etc).
     *
     * @return int|string The ID of the template, or an empty string if no template is found.
     */
    public static function get_template_id($type)
    {

        $args = [
            'post_type' => 'primekit_library',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        ];
        $primekit_hf_templates = get_posts($args);

        foreach ($primekit_hf_templates as $template) {
            if (get_post_meta(absint($template->ID), 'primekit_themebuilder_select', true) === $type) {
                return $template->ID;
            }
        }

        return '';

    }
    /**
     * Retrieve the content of the header template.
     *
     * If a header template is assigned in the theme builder, this function will
     * load that template and echo its content.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function get_header_content()
    {
        $primekit_get_header_id = self::primekit_get_header_id();
        $frontend = new \Elementor\Frontend;
        echo $frontend->get_builder_content_for_display($primekit_get_header_id);
    }

    /**
     * Overrides the footer template for the current request.
     *
     * If a footer template is assigned in the theme builder, this function will
     * load that template instead of the default footer.php.
     *
     * @since 1.0.0
     */
    public function primekit_override_footer()
    {
        if (self::should_display_template('footer')) {
            require_once PRIMEKIT_TB_PATH . '/inc/templates/primekit-footer.php';
            $templates = [];
            $templates[] = 'footer.php';
            remove_all_actions('wp_footer');
            ob_start();
            locate_template($templates, true);
            ob_get_clean();
        }
    }

    /**
     * Renders the footer template.
     *
     * This method is used to render the footer template, which is a custom
     * footer template that is used by the theme builder.
     *
     * @since 1.0.0
     */
    public function primekit_render_footer()
    {
        ?>
        <footer class="primekit-custom-footer">
            <div class="primekit-container">
                <?php echo self::get_footer_content(); ?>
            </div>
        </footer>
        <?php
    }

    /**
     * Retrieves the content of the footer template.
     *
     * If a footer template is assigned in the theme builder, this function will
     * load that template and echo its content.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function get_footer_content()
    {
        $primekit_get_footer_id = self::primekit_get_footer_id();
        $frontend = new \Elementor\Frontend;
        echo $frontend->get_builder_content_for_display($primekit_get_footer_id);
    }


    /**
     * Retrieve the ID of the footer template.
     *
     * @since 1.0.0
     * @return int|false The ID of the footer template, or false if not found.
     */
    public static function primekit_get_footer_id()
    {
        $footer_id = self::get_template_id('footer');

        if ('' === $footer_id) {
            $footer_id = false;
        }

        return apply_filters('primekit_get_footer_id', $footer_id);
    }


    /**
     * Enqueues Elementor styles and scripts on the frontend, and the custom styles for the theme builder.
     *
     * Checks if Elementor is loaded before enqueueing its styles and scripts. Then enqueues the custom styles for the theme builder.
     */
    public function enqueue_elementor_styles_scripts()
    {
        if (did_action('elementor/loaded')) {
            \Elementor\Plugin::instance()->frontend->enqueue_styles();
            \Elementor\Plugin::instance()->frontend->enqueue_scripts();
        }

        wp_enqueue_style('primekit-theme-builder-style', PRIMEKIT_TB_ASSETS . '/css/style.css');
    }

    public function classes_initialize()
    {
        $this->post_types = new PostTypes();
        $this->menus = new Menus();
        $this->column = new Column();
        $this->modal_markup = new ModalMarkup();
        $this->condition_manager = new ConditionManager();
        $this->template_content_hooks = new TemplateContentHooks();
        $this->template_override = new TemplateOverride();
        $this->meta_box = new MetaBox();       
    }

    /**
     * Enqueue admin scripts and styles.
     *
     * Enqueues the plugin's admin styles and scripts, including the modal CSS and
     * JavaScript, as well as the new template submission JavaScript.
     *
     * @since 1.0.0
     *
     * @param string $hook The current admin screen.
     */
    public function admin_scripts($hook)
    {

        if (in_array($hook, array('edit.php', 'post-new.php'))) {
            $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
            if ('primekit_library' === $post_type || ('post-new.php' === $hook && empty($post_type))) {

                wp_enqueue_style('primekit-theme-builder-modal', plugins_url('assets/css/modal.css', __FILE__), array(), '1.0.0', 'all');

                wp_enqueue_script('primekit-theme-builder-main', plugins_url('assets/js/admin.js', __FILE__), array('jquery'), '1.0.0', true);

                wp_enqueue_script('primekit-tb-modal-ajax', plugins_url('assets/js/new-template-ajax.js', __FILE__), array('jquery'), '1.0.0', true);

                wp_enqueue_script('micromodal-js', '//unpkg.com/micromodal@0.4.10/dist/micromodal.min.js', array('jquery'), '0.4.10', true);

                wp_localize_script('primekit-tb-modal-ajax', 'abcbizNewTemplateCreated', [
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('primekit_new_template_nonce'),
                ]);
            }
        }
    }

 
    /**
     * Handles the submission of the new template modal form.
     *
     * Expects the following $_POST variables:
     * - postTitle: The title of the new post.
     * - templateType: The type of template to create (e.g. 'header', 'footer', etc.).
     * - postType: The post type to create (defaults to 'primekit_library' if not provided).
     *
     * Creates a new post with the given title and type, and updates the custom field
     * with the template type. If Elementor is installed and active, sets the Elementor
     * page template to 'elementor_canvas' for Header and Footer types, or
     * 'elementor_header_footer' for other types.
     *
     * @since 1.0.0
     */
    public function handle_new_template_submission()
    {
        check_ajax_referer('primekit_new_template_nonce', 'security');

        $post_title = sanitize_text_field($_POST['postTitle']);
        $template_type = sanitize_text_field($_POST['templateType']);
        $post_type = isset($_POST['postType']) ? sanitize_text_field($_POST['postType']) : 'primekit_library';

        $post_id = wp_insert_post([
            'post_title' => $post_title,
            'post_status' => 'draft',
            'post_type' => $post_type,
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            // Update the custom field with the template type
            update_post_meta($post_id, 'primekit_themebuilder_select', $template_type);

            // Check if Elementor is installed and active
            if (did_action('elementor/loaded')) {
                // Only set Elementor Canvas template for Header and Footer types
                if (in_array($template_type, ['header', 'footer'])) {
                    update_post_meta($post_id, '_wp_page_template', 'elementor_canvas');
                } else {
                    update_post_meta($post_id, '_wp_page_template', 'elementor_header_footer');
                }

                $edit_with_elementor_url = admin_url("post.php?post={$post_id}&action=elementor");
                wp_send_json_success(['redirect_url' => $edit_with_elementor_url]);
            } else {
                wp_send_json_success(['redirect_url' => get_edit_post_link($post_id, '')]);
            }
        } else {
            wp_send_json_error(['message' => 'Failed to create post.']);
        }

        exit;
    }

    /**
     * Override the page template for the primekit_library post type.
     *
     * We want to use Elementor's canvas template for the Theme Builder templates.
     *
     * @param string $single_template The path to the template.
     * @return string The path to the template.
     */
    public function load_canvas_template($single_template)
    {
        global $post;

        if ('primekit_library' == $post->post_type) {
            $elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

            if (file_exists($elementor_2_0_canvas)) {
                return $elementor_2_0_canvas;
            } else {
                return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
            }
        }

        return $single_template;
    }

    /**
     * Determines whether the given template type should be displayed or not.
     *
     * @since 1.0.0
     *
     * @param string $template_type The type of template to check. Can be one of:
     *     single_post, single_page, archive, 404, search, etc.
     *
     * @return bool True if the template should be displayed, false otherwise.
     */
    public static function should_display_template($template_type)
    {
        // Get the template ID based on the type (single_post, single_page, etc.)
        $template_id = self::get_template_id($template_type);


        if (!$template_id) {
            return false;
        }

        // Get the template type selected in `primekit_library`
        $selected_template = get_post_meta($template_id, 'primekit_themebuilder_select', true);

        if ($selected_template === $template_type) {
            return true;
        }

        return false;
    }

}


