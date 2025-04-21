<?php
/**
 * Template Library Modal and Views
 * Library Templates Modal
 *
 * This file contains the JavaScript code for the template library modal.
 *
 * @package PrimeKit
 * @version 1.0.0
 */
defined('ABSPATH') || exit;
?>

<script type="text/template" id="tmpl-primekit-library-loading">
    <div class="primekit-loader-wrapper">
        <div class="primekit-loader">
            <div class="primekit-loader-boxes">
                <div class="primekit-loader-box"></div>
                <div class="primekit-loader-box"></div>
                <div class="primekit-loader-box"></div>
                <div class="primekit-loader-box"></div>
            </div>
        </div>
        <div class="primekit-loading-title"><?php esc_html_e('Loading', 'primekit'); ?></div>
    </div>
</script>

<script type="text/template" id="tmpl-primekit-library-templates">
    <div id="primekit-library-toolbar">
        <div id="primekit-library-toolbar-search">
            <input id="primekit-library-search" placeholder="<?php esc_attr_e('Search Templates', 'primekit'); ?>">
            <i class="eicon-search"></i>
        </div>
    </div>

    <div class="primekit-library-templates-window">
        <div id="primekit-library-templates-list"></div>
    </div>
</script>

<script type="text/template" id="tmpl-primekit-library-template">
    <div class="primekit-library-template">
        <img class="primekit-library-template-thumbnail" src="{{ thumbnail }}" alt="{{ title }}">
        <div class="primekit-library-template-footer">
            <span>{{ title }}</span>
            <button class="primekit-insert-template" data-template-id="{{ template_id }}">
                <?php esc_html_e('Insert', 'primekit'); ?>
            </button>
        </div>
    </div>
</script>

<script type="text/template" id="tmpl-primekit-library-empty">
    <div class="primekit-library-empty">
        <h3><?php esc_html_e('No Templates Found', 'primekit'); ?></h3>
    </div>
</script>
