<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

get_header(); ?>

<main class="primekit-single-post">
    <div class="primekit-container">
        <?php
        // Check if the current post is built with Elementor
        if (\Elementor\Plugin::$instance->documents->get(get_the_ID())->is_built_with_elementor()) {
            // Display the Elementor content for the post
            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display(get_the_ID()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- \Elementor\Plugin::instance()->frontend->get_builder_content_for_display() Already escaped by elementor
        } else {
            the_content();
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>