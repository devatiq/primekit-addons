<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Add metabox for post excerpt
add_action('add_meta_boxes', 'primekit_addons_add_excerpt_metabox');

function primekit_addons_add_excerpt_metabox() {
    add_meta_box(
        'primekit_addons_excerpt_metabox',
        esc_html__('PrimeKit Blog Excerpt', 'primekit-addons'),
        'primekit_addons_excerpt_metabox_content',
        'post', 
        'normal', 
        'high'
    );
}

// Save post excerpt metabox data
add_action('save_post', 'primekit_addons_save_excerpt_metabox');

function primekit_addons_save_excerpt_metabox($post_id) {
    // Nonce check
    if (!isset($_POST['primekit_addons_excerpt_metabox_nonce']) || !wp_verify_nonce(sanitize_text_field( wp_unslash ($_POST['primekit_addons_excerpt_metabox_nonce'])), basename(__FILE__))) {
        return $post_id;
    }

    // Check if autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Check user permissions
    if ('post' == $_POST['post_type'] && !current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Validate and sanitize data
    $excerpt_content = isset($_POST['primekit_addons_excerpt_content']) ? sanitize_textarea_field($_POST['primekit_addons_excerpt_content']) : '';

    // Update post meta
    update_post_meta($post_id, 'primekit_addons_excerpt_content', $excerpt_content);
}

// Metabox content for post excerpt
function primekit_addons_excerpt_metabox_content($post) {
    // Add nonce field
    wp_nonce_field(basename(__FILE__), 'primekit_addons_excerpt_metabox_nonce');

    // Retrieve the existing value (if any)
    $excerpt_content = get_post_meta($post->ID, 'primekit_addons_excerpt_content', true);
    ?>

    <label for="primekit_addons_excerpt_content"><?php esc_html_e('Enter Excerpt Content:', 'primekit-addons'); ?></label>
    
    <textarea name="primekit_addons_excerpt_content" id="primekit_addons_excerpt_content" rows="5" style="width:100%;">
        <?php echo esc_textarea($excerpt_content); ?>
    </textarea>

    <?php
}

//WooCommerce Check
if ( class_exists( 'WooCommerce' ) && function_exists( 'wc_get_product' ) && 1 == get_option('primekit_wc_product_tabs_field')) {
    // Product Description Meta Box
    function primekit_add_wc_product_meta_box() {
        add_meta_box(
            'primekit_wc_product_description',
            'PrimeKit Product Description Tab',
            'primekit_wc_product_meta_box_html',
            'product',
            'advanced',
            'high'
        );
    }
    add_action('add_meta_boxes', 'primekit_add_wc_product_meta_box', 5);

    function primekit_wc_product_meta_box_html($post) {
        // Nonce field for security
        wp_nonce_field('primekit_wc_product_description_nonce_action', 'primekit_wc_product_description_nonce');
        
        echo '<p><strong>' . esc_html__('Note:', 'primekit-addons') . '</strong> ' . esc_html__('This area is specifically for PrimeKit Addons and Templates for Elementor by ABCPlugin Products description tab contents.', 'primekit-addons') . '</p>';
        $content = get_post_meta($post->ID, '_primekit_wc_product_description', true);
        wp_editor(
            htmlspecialchars_decode($content),
            'primekit_wc_product_description_editor',
            array(
                'textarea_name' => 'primekit_wc_product_description',
                'editor_height' => 200,
                'media_buttons' => true
            )
        );
    }
    
    function primekit_save_wc_desc_postdata($post_id) {
        // Check if our nonce is set and verify it.
        if (!isset($_POST['primekit_wc_product_description_nonce']) || !wp_verify_nonce(sanitize_text_field( wp_unslash ($_POST['primekit_wc_product_description_nonce'])), 'primekit_wc_product_description_nonce_action')) {
            return $post_id;
        }
        
        // Proceed to save the data
        if (array_key_exists('primekit_wc_product_description', $_POST)) {
            update_post_meta(
                $post_id,
                '_primekit_wc_product_description',
                wp_kses_post($_POST['primekit_wc_product_description'])
            );
        }
    }
  // Save data
  add_action('save_post', 'primekit_save_wc_desc_postdata');
    
}
