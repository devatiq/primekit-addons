<?php
/**
 * Render View file for PrimeKit Post Info.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();

// post info switcher
$primekit_post_show_date = $primekit_settings['primekit_elementor_post_info_date_switch'] === 'yes';
$primekit_post_show_author = $primekit_settings['primekit_elementor_post_info_author_switch'] === 'yes';
$primekit_post_show_comments = $primekit_settings['primekit_elementor_post_info_comment_switch'] === 'yes';

?>
<!-- Post Info Area-->
<div class="primekit-ele-post-info-area">
    <div class="primekit-ele-post-info">
    
    <?php if($primekit_post_show_date == 'yes' ) : ?><span class="primekit-ele-posted-on"><i class="eicon-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></span> <?php endif; ?><?php if($primekit_post_show_author == 'yes' ) : ?><span class="primekit-ele-posted-by"><i class="eicon-user-circle-o"></i> <?php the_author_posts_link(); ?></span><?php endif; ?> <?php if($primekit_post_show_comments == 'yes' ) : ?>
    <span class="primekit-ele-comment-link"><a href="<?php comments_link(); ?>"> <i class="eicon-instagram-comments"></i> <?php comments_number(esc_html__( 'Leave a comment', 'primekit-addons' ), esc_html__( '1 Comment', 'primekit-addons' ), esc_html__( '% Comments', 'primekit-addons' )); ?></a></span><?php endif; ?>
      
    </div>
</div><!--/ Post Info Area-->