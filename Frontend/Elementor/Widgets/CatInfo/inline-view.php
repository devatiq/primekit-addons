<?php
/**
 * Render View file for PrimeKit Post Category Info.
 */
 if (!defined('ABSPATH')) exit; // Exit if accessed directly
 
$primekit_settings = $this->get_settings_for_display();
?>

<!-- Post Category Area-->
<div class="primekit-ele-post-cat-area">
    <div class="primekit-ele-post-cat">
    
    <?php 
$categories = get_the_category();
$separator_class = 'primekit-ele-category-separator';
$separator = '<span class="' . esc_attr($separator_class) . '"> / </span>';
$output = '';
$count = count($categories);

if ( ! empty( $categories ) ) {
    foreach( $categories as $index => $category ) {
        // translators: Category name 
        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'primekit-addons' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>';
        
        // Add separator if not the last iteration
        if ($index < $count - 1) {
            $output .= $separator;
        }
    }
    echo wp_kses_post($output);
}
?>
    </div>
</div><!--/ Post Category Area-->