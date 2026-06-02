<?php

if (!defined('ABSPATH')) {
    exit;
}

class AI_SEO_Generator {

    public static function generate_meta(
        $post_title
    ) {

        if (empty($post_title)) {
            return false;
        }

        return AI_SEO_OpenAI::generate_meta(
            $post_title
        );
    }
}