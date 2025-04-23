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
    }


    public function enqueue_modal()
    {
        //add_action('wp_footer', [$this, 'render']);
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
                                        <label class="primekit-checkbox">
                                            <input type="checkbox" value="all" checked>
                                            <span><?php esc_html_e('All', 'primekit-addons'); ?></span>
                                        </label>
                                        <label class="primekit-checkbox">
                                            <input type="checkbox" value="header">
                                            <span><?php esc_html_e('Header', 'primekit-addons'); ?></span>
                                        </label>
                                        <label class="primekit-checkbox">
                                            <input type="checkbox" value="footer">
                                            <span><?php esc_html_e('Footer', 'primekit-addons'); ?></span>
                                        </label>
                                        <label class="primekit-checkbox">
                                            <input type="checkbox" value="about">
                                            <span><?php esc_html_e('About', 'primekit-addons'); ?></span>
                                        </label>
                                        <label class="primekit-checkbox">
                                            <input type="checkbox" value="contact">
                                            <span><?php esc_html_e('Contact', 'primekit-addons'); ?></span>
                                        </label>
                                        <label class="primekit-checkbox">
                                            <input type="checkbox" value="services">
                                            <span><?php esc_html_e('Services', 'primekit-addons'); ?></span>
                                        </label>
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
                                        <li><a href="">Templates</a></li>
                                        <li><a href="">Section</a></li>
                                    </ul>
                                   </div><!--/Template Popup Tab Item-->
                                   <!--Template Popup Search-->
                                   <div class="primekit-templates-search">
                                    <form action="">
                                        <input type="text" name="search" id="primekit-templates-search" placeholder="Search">
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

    public function render2()
    {
        ?>
        <div class="modal micromodal-slide primekit-template-modal-area" id="primekit-template-modal" aria-hidden="true">
            <div class="modal__overlay" tabindex="-1">
                <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="primekit-tb-modal-title">

                    <!--Header-->
                    <header class="modal__header primekit-modal-header">
                        <h2 class="modal__title primekit-modal-heading" id="primekit-tb-modal-title">
                            <img src="<?php echo PRIMEKIT_ADMIN_ASSETS . '/img/primekit-icon.svg'; ?>" alt="">
                            <?php esc_html_e('PrimeKit Templates', 'primekit-addons'); ?>
                        </h2>
                        <button class="modal__close primekit-template-modal-close" aria-label="Close modal"
                            data-micromodal-close>

                            <svg id="fi_2961937" height="512" viewBox="0 0 64 64" width="512"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m4.59 59.41a2 2 0 0 0 2.83 0l24.58-24.58 24.59 24.58a2 2 0 0 0 2.83-2.83l-24.59-24.58 24.58-24.59a2 2 0 0 0 -2.83-2.83l-24.58 24.59-24.59-24.58a2 2 0 0 0 -2.82 2.82l24.58 24.59-24.58 24.59a2 2 0 0 0 0 2.82z">
                                </path>
                            </svg>

                        </button>
                    </header><!--/ Header-->

                    <!--Body-->
                    <main class="modal__content" id="primekit-template-modal-content-area">

                        <div class="primekit-template-modal-content-area">

                        </div>
                    </main><!--/ Body-->
                </div>
            </div>
        </div>
        <?php
    }
}
