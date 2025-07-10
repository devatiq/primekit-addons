<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
use Elementor\Icons_Manager;
$settings = $this->get_settings_for_display();

$count = 1;
if (!empty($settings['primekit_advanced_list_items'])) {
    echo '<ul class="primekit-advanced-list-wrapper">';
    foreach ($settings['primekit_advanced_list_items'] as $item) {

        echo '<li class="primekit-advanced-list-item">';

        $anchor_url = isset($item['list_item_url']['url']) ? $item['list_item_url']['url'] : '';
        // Check if the item has a URL
        if (!empty($anchor_url)) {
            $target = !empty($item['list_item_url']['is_external']) ? ' target="_blank"' : '';
            $nofollow = !empty($item['list_item_url']['nofollow']) ? ' rel="nofollow"' : '';
            echo '<a href="' . esc_url($item['list_item_url']['url']) . '" class="primekit-advanced-list-item-link"' . $target . $nofollow . '>';
        }

        // Icon
        if ($item['list_assets_type'] == 'icon' && !empty($item['list_assets_icon'])) {
            echo '<div class="primekit-advanced-list-item-icon">';
            Icons_Manager::render_icon($item['list_assets_icon'], ['aria-hidden' => 'true']);
            echo '</div>';
        }
        // Image
        if ($item['list_assets_type'] == 'image' && !empty($item['list_assets_img']['url'])) {
            echo '<div class="primekit-advanced-list-item-img">';
            echo '<img src="' . esc_url($item['list_assets_img']['url']) . '" alt="">';
            echo '</div>';
        }
        // Count
        if ($item['list_assets_type'] == 'count') {
            echo '<div class="primekit-advanced-list-item-count">';
            echo '<span>' . esc_html($count) . '</span>';
            echo '</div>';
        }
        echo '<div class="primekit-advanced-list-item-content">';
        if (!empty($item['list_title'])) {
            echo '<h4 class="primekit-advanced-list-title">' . esc_html($item['list_title']) . '</h4>';
        }
        if (!empty($item['list_sub_title'])) {
            echo '<p class="primekit-advanced-list-text">' . esc_html($item['list_sub_title']) . '</p>';
        }
        echo '</div>';
        if (!empty($anchor_url)) {
            echo '</a>';
        }
        echo '</li>';
        $count++;
    }
    echo '</ul>';
}