<?php
/**
 * Render View file for Search Icon Widget
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_placeholder_text = ! empty($primekit_settings['primekit_elementor_search_icon_placeholder_text']) ? $primekit_settings['primekit_elementor_search_icon_placeholder_text'] : esc_html__('Search...', 'primekit-addons');
?>

<!-- Search Icon Area-->
<div class="primekit-ele-search-icon-area">
    <div class="primekit-ele-search-icon">
    <form method="get" class="primekit-ele-search-icon" action="<?php echo esc_url(home_url('/')); ?>/">
    <div class="primekit-search-icon-container">
        <span class="primekit-search-icon"><svg clip-rule="evenodd" fill-rule="evenodd" height="512" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg" id="fi_5636698"><g id="Icon"><g><path d="m10 3.5c-3.587 0-6.5 2.913-6.5 6.5s2.913 6.5 6.5 6.5 6.5-2.913 6.5-6.5-2.913-6.5-6.5-6.5zm0 1c3.036 0 5.5 2.464 5.5 5.5s-2.464 5.5-5.5 5.5-5.5-2.464-5.5-5.5 2.464-5.5 5.5-5.5z"></path><path d="m20.354 19.646-5.759-5.758c-.195-.195-.512-.195-.707 0s-.195.512 0 .707l5.758 5.759c.196.195.512.195.708 0 .195-.196.195-.512 0-.708z"></path></g></g></svg></span>
        <input type="text" placeholder="<?php echo esc_attr($primekit_placeholder_text); ?>" value="<?php the_search_query(); ?>" name="s" class="s" />
    </div>
</form>
    </div>
</div><!--/ Search Icon Area-->
