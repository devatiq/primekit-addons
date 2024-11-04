<?php
/**
 * Render View file for Search Widget
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_placeholder_text = ! empty($primekit_settings['primekit_elementor_search_form_placeholder_text']) ? $primekit_settings['primekit_elementor_search_form_placeholder_text'] : esc_html__('Search...', 'primekit-addons');
$primekit_submit_button_text = ! empty($primekit_settings['primekit_elementor_search_form_btn_text']) ? $primekit_settings['primekit_elementor_search_form_btn_text'] : esc_html__('Search', 'primekit-addons');
?>

<!-- Search Form Area-->
<div class="primekit-ele-search-form-area">
    <div class="primekit-ele-search-form">

    <form method="get" class="primekit-ele-search" action="<?php echo esc_url(home_url('/')); ?>/">
            <input type="text" placeholder="<?php echo esc_attr($primekit_placeholder_text); ?>" value="<?php the_search_query(); ?>" name="s" class="s" />
            <input type="submit" class="searchsubmit" value="<?php echo esc_attr($primekit_submit_button_text); ?>" />
    </form>
      <div class="clearfix"></div>
    </div>
</div><!--/ Search Form Area-->

