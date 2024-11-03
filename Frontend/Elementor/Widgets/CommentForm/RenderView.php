<?php
/**
 * Render View file for ABC Comment Form.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();

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
