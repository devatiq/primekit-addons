<?php
/**
 * Render View file for PrimeKit Post Category Info list view
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_display_icon = $primekit_settings['primekit_elementor_post_cat_icon'] === 'yes';
?>

<!-- Post Category Area -->
<div class="primekit-ele-post-cat-area">
    <div class="primekit-ele-post-cat cat-list-view">
    
    <?php 
    $categories = get_the_category();
    $output = '';

    if (!empty($categories)) {
        foreach ($categories as $category) {
            $output .= '<div class="primekit-ele-category-item">';
            if ($primekit_display_icon) {
                $output .= '<i class="eicon-chevron-double-right"></i>';
            }
            $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_attr(sprintf(__('View all posts in %s', 'primekit-addons'), $category->name)) . '">' . esc_html($category->name) . '</a>';
            $output .= '</div>';
        }
        echo wp_kses_post($output);
    }
    ?>
    </div>
</div><!--/ Post Category Area -->
