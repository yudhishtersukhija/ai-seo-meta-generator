jQuery(document).ready(function ($) {

    $('#generate-ai-seo').on('click', function () {

        const postID = $('#ai_seo_post_id').val();

        const security = $('#ai_seo_ajax_nonce').val();

        const postTitle = wp.data
            .select('core/editor')
            .getEditedPostAttribute('title');

        const button = $(this);

        button.text('Generating...');

        $.ajax({

            url: ajaxurl,

            type: 'POST',

            data: {
                action: 'ai_seo_generate_meta',
                post_id: postID,
                post_title: postTitle,
                security: security
            },

            success: function (response) {

                console.log(response);

                if (response.success) {

                    $('#ai_seo_title').val(
                        response.data.seo_title
                    );

                    $('#ai_seo_description').val(
                        response.data.seo_description
                    );
                } else {

                    alert('Generation failed');
                }

                button.text('Generate SEO Meta');
            },

            error: function (xhr, status, error) {

                console.log(error);

                alert('AJAX Error');

                button.text('Generate SEO Meta');
            }
        });
    });
});