<?php
/**
 * Library API class for PrimeKit Addons
 *
 * @package PrimeKit
 */

namespace PrimeKit\Admin\Inc\Templates;

use Elementor\TemplateLibrary\Source_Base;

defined('ABSPATH') || die();

class Library_Source extends Source_Base
{
    const LIBRARY_CACHE_KEY = 'primekit_library_cache';
    const API_TEMPLATES_INFO_URL = 'https://templates.happyaddons.com/wp-json/ha/v2/templates-info'; // Replace later
    const API_TEMPLATE_DATA_URL = 'https://templates.happyaddons.com/wp-json/ha/v1/templates/'; // Replace later

    public function get_id()
    {
        return 'primekit-library';
    }

    public function get_title()
    {
        return __('PrimeKit Library', 'primekit');
    }

    public function register_data()
    {
    }

    public function save_item($template_data)
    {
        return new \WP_Error('invalid_request', __('Cannot save template to PrimeKit Library', 'primekit'));
    }

    public function update_item($new_data)
    {
        return new \WP_Error('invalid_request', __('Cannot update template in PrimeKit Library', 'primekit'));
    }

    public function delete_template($template_id)
    {
        return new \WP_Error('invalid_request', __('Cannot delete template from PrimeKit Library', 'primekit'));
    }

    public function export_template($template_id)
    {
        return new \WP_Error('invalid_request', __('Cannot export template from PrimeKit Library', 'primekit'));
    }

    public function get_items($args = [])
    {
        $library_data = self::get_library_data();
        $templates = [];

        if (!empty($library_data['templates'])) {
            foreach ($library_data['templates'] as $template_data) {
                $templates[] = $this->prepare_template($template_data);
            }
        }

        return $templates;
    }

    public function get_tags()
    {
        $library_data = self::get_library_data();

        return (!empty($library_data['tags']) ? $library_data['tags'] : []);
    }

    public function get_type_tags()
    {
        $library_data = self::get_library_data();

        return (!empty($library_data['type_tags']) ? $library_data['type_tags'] : []);
    }

    private function prepare_template(array $template_data)
    {
        return [
            'template_id' => $template_data['id'],
            'title'       => $template_data['title'],
            'type'        => $template_data['type'],
            'thumbnail'   => $template_data['thumbnail'],
            'date'        => $template_data['created_at'],
            'tags'        => $template_data['tags'],
            'isPro'       => $template_data['is_pro'],
            'url'         => $template_data['url'],
        ];
    }

    private static function request_library_data($force_update = false)
    {
        $data = get_option(self::LIBRARY_CACHE_KEY);

        if ($force_update || false === $data || empty($data)) {
            $timeout = ($force_update) ? 25 : 8;

            $response = wp_remote_get(self::API_TEMPLATES_INFO_URL, [
                'timeout' => $timeout,
            ]);

            if (is_wp_error($response) || 200 !== (int) wp_remote_retrieve_response_code($response)) {
                update_option(self::LIBRARY_CACHE_KEY, []);
                return false;
            }

            $data = json_decode(wp_remote_retrieve_body($response), true);

            if (empty($data) || !is_array($data)) {
                update_option(self::LIBRARY_CACHE_KEY, []);
                return false;
            }

            update_option(self::LIBRARY_CACHE_KEY, $data, 'no');
        }

        return $data;
    }

    public static function get_library_data($force_update = false)
    {
        self::request_library_data($force_update);

        $data = get_option(self::LIBRARY_CACHE_KEY);

        if (empty($data)) {
            return [];
        }

        return $data;
    }

    public function get_item($template_id)
    {
        $templates = $this->get_items();

        return $templates[$template_id];
    }

    public static function request_template_data($template_id)
    {
        if (empty($template_id)) {
            return;
        }

        $body = [
            'home_url' => trailingslashit(home_url()),
            'version'  => PRIMEKIT_VERSION,
        ];

        $response = wp_remote_get(
            self::API_TEMPLATE_DATA_URL . $template_id,
            [
                'body'    => $body,
                'timeout' => 25,
            ]
        );

        return wp_remote_retrieve_body($response);
    }

    public function get_data(array $args, $context = 'display')
    {
        $data = self::request_template_data($args['template_id']);

        $data = json_decode($data, true);

        if (empty($data) || empty($data['content'])) {
            throw new \Exception(__('Template does not have any content', 'primekit'));
        }

        $data['content'] = $this->replace_elements_ids($data['content']);
        $data['content'] = $this->process_export_import_content($data['content'], 'on_import');

        $post_id = $args['editor_post_id'];
        $document = elementor()->documents->get($post_id);

        if ($document) {
            $data['content'] = $document->get_elements_raw_data($data['content'], true);
        }

        return $data;
    }
}
