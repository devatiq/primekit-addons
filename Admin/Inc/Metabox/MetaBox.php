<?php
namespace PrimeKit\Admin\Inc\Metabox;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class MetaBox {

    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_excerpt_metabox']);
        add_action('save_post', [$this, 'save_excerpt_metabox']);

        if (class_exists('WooCommerce') && function_exists('wc_get_product') && 1 == get_option('primekit_wc_product_tabs_field')) {
            add_action('add_meta_boxes', [$this, 'add_wc_product_meta_box'], 5);
            add_action('save_post', [$this, 'save_wc_product_meta_box']);
        }
    }

    public function add_excerpt_metabox() {
        add_meta_box(
            'primekit_addons_excerpt_metabox',
            esc_html__('PrimeKit Blog Excerpt', 'primekit-addons'),
            [$this, 'render_excerpt_metabox'],
            'post',
            'normal',
            'high'
        );
    }

    public function render_excerpt_metabox($post) {
        wp_nonce_field(basename(__FILE__), 'primekit_addons_excerpt_metabox_nonce');

        $excerpt_content = get_post_meta($post->ID, 'primekit_addons_excerpt_content', true);
        ?>
        <label for="primekit_addons_excerpt_content"><?php esc_html_e('Enter Excerpt Content:', 'primekit-addons'); ?></label>
        <textarea name="primekit_addons_excerpt_content" id="primekit_addons_excerpt_content" rows="5" style="width:100%;"><?php echo esc_textarea($excerpt_content); ?></textarea>
        <?php
    }

    public function save_excerpt_metabox($post_id) {
        if (!isset($_POST['primekit_addons_excerpt_metabox_nonce']) || 
            !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['primekit_addons_excerpt_metabox_nonce'])), basename(__FILE__))) {
            return $post_id;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        if ('post' == $_POST['post_type'] && !current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        $excerpt_content = isset($_POST['primekit_addons_excerpt_content']) ? sanitize_textarea_field($_POST['primekit_addons_excerpt_content']) : '';
        update_post_meta($post_id, 'primekit_addons_excerpt_content', $excerpt_content);
    }

    public function add_wc_product_meta_box() {
        add_meta_box(
            'primekit_wc_product_description',
            esc_html__('PrimeKit Product Description Tab', 'primekit-addons'),
            [$this, 'render_wc_product_meta_box'],
            'product',
            'advanced',
            'high'
        );
    }

    public function render_wc_product_meta_box($post) {
        wp_nonce_field('primekit_wc_product_description_nonce_action', 'primekit_wc_product_description_nonce');

        echo '<p><strong>' . esc_html__('Note:', 'primekit-addons') . '</strong> ' . esc_html__('This area is specifically for PrimeKit Addons and Templates for Elementor by ABCPlugin Products description tab contents.', 'primekit-addons') . '</p>';
        $content = get_post_meta($post->ID, '_primekit_wc_product_description', true);
        wp_editor(
            htmlspecialchars_decode($content),
            'primekit_wc_product_description_editor',
            [
                'textarea_name' => 'primekit_wc_product_description',
                'editor_height' => 200,
                'media_buttons' => true
            ]
        );
    }

    public function save_wc_product_meta_box($post_id) {
        if (!isset($_POST['primekit_wc_product_description_nonce']) || 
            !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['primekit_wc_product_description_nonce'])), 'primekit_wc_product_description_nonce_action')) {
            return $post_id;
        }

        if (array_key_exists('primekit_wc_product_description', $_POST)) {
            update_post_meta(
                $post_id,
                '_primekit_wc_product_description',
                wp_kses_post($_POST['primekit_wc_product_description'])
            );
        }
    }
}