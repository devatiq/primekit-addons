<?php
/**
 * Render View for Modern Post Grid style 7
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

?>
<!-- Modern Post Grid Area-->
<div class="primekit-modren-posts-grid-area">
    <div class="primekit-modren-posts-grid-wrapper primekit-modren-posts-grid-style8">
        <?php
        $query = new WP_Query($args);

        if ($query->have_posts()):
            while ($query->have_posts()):
                $query->the_post();
                $random_color = $this->generate_random_color(); // get random color
                $post_data = wp_json_encode([
                    'id' => get_the_ID(),
                    'permalink' => get_permalink(),
                    'title' => get_the_title()
                ]);
                ?>

                <!-- Single Post -->
                <div class="primekit-modren-single-post primekit-modern-single-post-link" data-post="<?php echo esc_attr($post_data); ?>">
                    <!-- Post Thumbnail -->
                    <div class="primekit-modren-single-post-thumbnail">
                        <?php if (has_post_thumbnail(get_the_ID())): ?>
                            <?php the_post_thumbnail('full'); ?>
                        <?php else: ?>
                            <img src="<?php echo esc_url($fallback_image); ?>" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                    </div><!--/ Post Thumbnail -->

                    <!-- Post Contents -->
                    <div class="primekit-modren-single-post-contents">
                        <?php if ($categories_switch === 'true' && !empty($categories_switch)): ?>
                            <!-- Category -->
                            <div class="primekit-modren-style2-post-cat">
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
                        <div class="primekit-modren-single-post-title">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div><!--/ Post Title -->

                        <?php if ($post_info_switch === 'true' && !empty($post_info_display)): ?>
                            <!-- Post info -->
                            <div class="primekit-modren-single-post-info">
                                <ul>
                                    <?php if (in_array('date', $post_info_display)): ?>
                                        <li><span class="fa fa-calendar"></span><a
                                                href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_date('d/m/y'); ?></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (in_array('author', $post_info_display)): ?>
                                        <li><span class="fa fa-user"></span><a
                                                href="<?php echo esc_attr(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (in_array('comments', $post_info_display)): ?>
                                        <li><span class="fa fa-comments"></span><a
                                                href="<?php comments_link(); ?>"><?php comments_number(); ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div><!--/ Post info -->
                        <?php endif; ?>
                    </div><!-- Post Contents -->
                </div><!--/ Single Post -->

                <?php
            endwhile;
            wp_reset_postdata(); // Reset after the custom query loop
        else:
            echo '<p>' . esc_html__('No posts found.', 'primekit-addons') . '</p>';
        endif;
        ?>
    </div>
</div><!--/ Modern Post Grid Area-->