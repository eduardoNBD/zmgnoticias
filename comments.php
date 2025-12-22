<?php
/**
 * The template for displaying comments
 *
 * @package ZMG_Theme
 */

    if (post_password_required()) {
        return;
    }
?>

<div id="comments" class="comments-area">
    
    <?php if (have_comments()) : ?>
        <h2 class="comments-title text-2xl font-bold text-gray-800 mb-6">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                printf(
                    /* translators: %s: post title */
                    esc_html__('Un comentario en &ldquo;%s&rdquo;', 'ZMG_Theme'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: number of comments, 2: post title */
                    esc_html(_nx(
                        '%1$s comentario en &ldquo;%2$s&rdquo;',
                        '%1$s comentarios en &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'ZMG_Theme'
                    )),
                    number_format_i18n($comments_number),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list list-none p-0">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'callback' => 'ZMG_Theme_comment',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => __('Comentarios anteriores', 'ZMG_Theme'),
            'next_text' => __('Comentarios siguientes', 'ZMG_Theme'),
        ));
        ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments text-gray-600 text-center py-4">
            <?php _e('Los comentarios están cerrados.', 'ZMG_Theme'); ?>
        </p>
    <?php endif; ?>

    <?php
        $comment_form_args = array(
            'title_reply' => __('Deja un comentario', 'ZMG_Theme'),
            'title_reply_to' => __('Deja un comentario a %s', 'ZMG_Theme'),
            'cancel_reply_link' => __('Cancelar respuesta', 'ZMG_Theme'),
            'label_submit' => __('Enviar comentario', 'ZMG_Theme'),
            'comment_field' => '<p class="comment-form-comment mb-4">
                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">' . __('Comentario', 'ZMG_Theme') . ' <span class="required text-red-500">*</span></label>
                <textarea id="comment" name="comment" cols="45" rows="8" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
            </p>',
            'fields' => array(
                'author' => '<p class="comment-form-author mb-4">
                    <label for="author" class="block text-sm font-medium text-gray-700 mb-2">' . __('Nombre', 'ZMG_Theme') . ' <span class="required text-red-500">*</span></label>
                    <input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required />
                </p>',
                'email' => '<p class="comment-form-email mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">' . __('Email', 'ZMG_Theme') . ' <span class="required text-red-500">*</span></label>
                    <input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required />
                </p>',
                'url' => '<p class="comment-form-url mb-4">
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-2">' . __('Sitio web', 'ZMG_Theme') . '</label>
                    <input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </p>',
            ),
            'class_form' => 'comment-form bg-gray-50 p-6 rounded-lg',
            'class_submit' => 'submit bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200',
        );

        comment_form($comment_form_args);
    ?>

</div><!-- #comments -->
