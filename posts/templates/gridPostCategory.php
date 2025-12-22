<div class="grid grid-cols-4">
    <?php foreach($postList as $post): ?>
        <div class="p-4 col-span-4 sm:col-span-2 md:col-span-1">
            <div class="h-full bg-white shadow-md rounded overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <?php
                    $featured_img_url = get_the_post_thumbnail_url( $post->ID, 'medium' );
                    if ( ! $featured_img_url ) {            
                        $featured_img_url = get_template_directory_uri() . '/img/default-thumbnail.jpg'; // imagen por defecto
                    }
                ?>
                <a href="<?=get_permalink($post->ID) ?>">
                    <img class="w-full h-48 object-cover" src="<?php echo esc_url( $featured_img_url ); ?>" alt="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>">
                </a>
                <div class="p-4">
                    <a href="<?=get_permalink($post->ID) ?>" class="block text-lg font  bold mb-2 hover:text-blue-600 transition-colors duration-300">
                        <?=esc_html( $post->post_title ) ?>
                    </a>
                    <p class="text-gray-600 text-sm">
                        <?php echo wp_trim_words( wp_strip_all_tags( $post->post_content ), 20, '...' ); ?>
                    </p>
                    <div class="mt-4 text-gray-500 text-xs">
                        Publicado <?php echo zmg_time_ago( get_the_date( 'Y-m-d H:i:s', $post->ID ) ); ?> atrás
                    </div>  
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>