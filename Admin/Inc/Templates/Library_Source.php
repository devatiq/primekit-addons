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
    const API_TEMPLATES_INFO_URL = 'https://demo.primekitaddons.com/wp-json/primekit/v1/templates';
    const API_TEMPLATE_DATA_URL = 'https://api.primekit.com/wp-json/primekit/v1/templates/';
    const LOCAL_TEMPLATES_INFO_PATH = PRIMEKIT_TEMPLATE_PATH . 'data/templates-info.json';
    const LOCAL_TEMPLATE_DATA_PATH = PRIMEKIT_TEMPLATE_PATH . 'data/template-';

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
            // Read from local JSON file instead of API
            if (file_exists(self::LOCAL_TEMPLATES_INFO_PATH)) {
                $json_content = file_get_contents(self::LOCAL_TEMPLATES_INFO_PATH);
                $data = json_decode($json_content, true);

                if (!empty($data) && is_array($data)) {
                    update_option(self::LIBRARY_CACHE_KEY, $data, 'no');
                    return $data;
                }
            }

            update_option(self::LIBRARY_CACHE_KEY, []);
            return false;
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

        $template_file = self::LOCAL_TEMPLATE_DATA_PATH . $template_id . '.json';
        
        if (file_exists($template_file)) {
            return file_get_contents($template_file);
        }

        return false;
    }

    public function get_data(array $args, $context = 'display')
    {
        if (empty($args['template_id'])) {
            throw new \Exception(__('Template ID is required', 'primekit'));
        }

        $data = self::request_template_data($args['template_id']);

        if (!$data) {
            throw new \Exception(__('Template data not found', 'primekit'));
        }

        $data = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception(__('Invalid template data format', 'primekit'));
        }

        if (empty($data) || empty($data['content']) || !is_array($data['content'])) {
            throw new \Exception(__('Template does not have valid content structure', 'primekit'));
        }

        try {
            $data['content'] = $this->replace_elements_ids($data['content']);
            $data['content'] = $this->process_export_import_content($data['content'], 'on_import');

            $post_id = $args['editor_post_id'];
            $document = elementor()->documents->get($post_id);

            if ($document) {
                $data['content'] = $document->get_elements_raw_data($data['content'], true);
            }

            if ('display' === $context) {
                $data['content'] = $this->replace_elements_ids($data['content']);
            }

            return $data;
        } catch (\Exception $e) {
            throw new \Exception(__('Error processing template content: ', 'primekit') . $e->getMessage());
        }
    }
}
