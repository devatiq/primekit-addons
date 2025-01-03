<?php
/**
 * Render View file for Popular Posts Widget
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use PrimeKit\Frontend\Elementor\Inc\PostViewTracker;

$settings = $this->get_settings_for_display();

$fallback_image = PRIMEKIT_ELEMENTOR_ASSETS . '/img/blog/image-placeholder.jpg';
$random_color_switch = isset($settings['category_random_color_switch']) ? $settings['category_random_color_switch'] : 'false';


// Determine if popular posts should be based on comments or views
$orderby = $settings['primekit_popular_posts_views'] === 'views' ? 'meta_value_num' : 'comment_count';
$meta_key = $settings['primekit_popular_posts_views'] === 'views' ? 'primekit_post_views' : '';

$args = array(
    'post_type' => 'post',
    'posts_per_page' => $settings['primekit_popular_posts_limit'],
    'ignore_sticky_posts' => true,
    'orderby' => $orderby,
    'meta_key' => $meta_key,
    'order' => 'DESC',
);

?>

<!-- Popular Posts Area-->
<div class="primekit-popular-posts-area">
    <div class="primekit-popular-posts-wrapper">
        <?php

        $popular_posts = new WP_Query($args);

        if ($popular_posts->have_posts()):
            while ($popular_posts->have_posts()):
                $popular_posts->the_post();
                $random_color = $this->generate_random_color(); // get random color
                ?>
                <!--Single Post -->
                <div class="primekit-popular-posts-single-post">
                    <!-- Post Thumbnail -->
                    <div class="primekit-popular-post-thumbanil">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('full'); ?>
                        <?php else: ?>
                            <img src="<?php echo esc_url($fallback_image); ?>" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                    </div><!--/ Post Thumbnail -->
                    <!-- Post Contents -->
                    <div class="primekit-popular-post-contents">
                        <?php if ('true' === $settings['category_display_switch']): ?>
                            <!--Category -->
                            <div class="primekit-popular-post-cat">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '"';
                                    if ('true' === $random_color_switch) {
                                        echo ' style="background-color: ' . esc_attr($random_color) . '"';
                                    }
                                    echo '>' . esc_html($categories[0]->name) . '</a>';
                                }
                                ?>
                            </div><!--/ Category -->
                        <?php endif; ?>
                        <!-- Post Title -->
                        <h3 class="primekit-popular-post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3><!--/ Post Title -->

                        <?php if (!empty($settings['display_fields'])): ?>
                            <!-- Post Meta -->
                            <div class="primekit-popular-post-meta">
                                <!-- Display Views if selected -->
                                <?php if (in_array('comments', $settings['display_fields'])): ?>
                                    <span class="primekit-popular-post-comment">
                                        <i class="fa fa-comments"></i>
                                        <?php
                                        $comments_number = get_comments_number();
                                        printf(
                                            // Translators: %s is the number of comments.
                                            esc_html(_n('%s Comment', '%s Comments', $comments_number, 'primekit-addons')),
                                            esc_html($comments_number)
                                        );
                                        ?>
                                    </span>
                                <?php endif; ?>

                                <?php if (in_array('views', $settings['display_fields'])): ?>
                                    <span class="primekit-popular-post-views">
                                        <i class="fa fa-eye"></i>
                                        <?php
                                        // Get the post views using the PostViewTracker class
                                        $views = PostViewTracker::get_views(get_the_ID());
                                        echo esc_html($views) . ' ' . esc_html__('Views', 'primekit-addons');
                                        ?>
                                    </span>
                                <?php endif; ?>
                            </div><!--/ Post Meta -->
                        <?php endif; ?>
                    </div><!--/ Post Contents -->
                </div><!--/ Single Post -->
                <?php
            endwhile;
        else:
            echo esc_html__('No posts found', 'primekit-addons');
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div><!--/ Popular Posts Area-->