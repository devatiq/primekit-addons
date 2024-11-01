<?php
/**
 * Render View file for ABC Blog Grid.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

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
$primekit_blog_layout = $this->get_settings('primekit_elementor_blog_grid_layout');

switch ($primekit_blog_layout) {
    case 'two-column':
        include( primekit_Path . '/includes/widgets/ABCBlogGrid/template/two-column.php' );
        break;
    case 'three-column':
        include( primekit_Path . '/includes/widgets/ABCBlogGrid/template/three-column.php' );
        break;
    case 'four-column':
        include( primekit_Path . '/includes/widgets/ABCBlogGrid/template/four-column.php' );
        break;
    default:
    include( primekit_Path . '/includes/widgets/ABCBlogGrid/template/three-column.php' );
        break;
}
?>
    </div>
</div><!--/ PrimeKit Blog grid Area-->