<?php
/**
 * Render View file for PrimeKit Author Bio.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();

// post info switcher
$primekit_author_show_link = $primekit_settings['primekit_elementor_author_bio_link_switch'] === 'yes';
$primekit_author_text = $primekit_settings['primekit_elementor_author_bio_text'] ? $primekit_settings['primekit_elementor_author_bio_text'] : '';
?>

<!-- Author Bio Area-->
<div class="primekit-ele-author-bio-area">
    <div class="primekit-ele-author-bio">
    
    <div class="primekit-ele-authorleft">
<?php echo get_avatar( get_the_author_meta( 'user_email' ), 200); ?>
</div>
<div class="primekit-ele-authorright">
    <?php if(!empty($primekit_author_text)) : ?>
        <h3 class="primekit-author-bio-title"><?php echo esc_html($primekit_author_text);?></h3>
    <?php endif; ?>
<?php the_author_meta( 'description' ); ?><?php if($primekit_author_show_link == 'yes' ) : ?><a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php esc_html_e( 'View all posts by', 'primekit-addons' );?></a> <?php the_author_posts_link(); ?> <span class="meta-nav">&rarr;</span><?php endif; ?>
</div>
      
    </div>
</div><!--/ Author bio Area-->