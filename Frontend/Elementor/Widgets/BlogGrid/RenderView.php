<?php
/**
 * Render View file for PrimeKit Blog Grid.
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_number_of_posts = $this->get_settings('primekit_elementor_blog_grid_post_number')['size'];

$primekit_img_switch = $primekit_settings['primekit_elementor_blog_grid_img_switch'];
$primekit_date_switch = $primekit_settings['primekit_elementor_blog_grid_date_switch'];
$primekit_comment_switch = $primekit_settings['primekit_elementor_blog_grid_comment_switch'];
$primekit_excerpt_switch = $primekit_settings['primekit_elementor_blog_grid_excerpt_switch'];
$primekit_read_more_switch = $primekit_settings['primekit_elementor_blog_grid_read_more_switch'];
$primekit_pagination_switch = $primekit_settings['primekit_elementor_blog_grid_pagination'];
$primekit_grid_read_more_text = $primekit_settings['primekit_elementor_blog_grid_read_more_text'];
$primekit_selected_category = $primekit_settings['primekit_elementor_blog_grid_category'];
$primekit_excerpt_length_grid = $primekit_settings['primekit_elementor_blog_grid_excerpt_length'];

?>
<!-- Blog grid Area-->
<div class="primekit-ele-blog-grid-area">
    <div class="primekit-ele-blog-grid">
        <?php
        // Get the selected blog layout
//$primekit_blog_layout = $this->get_settings('primekit_elementor_blog_grid_layout');
        
        include(PRIMEKIT_PATH . 'Frontend/Elementor/Widgets/BlogGrid/template/four-column.php');

        // switch ($primekit_blog_layout) {
//     case 'two-column':
//         include( PRIMEKIT_PATH . 'Frontend/Elementor/Widgets/BlogGrid/template/two-column.php' );
//         break;
//     case 'three-column':
//         include( PRIMEKIT_PATH . 'Frontend/Elementor/Widgets/BlogGrid/template/three-column.php' );
//         break;
//     case 'four-column':
//         include( PRIMEKIT_PATH . 'Frontend/Elementor/Widgets/BlogGrid/template/four-column.php' );
//         break;
//     default:
//     include( PRIMEKIT_PATH . 'Frontend/Elementor/Widgets/BlogGrid/template/three-column.php' );
//         break;
// }
        ?>
    </div>
</div><!--/ PrimeKit Blog grid Area-->