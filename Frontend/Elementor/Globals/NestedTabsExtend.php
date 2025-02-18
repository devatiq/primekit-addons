<?php
namespace PrimeKit\Frontend\Elementor\Globals;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class NestedTabsExtend {

    public function __construct() {
        // Add extra text field to Nested Tabs
        add_action('elementor/element/nested-tabs/section_tabs/after_section_end', [$this, 'modify_tabs_controls'], 10, 2);
        
        // Hook into Elementor rendering and inject content properly
        add_filter('elementor/widget/render_content', [$this, 'inject_extra_content'], 10, 2);
    }

    /**
     * Modify Nested Tabs Control: Add Extra Text Field
     */
    public function modify_tabs_controls(Element_Base $element, $args) {
        if ($element->get_name() !== 'nested-tabs') {
            return;
        }

        $tabs_control = $element->get_controls('tabs');

        if (!empty($tabs_control['fields'])) {
            $tabs_control['fields'][] = [
                'name'        => 'extra_text',
                'label'       => __('Extra Content', 'primekit'),
                'type'        => Controls_Manager::WYSIWYG,
               // 'default'     => __('Additional content goes here...', 'primekit'),
            ];
            
            // Update the control with new fields
            $element->update_control('tabs', ['fields' => $tabs_control['fields']]);
        }
    }

    /**
     * Inject Extra Content **AFTER** Tab Titles Without Breaking the Markup
     */
    public function inject_extra_content($content, $widget) {
        if ($widget->get_name() !== 'nested-tabs') {
            return $content;
        }

        $settings = $widget->get_settings_for_display();
        if (!isset($settings['tabs']) || empty($settings['tabs'])) {
            return $content;
        }

        // Process each tab and inject extra content after its corresponding tab title
        foreach ($settings['tabs'] as $index => $tab) {
            if (!empty($tab['extra_text'])) {
                $extra_content = sprintf(
                    '<div class="elementor-tab-extra-content elementor-clearfix" data-tab-index="%d">%s</div>',
                    esc_attr($index),
                    wp_kses_post($tab['extra_text'])
                );

                // Find the corresponding tab button and properly insert content **AFTER** the button
                $button_id = sprintf('id="e-n-tab-title-%s"', esc_attr($widget->get_id_int() . ($index + 1)));

                // Properly insert the extra content without breaking the HTML structure
                $content = preg_replace(
                    '/(<button[^>]*' . preg_quote($button_id, '/') . '[^>]*>)(.*?)(<\/button>)/s',
                    '$1$2' . $extra_content . '$3',
                    $content
                );
            }
        }

        return $content;
    }
}