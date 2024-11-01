<?php
namespace PrimeKit\Admin\Inc\ThemeBuilder\Classes;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ModalMarkup
{
    public function __construct()
    {
        add_action('admin_footer', array($this, 'print_modal_markup'));
        add_action('elementor/editor/footer', array($this, 'template_editor_modal_markup'));
        add_action('admin_post_primekit_save_template', array($this, 'save_template_meta'));
    }



    public function print_modal_markup()
    {
        $screen = get_current_screen();
        if ('edit-primekit_library' === $screen->id) {
            ?>
            <div class="modal micromodal-slide primekit-theme-builder-modal-area" id="primekit-tb-modal" aria-hidden="true">
                <div class="modal__overlay" tabindex="-1">
                    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="primekit-tb-modal-title">

                        <!--Header-->
                        <header class="modal__header primekit-modal-header">
                            <h2 class="modal__title primekit-modal-heading" id="primekit-tb-modal-title">
                                <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../assets/img/addons-icon.svg'); ?>"
                                    alt="">
                                <?php esc_html_e('PrimeKit Theme Builder', 'primekit-addons'); ?>
                            </h2>
                            <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                        </header><!--/ Header-->

                        <!--Body-->
                        <main class="modal__content primekit-theme-builder-modal-content" id="primekit-tb-modal-content">
                            <div class="primekit-tb-modal-content-area">
                                <!--Template Left Area-->
                                <div class="primekit-tb-modal-content-left">
                                    <h2><?php esc_html_e("Design Your Website's Theme Easily with PrimeKit"); ?></h2>
                                    <p><?php esc_html_e("PrimeKit's Theme Builder makes it simple to design your website’s header, footer, single pages, posts, archives, and WooCommerce product pages. Enjoy a smooth and user-friendly experience to build your site exactly the way you want, right within Elementor!", 'primekit-addons'); ?></p>
                                </div><!--/ Template Left Area-->

                                <!--Template Form Area-->
                                <div class="primekit-tb-modal-content-right primekit-tb-modal-content-form">
                                    <div class="primekit-tb-modal-content-form-heading">
                                        <h2><?php esc_html_e('Choose a Template Type', 'primekit-addons'); ?></h2>
                                        <p class="primekit-tb-modal-content-form-note">
                                            <?php esc_html_e('Choose a template that best fits your needs.', 'primekit-addons'); ?>
                                        </p>

                                        <!-- <?php
                                        global $wpdb;
                                        $results = $wpdb->get_results('SELECT * FROM wp_postmeta WHERE post_id = 820 AND meta_key LIKE "%elementor%"', ARRAY_A);
                                        echo '<pre>';
                                        var_dump($results);
                                        ?> -->
                                    </div>
                                    <!--Form Fields-->
                                    <div class="primekit-tb-modal-content-form-fields">
                                        <form id="primekit-tb-modal-template-form" method="post"
                                            action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                                            <input type="hidden" id="primekit-tb-post-type" name="post_type" value="primekit_library">
                                            <input type="hidden" name="action" value="primekit_save_template">
                                            <input type="hidden" name="post_id" value="<?php echo esc_attr(get_the_ID()); ?>">
                                            <?php wp_nonce_field('primekit_tb_modal_action', 'primekit_tb_modal_nonce'); ?>
                                            <div class="primekit-tb-modal-single-field">
                                                <select name="primekit-tb-modal-select" id="primekit-tb-modal-select-template-type">
                                                    <option value=""><?php esc_html_e('Select...', 'primekit-addons'); ?>
                                                    </option>
                                                    <option value="header"><?php esc_html_e('Header (Global)', 'primekit-addons'); ?></option>
                                                    <option value="footer"><?php esc_html_e('Footer (Global)', 'primekit-addons'); ?></option>
                                                    <option value="single_post"><?php esc_html_e('Single Post', 'primekit-addons'); ?></option>
                                                    <option value="single_page"><?php esc_html_e('Single Page', 'primekit-addons'); ?></option>
                                                    <option value="search_page"><?php esc_html_e('Search Page', 'primekit-addons'); ?></option>
                                                    <option value="404_page"><?php esc_html_e('404 Page', 'primekit-addons'); ?></option>
                                                    <option value="archive_page"><?php esc_html_e('Archive Page', 'primekit-addons'); ?></option>
                                                </select>
                                            </div>
                                            <div class="primekit-tb-modal-single-field">
                                                <label
                                                    for="primekit-tb-modal-ftemplate-name"><?php esc_html_e('Name your template', 'primekit-addons'); ?></label>
                                                <input type="text" name="primekit-tb-modal-ftemplate-name"
                                                    id="primekit-tb-modal-ftemplate-name" placeholder="Template Name">
                                            </div>
                                            <div class="primekit-tb-modal-single-field">
                                                <button class="primekit-tb-modal-content-form-submit"
                                                    id="primekit-tb-modal-content-form-submit"
                                                    disabled><?php esc_html_e('Create Template', 'primekit-addons'); ?></button>
                                            </div>
                                        </form>
                                    </div><!--/ Form Fields-->
                                </div><!--/ Template Form Area-->
                            </div>
                        </main><!--/ Body-->
                    </div>
                </div>
            </div>
            <?php
        }
    }

    public function template_editor_modal_markup()
    {
        if (isset($_GET['action']) && $_GET['action'] === 'elementor') {
            ?>

            <div class="modal micromodal-slide primekit-theme-builder-modal-area" id="primekit-tb-editor-modal" aria-hidden="true">
                <div class="modal__overlay" tabindex="-1">
                    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="primekit-tb-modal-title">

                        <!--Header-->
                        <header class="modal__header primekit-modal-header">
                            <h2 class="modal__title primekit-modal-heading" id="primekit-tb-editor-modal-title">
                                <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../assets/img/addons-icon.svg'); ?>"
                                    alt="">
                                <?php esc_html_e('Template Elements Condition', 'primekit-addons'); ?>
                            </h2>
                            <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                        </header><!--/ Header-->

                        <!--Body-->
                        <main class="modal__content primekit-theme-builder-modal-content" id="primekit-tb-editor-modal-content">

                            <div class="primekit-tb-modal-content-area">
                                <div class="primekit-tb-modal-content-heading">
                                    <h2><?php esc_html_e('Where would you like to place your template?', 'primekit-addons'); ?></h2>
                                    <p>
                                        <?php esc_html_e('Specify the conditions under which your template will be applied across your website. For instance, selecting \'Entire Site\' will ensure the template is visible throughout your entire website.', 'primekit-addons'); ?>
                                </div>

                                <!--Template condition form-->
                                <div class="primekit-tb-modal-condition-form">

                                    <form action="#" id="primekit-tb-modal-condition-form">
                                        <div class="primekit-tb-modal-condition-wrapper" id="primekit-tb-modal-condition-wrapper">
                                            <!--Condition will be added here-->
                                        </div>
                                        <button
                                            class="primekit-tb-modal-condition-repeater-btn"><?php esc_html_e('+ Add Condition', 'primekit-addons'); ?></button>
                                    </form>
                                </div>

                            </div>
                        </main><!--/ Body-->

                        <footer class="modal__footer primekit-tb-modal-content-footer">
                            <button class="modal__btn modal__btn-primary"
                                id="primekit-tb-modal-content-form-submit"><?php esc_html_e('Save and Continue', 'primekit-addons'); ?></button>
                            <button class="modal__btn" aria-label="Close this dialog window"
                                data-micromodal-close><?php esc_html_e('Cancel', 'primekit-addons'); ?></button>
                        </footer>
                    </div>
                </div>
            </div>
            <?php
        }
    }


    public function save_template_meta()
    {
        error_log('Form submitted');
        if (!isset($_POST['primekit_tb_modal_nonce']) || !wp_verify_nonce($_POST['primekit_tb_modal_nonce'], 'primekit_tb_modal_action')) {
            wp_die('Nonce check failed');
        }

        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
        error_log('Post ID: ' . $post_id);

        if (!$post_id || !current_user_can('edit_post', $post_id)) {
            wp_die('Permission check failed');
        }

        $template_type = isset($_POST['primekit-tb-modal-select']) ? sanitize_text_field($_POST['primekit-tb-modal-select']) : '';
        error_log('Template Type: ' . $template_type);
        update_post_meta($post_id, '_primekit_template_type', $template_type);  // Ensure this meta key is the same used in your meta box

        wp_redirect(admin_url('post.php?post=' . $post_id . '&action=edit'));
        exit;
    }


}