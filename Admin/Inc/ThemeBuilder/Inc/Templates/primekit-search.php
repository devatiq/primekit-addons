<?php
/*
 * search template
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

\Elementor\Plugin::$instance->frontend->add_body_class('elementor-template-full-width');

get_header();
/**
 * Before Header-Footer page template content.
 *
 * Fires before the content of Elementor Header-Footer page template.
 *
 * @since 2.0.0
 */
do_action('elementor/page_templates/header-footer/before_content');
?>

<div class="primekit-search-results-page">
    <?php
    if (!\Elementor\Plugin::$instance->preview->is_preview_mode()):
        do_action('primekit_search_page_content');
    else:
        ?>
        <div class="primekit-container">
            <?php if (have_posts()): ?>
                <h1 class="primekit-search-title">
                    <?php
                    /* Translators: %s is the search query */
                    printf(esc_html__('Search Results for: %s', 'primekit-addons'), '<span>' . get_search_query() . '</span>');
                    ?>
                </h1>

                <div class="primekit-search-results-list">
                    <?php
                    // Start the Loop
                    while (have_posts()):
                        the_post();
                        ?>
                        <div class="primekit-search-result-item">
                            <h2 class="primekit-search-result-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="primekit-search-result-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    ?>

                    <!-- Pagination -->
                    <div class="primekit-search-pagination">
                        <?php
                        // Pagination links
                        the_posts_pagination(array(
                            'prev_text' => __('Previous', 'primekit-addons'),
                            'next_text' => __('Next', 'primekit-addons'),
                        ));
                        ?>
                    </div>
                </div>

            <?php else: ?>

                <h1 class="primekit-no-results-title"><?php  echo esc_html__('No Results Found', 'primekit-addons'); ?></h1>
                <p class="primekit-no-results-message">
                    <?php echo esc_html__('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'primekit-addons'); ?>
                </p>

                <!-- Display search form -->
                <div class="primekit-search-form-container">
                    <?php get_search_form(); ?>
                </div>

            <?php endif; ?>

        </div>

    <?php endif; ?>
</div>

<?php
/**
 * After Header-Footer page template content.
 *
 * Fires after the content of Elementor Header-Footer page template.
 *
 * @since 2.0.0
 */
do_action('elementor/page_templates/header-footer/after_content');

get_footer();