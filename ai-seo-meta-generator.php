<?php
/**
 * Plugin Name: AI SEO Meta Generator
 * Plugin URI: https://github.com/yudhishtersukhija/ai-seo-meta-generator
 * Description: AI-powered SEO title and meta description generator for WordPress.
 * Version: 1.0.0
 * Author: Yudhishter Sukhija
 * Author URI: https://yudhishtersukhija.com
 * License: GPL2
 * Text Domain: ai-seo-meta-generator
 */

if (!defined('ABSPATH')) {
    exit;
}

define('AI_SEO_VERSION', '1.0.0');

require_once plugin_dir_path(__FILE__) . 'includes/class-meta-box.php';

require_once plugin_dir_path(__FILE__) . 'includes/class-ai-generator.php';

require_once plugin_dir_path(__FILE__) . 'includes/class-settings.php';

require_once plugin_dir_path(__FILE__) . 'includes/api/class-openai.php';

new AI_SEO_Meta_Box();

new AI_SEO_Settings();