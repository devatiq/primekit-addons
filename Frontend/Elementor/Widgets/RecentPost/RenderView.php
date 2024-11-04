<?php
/**
 * Render View file for PrimeKit Recent Posts
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_recent_number_of_posts = $this->get_settings('primekit_elementor_recent_posts_post_number')['size'];
$primekit_post_date_switch = $primekit_settings['primekit_elementor_recent_posts_date_switch'];
$primekit_post_comment_switch = $primekit_settings['primekit_elementor_recent_posts_comment_switch'];
$primekit_post_read_more_switch = $primekit_settings['primekit_elementor_recent_posts_read_more_switch'];
$primekit_post_read_more_text = $primekit_settings['primekit_elementor_recent_posts_read_more_text'];
$primekit_selected_post_categories = $primekit_settings['primekit_elementor_recent_posts_post_category'];
?>

<!-- Recent Posts Area -->
<div class="primekit-ele-recent-post-area">
    <div class="primekit-ele-recent-post">

        <?php

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if (is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $args = array(
            'post_type'      => 'post',
            'paged'          => $paged,
            'posts_per_page' => $primekit_recent_number_of_posts,
        );

        // specific category query
        if ($primekit_selected_post_categories && $primekit_selected_post_categories !== 'all') {
            $args['cat'] = $primekit_selected_post_categories;
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) :

            while ($query->have_posts()) : $query->the_post(); ?>

                <div class="primekit-ele-recent-post-item">

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="primekit-ele-recent-post-content">
                            <h3 class="primekit-ele-recent-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="primekit-ele-recent-post-meta">
                                <?php if ($primekit_post_date_switch === 'yes') : ?><span class="posted-on"><i class="eicon-calendar"></i> <?php the_time(get_option('date_format')); ?></span><?php endif; ?>
                                <?php if ($primekit_post_comment_switch === 'yes') : ?><span class="comment-link"><a href="<?php comments_link(); ?>"><i class="eicon-instagram-comments"></i> <?php comments_number(esc_html__('Leave a comment', 'primekit-addons'), esc_html__('1 Comment', 'primekit-addons'), esc_html__('% Comments', 'primekit-addons')); ?></a></span><?php endif; ?>
                            </div>

                            <?php if ($primekit_post_read_more_switch === 'yes') : ?>
                                <div class="primekit-ele-recent-post-more"><a href="<?php the_permalink(); ?>"><?php echo esc_html($primekit_post_read_more_text); ?></a></div>
                            <?php endif; ?>
                        </div>

                    </article>

                </div> <!-- end primekit-ele-recent-post-item -->

            <?php endwhile; ?>

        <?php else : ?>
            <div class="clearfix"></div>
            <h3 class="post-title"><?php esc_html_e('No Post Found', 'primekit-addons'); ?></h3>
            <?php
            wp_reset_postdata();
        endif; ?>

    </div>
</div><!--/ Recent Posts Area -->
