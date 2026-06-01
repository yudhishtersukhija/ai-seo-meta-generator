<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

delete_option(
    'ai_seo_openai_api_key'
);