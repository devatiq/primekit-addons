<?php if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
?>
<!-- Two column blog area -->
<div class="primekit-ele-two-column-blog-area">

    <div class="primekit-ele-two-column-blog"> <!-- start primekit-ele-two-column-blog -->
        <?php

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if (is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $args = array(
            'post_type' => 'post',
            'paged' => $paged,
            'posts_per_page' => $primekit_number_of_posts,
        );

        // specific category query
        if ($primekit_selected_category && $primekit_selected_category !== 'all') {
            $args['cat'] = $primekit_selected_category;
        }

        $query = new WP_Query($args);

        if ($query->have_posts()):

            $post_count = 0;

            while ($query->have_posts()):
                $query->the_post(); ?>

                <div class="primekit-ele-blog-item">

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <?php if (has_post_thumbnail() && $primekit_img_switch === 'yes'): ?>
                            <div class="primekit-ele-blog-thumb">
                                <figure>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php
                                        if ('blog' == $primekit_settings['primekit_elementor_blog_grid_img_size']) {
                                            the_post_thumbnail('primekit_blog_grid_thumb');
                                        } else {
                                            the_post_thumbnail('full');
                                        }
                                        ?>
                                    </a>
                                </figure>
                            </div>
                        <?php elseif ($primekit_img_switch === 'yes'): ?>
                            <div class="primekit-ele-blog-thumb">
                                <figure>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">

                                        <?php echo '<img src="' . esc_url(PRIMEKIT_ELEMENTOR_ASSETS . '/img/blog/img-placeholder.jpg') . '" alt="' . esc_attr(get_the_title()) . '">'; ?>
                                    </a>
                                </figure>
                            </div>
                        <?php endif; ?>

                        <h3 class="primekit-ele-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="primekit-ele-blog-meta">
                            <?php if ($primekit_date_switch === 'yes'): ?><span class="posted-on"><i class="eicon-calendar"></i>
                                    <?php the_time(get_option('date_format')); ?></span><?php endif; ?>
                            <?php if ($primekit_comment_switch === 'yes'): ?><span class="comment-link"><a
                                        href="<?php comments_link(); ?>"><i class="eicon-instagram-comments"></i>
                                        <?php comments_number(esc_html__('Leave a comment', 'primekit-addons'), esc_html__('1 Comment', 'primekit-addons'), esc_html__('% Comments', 'primekit-addons')); ?></a></span><?php endif; ?>
                        </div>

                        <?php if ($primekit_excerpt_switch === 'yes'): ?>
                            <!-- Blog excerpt -->
                            <?php
                            $primekit_post_id = get_the_ID();
                            $primekit_excerpt_content = get_post_meta($primekit_post_id, 'primekit_addons_excerpt_content', true);
                            $primekit_limited_excerpt = wp_trim_words($primekit_excerpt_content, $primekit_excerpt_length_grid);
                            if (!empty($primekit_excerpt_content)): ?>
                                <div class="primekit-ele-blog-grid-excerpt">
                                    <p><?php echo esc_html($primekit_limited_excerpt); ?></p>
                                </div>
                            <?php endif; ?>
                            <!-- /Blog excerpt -->
                        <?php endif; ?>

                        <?php if ($primekit_read_more_switch === 'yes'): ?>
                            <div class="primekit-ele-blog-more"><a
                                    href="<?php the_permalink(); ?>"><?php echo esc_html($primekit_grid_read_more_text); ?></a>
                            </div>
                        <?php endif; ?>

                    </article>

                </div> <!-- end primekit-ele-blog-item -->

                <?php

                $post_count++;

            endwhile; ?>
        </div> <!-- end primekit-ele-two-column-blog -->
        <?php if ($primekit_pagination_switch === 'yes'): ?>
            <div class="clearfix"></div>
            <div class="primekit-ele-pagination-container">
                <?php
                $primekitbig = 999999999;
                echo wp_kses_post(paginate_links(array(
                    'base' => str_replace($primekitbig, '%#%', esc_url(get_pagenum_link($primekitbig))),
                    'format' => '?paged=%#%',
                    'current' => max(1, $paged),
                    'total' => $query->max_num_pages,
                )));
                ?>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="clearfix"></div>
        <h3 class="post-title"><?php esc_html_e('No Post Found', 'primekit-addons'); ?></h3>
        <?php
        wp_reset_postdata();
        endif; ?>

</div><!-- / PrimeKit Two column blog -->