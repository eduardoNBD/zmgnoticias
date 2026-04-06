<?php 
    $featured_img_url = get_the_post_thumbnail_url( $post->ID, 'full' );

    if ( ! $featured_img_url ) {
        $featured_img_url = zmg_get_default_image_url();
    }

    $author_id = get_the_author_meta('ID');
    $author_name = get_the_author_meta('display_name');
    $author_url = $author_id ? get_author_posts_url($author_id) : '';
    $publish_date = get_the_date();

    $prev_post = get_previous_post();
    $next_post = get_next_post();
?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-8">
            <div class="bg-white rounded p-6 shadow-md mb-6">
                <h1 class="text-2xl font-bold"><?php the_title(); ?></h1>
                <img src="<?=$featured_img_url ?>" alt="<?php the_title(); ?>" class="w-full h-auto mt-4">

                <!-- Meta info -->
                <div class="my-4 text-sm text-gray-600 flex justify-between">
                    <span class="italic">Publicado el <strong><?= esc_html($publish_date) ?></strong></span>
                    <span class="italic">Publicado por <?php if ($author_url) { ?><a href="<?= esc_url($author_url) ?>"><strong><?= esc_html($author_name) ?></strong></a><?php } else { ?><strong><?= esc_html($author_name) ?></strong><?php } ?></span>
                </div>
                
                <!-- Sección Compartir -->
                <div class="my-8">
                    <h3 class="text-2xl font-bold mb-4">Compartir</h3>
                    <div>
                        <div class="flex items-center">
                            <div class="h-1 bg-[#1259aa] w-[30%]"></div>
                            <div class="h-1 bg-[#c7c7c7] flex-grow"></div>
                        </div>
                    </div>
                    <div class="pt-4 flex flex-wrap gap-3">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?=get_permalink(); ?>" target="_blank" class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#1877F2" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                            <span class="text-blue-600">Facebook</span>
                        </a>
                        <!-- Twitter/X -->
                        <a href="https://twitter.com/intent/tweet?url=<?=get_permalink(); ?>&text=<?=get_the_title(); ?>" target="_blank" class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L3.001 22.98H.699l7.512-8.57L.699 4.499h6.544l4.95 6.562 1.785-2.03L18.244 2.25z"/></svg>
                            <span class="text-blue-500">Twitter</span>
                        </a>
                    </div>
                </div>

                <!-- Contenido del post -->
                <div class="prose max-w-none">
                    <?= apply_filters('the_content', $post->post_content) ?>
                </div>
            </div>
            <div class="flex flex-col md:flex-row">
                <!-- Post anterior -->
                <?php if ( $prev_post ) : ?>
                    <div class="w-full md:w-1/2 border-gray-300 border p-2 bg-white">
                        <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="flex gap-4 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                            <?php echo esc_html( $prev_post->post_title ); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Post siguiente -->
                <?php if ( $next_post ) : ?>
                    <div class="w-full md:w-1/2 border-gray-300 border p-2 bg-white">
                        <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="flex gap-4 items-center justify-end">
                            <?php echo esc_html( $next_post->post_title ); ?> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mt-12">
                <?php
                if ( comments_open() || get_comments_number() ) {
                    // Mostrar comentarios existentes
                    if ( have_comments() ) :
                        ?>
                        <div class="mt-8">
                            <h3 class="text-xl font-bold mb-4">
                                <?php echo get_comments_number(); ?> comentario<?php echo ( get_comments_number() > 1 ) ? 's' : ''; ?>
                            </h3>
                            <ol class="space-y-6">
                                <?php
                                wp_list_comments( array(
                                    'style'       => 'ol',
                                    'short_ping'  => true,
                                    'avatar_size' => 60,
                                    'callback'    => function( $comment, $args, $depth ) {
                                        $comment_class = ( '0' == $comment->comment_parent ? 'bg-gray-50 p-4 rounded' : 'ml-8 mt-4' );
                                        ?>
                                        <li id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment_class, $comment ); ?>>
                                            <div class="flex items-start gap-3">
                                                <?php echo get_avatar( $comment, 60 ); ?>
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-2">
                                                        <strong class="text-gray-900"><?php echo get_comment_author_link(); ?></strong>
                                                        <span class="text-sm text-gray-500"><?php echo get_comment_date(); ?></span>
                                                    </div>
                                                    <div class="mt-2 text-gray-700">
                                                        <?php comment_text(); ?>
                                                    </div>
                                                    <?php
                                                    comment_reply_link( array_merge( $args, array(
                                                        'depth' => $depth,
                                                        'max_depth' => $args['max_depth'],
                                                        'before' => '<div class="mt-2">',
                                                        'after' => '</div>',
                                                        'reply_text' => 'Responder'
                                                    ) ) );
                                                    ?>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                ) );
                                ?>
                            </ol>
                            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                                <nav class="mt-6">
                                    <div class="flex justify-between">
                                        <div><?php previous_comments_link( 'Comentarios anteriores' ); ?></div>
                                        <div><?php next_comments_link( 'Comentarios siguientes' ); ?></div>
                                    </div>
                                </nav>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- FORMULARIO NATIVO DE WORDPRESS CON TUS ESTILOS -->
                    <?php
                    $commenter = wp_get_current_commenter();
                    $fields = array(
                        'author' => '
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-700">Nombre *</label>
                                <input type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" required>
                            </div>',
                        'email' => '
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico *</label>
                                <input type="email" name="email" id="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" required>
                            </div>',
                    );

                    $args = array(
                        'title_reply' => '<h3 class="text-xl font-bold mb-4">DEJA UNA RESPUESTA</h3>',
                        'logged_in_as' => '<p class="text-sm text-gray-600 mb-4">Conectado como <strong>' . wp_get_current_user()->display_name . '</strong>. <a href="' . esc_url( get_edit_user_link() ) . '">Edita tu perfil.</a> <a href="' . wp_logout_url( get_permalink() ) . '">¿Salir?</a> Los campos obligatorios están marcados con *</p>',
                        'must_log_in' => '<p class="text-sm text-gray-600 mb-4">Debes <a href="' . wp_login_url( get_permalink() ) . '">iniciar sesión</a> para comentar.</p>',
                        'comment_field' => '
                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700">COMENTARIO *</label>
                                <textarea name="comment" id="comment" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" required></textarea>
                            </div>',
                        'fields' => $fields,
                        'class_submit' => 'bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded transition',
                        'label_submit' => 'Publicar el comentario',
                        'format' => 'html',
                    );

                    comment_form( $args );
                    ?>
                <?php } ?>
            </div>
        </div>
        <div class="col-span-12 md:col-span-4">
            <?php get_sidebar(); ?> 
        </div>
    </div>
</div>