<?php
namespace PrimeKit\Frontend\Elementor\Inc;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Post View Tracker Class
 * @since 1.0.0
 * this class tracks post views for a single post and returns the view count, used in popular post widget.
 * @package PrimeKit\Frontend\Elementor\Inc
 * @author SupreoX Limited
 */

class PostViewTracker {

   
    /**
     * Constructor for the PostViewTracker class.
     *
     * Hooks into the WordPress 'wp_head' action to track post views.
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action('wp_head', [$this, 'track_views']);
    }

   
    /**
     * Increment the post view count.
     *
     * Hooks into the WordPress 'wp_head' action and if the current page is a single post,
     * it will increment the post view count.
     *
     * @since 1.0.0
     */
    public function track_views() {
        if (is_single()) {
            $post_id = get_the_ID();
            if ($post_id) {
                $this->increment_views($post_id);
            }
        }
    }

   
    /**
     * Increment the view count for a given post.
     *
     * Retrieves the current view count from the post meta, increments it by one,
     * and updates the post meta with the new view count.
     *
     * @param int $post_id The ID of the post whose view count is to be incremented.
     *
     * @since 1.0.0
     */
    private function increment_views($post_id) {
        $views = get_post_meta($post_id, 'primekit_post_views', true);
        $views = $views ? (int) $views : 0;
        $views++;
        update_post_meta($post_id, 'primekit_post_views', $views);
    }
    
    /**
     * Get the view count for a given post.
     *
     * Retrieves the view count from the post meta and returns it as an integer.
     *
     * @param int $post_id The ID of the post whose view count is to be retrieved.
     *
     * @return int The post view count.
     *
     * @since 1.0.0
     */
    public static function get_views($post_id) {
        $views = get_post_meta($post_id, 'primekit_post_views', true);
        return $views ? (int) $views : 0;
    }
}