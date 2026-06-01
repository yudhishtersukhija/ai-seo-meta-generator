<?php

if (!defined('ABSPATH')) {
    exit;
}

class AI_SEO_OpenAI {

    public static function generate_meta($title) {

        $api_key = get_option(
            'ai_seo_openai_api_key'
        );

        if (empty($api_key)) {

            return false;
        }

        /*
         * Future OpenAI request goes here.
         */

        return [
            'seo_title' =>
                'AI SEO: ' . $title,

            'seo_description' =>
                'Generated using OpenAI placeholder.',
        ];
    }
}