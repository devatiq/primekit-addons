<?php
/**
 * ConditionManager.php
 *
 * This file contains the ConditionManager class, which is responsible for handling
 * the display conditions and conditions management in the Theme Builder.
 *
 * @package PrimeKit\Admin\Inc\ThemeBuilder\Admin
 * @since 1.0.0
 */

namespace PrimeKit\Admin\Inc\ThemeBuilder\Admin;

defined('ABSPATH') || exit;

/**
 * Class ConditionManager
 * 
 * Handles the display conditions and conditions management in the Theme Builder.
 * 
 * @package PrimeKit\Admin\Inc\ThemeBuilder\Admin
 * @since 1.0.0
 */
class ConditionManager
{

    public function __construct()
    {
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_elementor_editor_assets']);

        add_action('wp_ajax_primekit_select2_search_posts', [$this, 'primekit_select2_search_posts']);

        add_action('wp_ajax_nopriv_primekit_select2_search_posts', array($this, 'primekit_select2_search_posts'));

    }

    /**
     * Enqueues the necessary assets for the Elementor editor.
     * 
     * This function checks if the current screen is the Elementor editor and
     * enqueues the required scripts and styles for the editor.
     * 
     * @return void
     * 
     * @since 1.0.0
     */
    public function enqueue_elementor_editor_assets()
    {



        // Check if in Elementor editor
        if (isset($_GET['action']) && $_GET['action'] === 'elementor' && isset($_GET['post'])) {
            $post_id = $_GET['post'];
            $post_type = get_post_type($post_id);

            // Enqueue scripts and styles only for 'primekit_library' post type
            if ($post_type === 'primekit_library') {
                wp_enqueue_style('select2', plugins_url('../assets/css/select2.min.css', __FILE__), array(), '4.1.0', 'all');

                wp_enqueue_style('primekit-tb-editor-modal', plugins_url('../assets/css/editor.css', __FILE__), array(), '1.0.0', 'all');
                wp_enqueue_script('micromodal', '//unpkg.com/micromodal@0.4.10/dist/micromodal.min.js', array('jquery'), '0.4.10', true);

                wp_enqueue_script('select2', plugins_url('../assets/js/select2.min.js', __FILE__), ['elementor-editor', 'jquery'], '4.1.0', true);


                wp_enqueue_script('primekit-elementor-template-conditions', plugins_url('../assets/js/template-conditions.js', __FILE__), ['jquery', 'select2'], '1.0.0', true);

                wp_localize_script('primekit-elementor-template-conditions', 'primekit_template_conditions', [
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('template_conditions_nonce')
                ]);


            }
        }

    }


    /**
     * Handles the AJAX request for searching posts.
     * 
     * This function checks if the nonce is valid and processes the search request
     * for posts based on the type specified in the request.
     * 
     * @return void
     * 
     * @since 1.0.0
     */
    public function primekit_select2_search_posts()
    {
        check_ajax_referer('template_conditions_nonce', 'nonce');
    
        $searchTerm = sanitize_text_field($_POST['searchTerm']);
        $type = sanitize_text_field($_POST['type']);
        $results = [];
    
        switch ($type) {
            case 'post':
            case 'page':
                // Standard post types
                $query = new \WP_Query([
                    'post_type' => $type,
                    'posts_per_page' => -1,
                    's' => $searchTerm,
                ]);
    
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $results[] = ['id' => get_the_ID(), 'text' => get_the_title()];
                    }
                }
                break;
    
            case 'in_category':
            case 'in_post_tag':
                // Taxonomy terms
                $taxonomy = ($type === 'in_category') ? 'category' : 'post_tag';
                $terms = get_terms([
                    'taxonomy' => $taxonomy,
                    'hide_empty' => false,
                    'name__like' => $searchTerm
                ]);
    
                foreach ($terms as $term) {
                    $results[] = ['id' => $term->term_id, 'text' => $term->name];
                }
                break;
    
            case 'by_author':
                // Authors
                $users = get_users([
                    'search' => '*' . esc_attr($searchTerm) . '*',
                    'search_columns' => ['display_name'],
                    'fields' => ['ID', 'display_name']
                ]);
    
                foreach ($users as $user) {
                    $results[] = ['id' => $user->ID, 'text' => $user->display_name];
                }
                break; 
    
            case 'not_found404':
                // Special case for 404 Page
                $results[] = ['id' => 404, 'text' => '404 Not Found Page'];
                break;
    
            default:
                $results[] = ['id' => 0, 'text' => 'No valid type provided'];
                break;
        }
    
        wp_reset_postdata();
        wp_send_json_success($results);
    }
    




}