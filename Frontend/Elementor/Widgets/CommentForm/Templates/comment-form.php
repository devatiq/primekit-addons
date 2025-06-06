<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
// How comments are displayed

use PrimeKit\Frontend\Elementor\Inc\Functions;

if (post_password_required()) {
    return;
}
?>

<div id="comments">

    <div class="comments-area">

        <?php if (have_comments()): ?>
            <h3 class="comments-title">
                <?php
                $comments_number = get_comments_number();                
                echo esc_html(sprintf(
                    // Translators: %1$s is the number of comments, %2$s is the post title.
                    _nx(
                        '%1$s thought on &ldquo;%2$s&rdquo;',
                        '%1$s thoughts on &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'primekit-addons'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title()
                ));
                ?>


            </h3>

            <?php Functions::primekit_multi_comment_nav();
            ; ?>

            <ol class="comment-list">
                <?php
                wp_list_comments(array(
                    'style' => 'ol',
                    'short_ping' => true,
                    'avatar_size' => 56,
                ));
                ?>
            </ol><!-- .comment-list -->

            <?php Functions::primekit_multi_comment_nav();
            ; ?>

        <?php endif; // have_comments() ?>

        <?php
        if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')):
            ?>
            <p class="no-comments"><?php echo esc_html__('Comments are closed.', 'primekit-addons'); ?></p>
        <?php endif; ?>

        <?php comment_form(); ?>

    </div><!-- .comments-area -->

</div>