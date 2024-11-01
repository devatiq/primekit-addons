<?php
/**
 * Render View for PrimeKit Breadcrumb Widget
 */

 if (!defined('ABSPATH')) exit; // Exit if accessed directly

 if (!function_exists('primekit_addons_breadcrumb')) {
    function primekit_addons_breadcrumb() {
        // Initialize an output variable
        $output = '';
        
        // Define the home text and URL
        $home_text = 'Home';
        $home_url = home_url('/');
    
        // Define the separator
        $separator = ' &raquo; ';
    
        // Start outputting the breadcrumbs
        $output .= '<div class="breadcrumbs">';
    
        // Home link
        $output .= '<a href="' . esc_url($home_url) . '">' . esc_html($home_text) . '</a>';
        $output .= '<span class="separator">' . esc_html($separator) . '</span>';
    
        // Check if it's a single post
        if (is_single()) {
            // Get the category
            $categories = get_the_category();
            if ($categories) {
                $category = $categories[0];
                $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                $output .= '<span class="separator">' . esc_html($separator) . '</span>';
            }
    
            // Post title
            $output .= '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_category()) {
            // Category archive
            $output .= '<span class="current">' . esc_html(single_cat_title('', false)) . '</span>';
        } elseif (is_page()) {
            // Standard page
            $output .= '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_search()) {
            // Search results
            $output .= '<span class="current">' . esc_html__('Search Results', 'primekit-addons') . '</span>';
        } elseif (is_404()) {
            // 404 page
            $output .= '<span class="current">' . esc_html__('404 Not Found', 'primekit-addons') . '</span>';
        }
    
        $output .= '</div>';
        return $output;
    } 
}

?>

<div class="primekit-elementor-bread-crumb-area">
    <?php 
    echo wp_kses(primekit_addons_breadcrumb(), wp_kses_allowed_html('post')); ?>
</div><!-- end breadcrumb area -->
