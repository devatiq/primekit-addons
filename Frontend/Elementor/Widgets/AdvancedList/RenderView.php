<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Icons_Manager;

$settings = $this->get_settings_for_display();
$counter = 1;

if ($settings['primekit_advanced_list_items']) {
    echo '<ul class="primekit-feature-list-wrapper">';
    foreach ($settings['primekit_advanced_list_items'] as $item) {
        echo '<li class="primekit-list-item">';

        // Check if the icon is set and render it
        if ($item['list_assets_type'] == 'icon') {
            if (!empty($item['list_assets_icon'])) {
                echo '<div class="primekit-list-item-icon">';
                Icons_Manager::render_icon($item['list_assets_icon'], ['aria-hidden' => 'true']);
            }
        }
        //End icon rendering
        // Check if the image is set and render it
        if ($item['list_assets_type'] == 'image') {
            if (!empty($item['list_assets_img'])) {
                echo '<div class="primekit-list-item-img">';
                echo '<img src="' . $item['list_assets_img']['url'] . '">';
            }
        }
        //End image rendering
        // Check if the counter is set and render it
        if ($item['list_assets_type'] == 'counter') {
            if (!empty($item['list_assets_img'])) {
                echo '<div class="primekit-list-item-counter">';
                echo '<span>' . $counter . '</span>';
            }
        }
        //End counter rendering

        echo '</div>
                <div class="primekit-list-item-content">';
        if (!empty($item['list_title'])) {
            echo '<h4 class="primekit-list-title">' . $item['list_title'] . '</h4>';
        }

        if (!empty($item['list_sub_title'])) {
            echo '<p class="primekit-list-text">' . $item['list_sub_title'] . '</p>';
        }
        echo '</div>
        </li>';
        $counter++;
    }

    echo '</ul>';
}