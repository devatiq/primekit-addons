<?php
use Elementor\Plugin as ElementorPlugin;

get_header();
echo ElementorPlugin::instance()->frontend->get_builder_content_for_display(
    \PrimeKit\Admin\Inc\ThemeBuilder\ThemeBuilder::get_template_id('shop_archive')
);
get_footer();
