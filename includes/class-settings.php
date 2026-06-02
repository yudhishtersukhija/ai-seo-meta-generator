<?php

if (!defined('ABSPATH')) {
    exit;
}

class AI_SEO_Settings {

    public function __construct() {

        add_action(
            'admin_menu',
            [$this, 'add_settings_page']
        );

        add_action(
            'admin_init',
            [$this, 'register_settings']
        );
    }

    public function add_settings_page() {

        add_options_page(
            'AI SEO Meta Generator',
            'AI SEO Meta Generator',
            'manage_options',
            'ai-seo-settings',
            [$this, 'render_settings_page']
        );
    }

    public function register_settings() {

        register_setting(
            'ai_seo_settings_group',
            'ai_seo_openai_api_key'
        );
    }

    public function render_settings_page() {

        ?>
        <div class="wrap">
            <h1>AI SEO Meta Generator Settings</h1>

            <form method="post" action="options.php">

                <?php
                settings_fields(
                    'ai_seo_settings_group'
                );

                do_settings_sections(
                    'ai_seo_settings_group'
                );
                ?>

                <table class="form-table">

                    <tr>
                        <th>
                            OpenAI API Key
                        </th>

                        <td>

                            <input
                                type="password"
                                name="ai_seo_openai_api_key"
                                value="<?php echo esc_attr(
                                    get_option(
                                        'ai_seo_openai_api_key'
                                    )
                                ); ?>"
                                class="regular-text"
                            >

                        </td>
                    </tr>

                </table>

                <?php submit_button(); ?>

            </form>
        </div>
        <?php
    }
}