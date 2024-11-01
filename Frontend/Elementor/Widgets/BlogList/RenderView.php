<?php
/**
 * Render View file for PrimeKit Blog List.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_number_of_posts = $this->get_settings('primekit_elementor_blog_list_post_number')['size'];

$primekit_img_switch = $primekit_settings['primekit_elementor_blog_list_img_switch'];
$primekit_date_switch = $primekit_settings['primekit_elementor_blog_list_date_switch'];
$primekit_comment_switch = $primekit_settings['primekit_elementor_blog_list_comment_switch'];
$primekit_excerpt_switch = $primekit_settings['primekit_elementor_blog_list_excerpt_switch'];
$primekit_read_more_switch = $primekit_settings['primekit_elementor_blog_list_read_more_switch'];
$primekit_pagination_switch = $primekit_settings['primekit_elementor_blog_list_pagination'];
$primekit_list_read_more_text = $primekit_settings['primekit_elementor_blog_list_read_more_text'];
$primekit_selected_category_list = $primekit_settings['primekit_elementor_blog_list_category'];
$primekit_excerpt_length_list = $primekit_settings['primekit_elementor_blog_list_excerpt_length'];
?>
<!-- Blog List Area-->
<div class="primekit-ele-blog-list-area">
    <div class="primekit-ele-blog-list">

        <?php

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if (is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $args = array(
            'post_type'      => 'post',
            'paged'          => $paged,
            'posts_per_page' => $primekit_number_of_posts,
        );

           // specific category query
           if ($primekit_selected_category_list && $primekit_selected_category_list !== 'all') {
            $args['cat'] = $primekit_selected_category_list;
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) :

            while ($query->have_posts()) : $query->the_post(); ?>

                <div class="primekit-ele-blog-list-item">

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <?php if (has_post_thumbnail() && $primekit_img_switch === 'yes') : ?>
                            <div class="primekit-ele-blog-list-thumb">
                                <figure>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail('primekit_blog_list_thumb'); ?>
                                    </a>
                                </figure>
                            </div>
                        <?php elseif ($primekit_img_switch === 'yes') : ?>
                            <div class="primekit-ele-blog-list-thumb">
                                <figure>          
                                <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                <?php echo '<img src="' . esc_url(PRIMEKIT_ELEMENTOR_ASSETS) . '/img/blog/img-placeholder.jpg" alt="' . esc_attr(get_the_title()) . '">'; ?>
                                </a>
                                </figure>
                            </div>
                        <?php endif; ?>

                        <div class="primekit-ele-blog-list-content">
                            <h3 class="primekit-ele-blog-list-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="primekit-ele-blog-list-meta">
                                <?php if ($primekit_date_switch === 'yes') : ?><span class="posted-on"><i class="fa fa-calendar" aria-hidden="true"></i> <?php the_time(get_option('date_format')); ?></span><?php endif; ?>
                                <?php if ($primekit_comment_switch === 'yes') : ?><span class="comment-link"><a href="<?php comments_link(); ?>"><i class="fa fa-commenting" aria-hidden="true"></i> <?php comments_number(esc_html__('Leave a comment', 'primekit-addons'), esc_html__('1 Comment', 'primekit-addons'), esc_html__('% Comments', 'primekit-addons')); ?></a></span><?php endif; ?>
                            </div>

                            <?php if ($primekit_excerpt_switch === 'yes') : ?>
                                <!-- Blog excerpt -->
                                <?php
                                $primekit_post_id = get_the_ID();
                                $primekit_excerpt_content = get_post_meta($primekit_post_id, 'primekit_addons_excerpt_content', true);
                                $primekit_limited_excerpt = wp_trim_words($primekit_excerpt_content, $primekit_excerpt_length_list);
                                if (!empty($primekit_excerpt_content)) : ?>
                               <div class="primekit-ele-blog-list-excerpt">
                               <p><?php echo esc_html($primekit_limited_excerpt); ?></p>
                               </div>
                           <?php endif; ?>
                           <!-- /Blog excerpt -->
                            <?php endif; ?>

                            <?php if ($primekit_read_more_switch === 'yes') : ?>
                                <div class="primekit-ele-blog-list-more"><a href="<?php the_permalink(); ?>"><?php echo esc_html($primekit_list_read_more_text); ?></a></div>
                            <?php endif; ?>
                        </div>

                    </article>

                </div> <!-- end primekit-ele-blog-list-item -->

            <?php endwhile; ?>

            <?php if ($primekit_pagination_switch === 'yes') : ?>
                <div class="clearfix"></div>
                <div class="primekit-ele-blog-list-pagi-container">
                    <?php
                    $abcbig = 999999999;
                    echo paginate_links(array(
                        'base'    => str_replace($abcbig, '%#%', esc_url(get_pagenum_link($abcbig))),
                        'format'  => '?paged=%#%',
                        'current' => max(1, $paged),
                        'total'   => $query->max_num_pages,
                    ));
                    ?>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <div class="clearfix"></div>
            <h3 class="post-title"><?php esc_html_e('No Post Found', 'primekit-addons'); ?></h3>
            <?php
            wp_reset_postdata();
        endif; ?>

    </div>
</div><!--/ Blog List Area-->
