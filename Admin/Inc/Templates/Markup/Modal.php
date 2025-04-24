<?php
/**
 * PrimeKit Admin Template Markup
 *
 * Markup for the modal that displays the template builder.
 *
 * @package PrimeKit_Addons
 * @subpackage Admin/Inc/Templates/Markup
 */
namespace PrimeKit\Admin\Inc\Templates\Markup;

/**
 * Class Modal
 *
 * This class is responsible for rendering the template modal markup to the page.
 */
class Modal
{
    public function __construct()
    {
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'enqueue_modal']);
        add_action('wp_ajax_primekit_get_template_categories', [$this, 'get_template_categories']);
      //  add_action('wp_ajax_nopriv_primekit_get_template_categories', [$this, 'get_template_categories']);

    }

    /**
     * Get unique categories from templates API
     */
    public function get_template_categories()
    {
        check_ajax_referer('primekit_template_nonce', 'nonce');

        $response = wp_remote_get('https://demo.primekitaddons.com/wp-json/primekit/v1/templates');


        if (is_wp_error($response)) {
            wp_send_json_error('Failed to fetch templates');
            return;
        }

        $body = wp_remote_retrieve_body($response);
        $templates = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            wp_send_json_error('Invalid JSON response');
            return;
        }

        if (!is_array($templates)) {
            wp_send_json_error('Invalid template data format');
            return;
        }

        $categories = ['All'];

        foreach ($templates as $template) {
            if (isset($template['categories']) && is_array($template['categories'])) {
                $categories = array_merge($categories, $template['categories']);
            }
        }

        $categories = array_unique($categories);
        $categories = array_values($categories);

        wp_send_json_success([
            'categories' => $categories,
            'templates' => $templates,
        ]);

    }


    public function enqueue_modal()
    {    

        // Enqueue Template Categories JS
        wp_enqueue_script(
            'primekit-template-categories',
            PRIMEKIT_TEMPLATE_ASSETS . '/js/TemplateCategories.js',
            ['jquery'],
            PRIMEKIT_VERSION,
            true
        );

        // Localize script for AJAX
        wp_localize_script('primekit-template-categories', 'primekitTemplates', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('primekit_template_nonce')
        ));

        add_action('wp_footer', [$this, 'render']);
    }
    public function render()
    {
        ?>
        <div id="primekit-template-modal" class="modal micromodal-slide primekit-templates-render-area" aria-hidden="true">
            <div class="modal__overlay" tabindex="-1" data-micromodal-close>
                <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="primekit-templates-modal-title">
                    <header class="modal__header primekit-modal-header">
                        <h2 id="primekit-templates-modal-title" class="primekit-modal-heading">
                            <img src="<?php echo PRIMEKIT_ADMIN_ASSETS . '/img/primekit-icon.svg'; ?>" alt="">
                            <?php esc_html_e('PrimeKit Templates', 'primekit-addons'); ?>
                        </h2>
                        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                    </header>
                    <main class="modal__content primekit-templates-contents-area">
                        <!--Template Popup-->
                        <div class="primekit-templates-popup-content-area">
                            <!--Template Popup Sidebar-->
                            <aside class="primekit-templates-sidebar">
                                <div class="primekit-template-filters">
                                    <h3><?php esc_html_e('Categories', 'primekit-addons'); ?></h3>
                                    <div class="primekit-filter-checkboxes">
                                        <!-- Categories will be loaded dynamically via JavaScript -->
                                        <div class="primekit-loading-categories">
                                            <?php esc_html_e('Loading categories...', 'primekit-addons'); ?>
                                        </div>
                                    </div>
                                </div>
                            </aside><!--/Template Popup Sidebar-->
                            <!--Template Popup Content-->
                            <div class="primekit-templates-popup-content">
                                <!--Template Popup Tabs-->
                                <div class="primekit-templates-popup-tabs">
                                    <!--Template Popup Tab Item-->
                                    <div class="primekit-templates-popup-tab">
                                        <ul>
                                            <!-- Dynamically loaded from AJAX by loadTemplateTypes(); -->
                                        </ul>
                                    </div><!--/Template Popup Tab Item-->
                                    <!--Template Popup Search-->
                                    <div class="primekit-templates-search">
                                        <form action="">
                                            <input type="text" name="search" id="primekit-templates-search"
                                                placeholder="Search">
                                        </form>
                                    </div><!--/Template Popup Search-->
                                </div><!--/Template Popup Tabs-->
                                <!--Template Grid-->
                                <div class="primekit-template-grid-area" id="primekit-templates-modal-content">
                                    <p><?php echo esc_html__('Loading templates...', 'primekit-addons'); ?></p>
                                </div>
                            </div><!--/Template Popup Content-->
                        </div><!--/Template Popup-->

                    </main>
                    <!-- <footer class="modal__footer">
                        <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Close</button>
                    </footer> -->
                </div>
            </div>
        </div>


        <?php
    }

}
