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
    const API_TEMPLATE_DATA_URL = 'https://demo.primekitaddons.com/wp-json/primekit/v1/json';
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
        $library_data = self::request_library_data();
    
        // Debug: Log retrieved data
        error_log("Library Data (before processing): " . print_r($library_data, true));
    
        if (empty($library_data) || !isset($library_data[0])) {
            error_log("No templates found in API data!");
            return [];
        }
    
        $templates = [];
        foreach ($library_data as $template_data) {
            if (!isset($template_data['id'])) {
                continue;
            }
            
            $templates[] = [
                'id'        => $template_data['id'],
                'title'     => $template_data['title'],
                'type'      => $template_data['type'],
                'thumbnail' => $template_data['thumbnail'],
                'date'      => $template_data['created_at'],
                'tags'      => $template_data['tags'] ?? [],
                'is_pro'    => $template_data['is_pro'] ?? 0,
                'url'       => $template_data['url'] ?? '',
            ];
        }
    
        // Debug: Log processed templates
        error_log("Processed Templates: " . print_r($templates, true));
    
        return $templates;
    }
    
    

    public function get_tags()
    {
        $library_data = self::request_library_data(); // Corrected function name
    
        return (!empty($library_data['tags']) ? $library_data['tags'] : []);
    }
    
    public function get_type_tags()
    {
        $library_data = self::request_library_data(); //  Corrected function name
    
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

        if (!empty($data) && !$force_update) {
            return $data;
        }

        // Make remote API request
        $response = wp_remote_get(self::API_TEMPLATES_INFO_URL);

        if (!is_wp_error($response) && 200 === wp_remote_retrieve_response_code($response)) {
            $data = json_decode(wp_remote_retrieve_body($response), true);

            if (!empty($data) && is_array($data)) {
                update_option(self::LIBRARY_CACHE_KEY, $data, 'no');
                return $data;
            }
        }

        // // Try loading from local file if remote request fails
        // if (file_exists(self::LOCAL_TEMPLATES_INFO_PATH)) {
        //     $json_content = file_get_contents(self::LOCAL_TEMPLATES_INFO_PATH);
        //     $data = json_decode($json_content, true);

        //     if (!empty($data) && is_array($data)) {
        //         update_option(self::LIBRARY_CACHE_KEY, $data, 'no');
        //         return $data;
        //     }
        // }

        update_option(self::LIBRARY_CACHE_KEY, []);
        return false;
    }


    public function get_item($template_id)
    {
        $templates = $this->get_items();

        return $templates[$template_id];
    }

    public static function request_template_data($template_id)
    {
        if (empty($template_id)) {
            error_log('PrimeKit Template API Error: Empty template ID');
            return false;
        }

        $api_url = self::API_TEMPLATE_DATA_URL . '/' . $template_id . '.json';
        
        $args = array(
            'timeout' => 30,
            'headers' => array(
                'Origin' => get_site_url(),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept'
            ),
            'sslverify' => false
        );
        
        error_log('PrimeKit Template API Request URL: ' . $api_url);
        
        // Remove the previous filter and add a new one for CORS headers
        remove_all_filters('http_request_args');
        add_filter('http_request_args', function($request_args, $url) use ($args) {
            $request_args['headers'] = array_merge($request_args['headers'], $args['headers']);
            return $request_args;
        }, 10, 2);
        
        $response = wp_remote_get($api_url, $args);

        if (is_wp_error($response)) {
            error_log('PrimeKit Template API Error: ' . $response->get_error_message());
            return false;
        }

        $response_code = wp_remote_retrieve_response_code($response);
        $response_headers = wp_remote_retrieve_headers($response);
        error_log('PrimeKit Template API Response Code: ' . $response_code);
        error_log('PrimeKit Template API Response Headers: ' . print_r($response_headers, true));

        if (200 !== $response_code) {
            error_log('PrimeKit Template API Error: Unexpected response code ' . $response_code);
            return false;
        }

        $body = wp_remote_retrieve_body($response);
        if (empty($body)) {
            error_log('PrimeKit Template API Error: Empty response body');
            return false;
        }

        // Validate JSON response
        $decoded_body = json_decode($body, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('PrimeKit Template API Error: Invalid JSON response - ' . json_last_error_msg());
            return false;
        }

        return $body;
    }

        // Commented out local file loading
        // $template_file = self::LOCAL_TEMPLATE_DATA_PATH . $template_id . '.json';
        
        // if (file_exists($template_file)) {
        //     return file_get_contents($template_file);
        // }
   

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

