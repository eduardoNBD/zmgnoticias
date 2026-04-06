<div class="grid grid-cols-4">
    <?php foreach($postList as $post): ?>
        <div class="p-4 col-span-4 sm:col-span-2 md:col-span-1">
            <div class="relative h-full bg-white shadow-md rounded overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <?php
                    $featured_img_url = get_the_post_thumbnail_url( $post->ID, 'medium' );
                    if ( ! $featured_img_url ) {            
                        $featured_img_url = zmg_get_default_image_url(); // imagen por defecto
                    }
                ?>
                <a href="<?=get_permalink($post->ID) ?>">
                    <img class="w-full h-48 object-cover" src="<?php echo esc_url( $featured_img_url ); ?>" alt="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>">
                </a>
                <div class="p-4">
                    <div class="text-gray-500 text-xs text-center md:text-right">
                        Publicado hace <?php echo zmg_time_ago( get_the_date( 'Y-m-d H:i:s', $post->ID ) ); ?>
                    </div>  
                    <a href="<?=get_permalink($post->ID) ?>" class="block text-lg font  bold mb-2 hover:text-blue-600 transition-colors duration-300">
                        <?=esc_html( $post->post_title ) ?>
                    </a>
                    <p class="text-gray-600 text-sm mb-8">
                        <?php echo wp_trim_words( wp_strip_all_tags( $post->post_content ), 20, '...' ); ?>
                    </p>
                </div>
                <?php
                    $author_id = isset($post->post_author) ? (int) $post->post_author : 0;
                    $author_name = $author_id ? get_the_author_meta('display_name', $author_id) : '';
                    $author_url = $author_id ? get_author_posts_url($author_id) : '';
                ?>
                <?php if ($author_url && $author_name) : ?>
                    <div class="flex justify-end text-gray-500 text-xs absolute bottom-2 right-4">
                        <a class="hover:underline font-semibold" href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($author_name); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>