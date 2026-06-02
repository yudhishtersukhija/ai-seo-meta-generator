<?php

if (!defined('ABSPATH')) {
    exit;
}

class AI_SEO_Meta_Box {

    public function __construct() {

        add_action('add_meta_boxes', [$this, 'register_meta_box']);

        add_action('save_post', [$this, 'save_meta_data']);

        add_action(
            'wp_ajax_ai_seo_generate_meta',
            [$this, 'generate_ai_meta']
        );

        add_action(
            'admin_enqueue_scripts',
           [$this, 'enqueue_admin_assets']
        );
    }

    /**
     * Register custom meta box
     */
    public function register_meta_box() {

        add_meta_box(
            'ai_seo_meta_generator',
            'AI SEO Meta Generator',
            [$this, 'render_meta_box'],
            'post',
            'normal',
            'high'
        );
    }

    /**
     * Render meta box UI
     */
    public function render_meta_box($post) {

        $seo_title = get_post_meta($post->ID, '_ai_seo_title', true);

        $seo_description = get_post_meta($post->ID, '_ai_seo_description', true);

        wp_nonce_field('ai_seo_meta_nonce_action', 'ai_seo_meta_nonce');

        require plugin_dir_path(__FILE__) . '../admin/views/meta-box-ui.php';
    }

    /**
     * Save meta box data
     */
    public function save_meta_data($post_id) {

        // Verify nonce
        if (
            !isset($_POST['ai_seo_meta_nonce']) ||
            !wp_verify_nonce(
                $_POST['ai_seo_meta_nonce'],
                'ai_seo_meta_nonce_action'
            )
        ) {
            return;
        }

        // Prevent autosave overwrite
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Save SEO title
        if (isset($_POST['ai_seo_title'])) {

            update_post_meta(
                $post_id,
                '_ai_seo_title',
                sanitize_text_field($_POST['ai_seo_title'])
            );
        }

        // Save SEO description
        if (isset($_POST['ai_seo_description'])) {

            update_post_meta(
                $post_id,
                '_ai_seo_description',
                sanitize_textarea_field($_POST['ai_seo_description'])
            );
        }
    }

    public function enqueue_admin_assets() {

    wp_enqueue_script(
        'ai-seo-admin-js',
        plugin_dir_url(__FILE__) . '../assets/js/admin.js',
        ['jquery'],
        AI_SEO_VERSION,
        true
    );
}

 public function generate_ai_meta() {

    check_ajax_referer(
        'ai_seo_ajax_nonce',
        'security'
    );

    $post_title = sanitize_text_field(
        $_POST['post_title']
    );

    $generated_data = AI_SEO_Generator::generate_meta(
        $post_title
    );

    if (!$generated_data) {

        wp_send_json_error([
            'message' => 'Generation failed.'
        ]);
    }

    wp_send_json_success($generated_data);
}
}