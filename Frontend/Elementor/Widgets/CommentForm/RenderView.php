<?php
/**
 * Render View file for Comment Form.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
add_filter('comments_template', 'primekit_custom_comments_template', 99);

if (!function_exists('primekit_custom_comments_template')) {
    function primekit_custom_comments_template($theme_template) {
        if (is_singular() && (comments_open() || get_comments_number())) {
            $plugin_template = PRIMEKIT_ELEMENTOR_PATH . 'Widgets/CommentForm/Templates/comment-form.php';
            if (file_exists($plugin_template)) {
                return $plugin_template;
            }
        }
        return $theme_template;
    }
}

?>

<!-- Comment Form Area-->
<div class="primekit-ele-comment-form-area">
    <div class="primekit-ele-comment-form">
    
    <?php 
if ( comments_open() || get_comments_number() ) {
    comments_template();
}
?>
    </div>
</div><!--/ Comment Form Area-->
