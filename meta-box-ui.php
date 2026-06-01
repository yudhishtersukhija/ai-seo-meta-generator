<p>
    <label for="ai_seo_title">
        <strong>SEO Title</strong>
    </label>
</p>

<input
    type="text"
    id="ai_seo_title"
    name="ai_seo_title"
    value="<?php echo esc_attr($seo_title); ?>"
    style="width:100%;"
>

<br><br>

<p>
    <label for="ai_seo_description">
        <strong>Meta Description</strong>
    </label>
</p>

<textarea
    id="ai_seo_description"
    name="ai_seo_description"
    rows="5"
    style="width:100%;"
><?php echo esc_textarea($seo_description); ?></textarea>

<input
    type="hidden"
    id="ai_seo_post_id"
    value="<?php echo esc_attr($post->ID); ?>"
>

<input
    type="hidden"
    id="ai_seo_ajax_nonce"
    value="<?php echo wp_create_nonce('ai_seo_ajax_nonce'); ?>"
>

<br><br>

<button
    type="button"
    class="button button-primary"
    id="generate-ai-seo"
>
    Generate SEO Meta
</button>