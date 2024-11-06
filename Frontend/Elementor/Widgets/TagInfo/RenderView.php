<?php
/**
 * Render View file for Post Tags Info.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

?>

<!-- Post Tags Area-->
<div class="primekit-ele-post-tag-area">
    <div class="primekit-ele-post-tag">
    
    <?php the_tags( '<ul><li>', '</li><li>', '</li></ul>' ); ?>
      
    </div>
</div><!--/ Post Tags Area-->
