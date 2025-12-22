 
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        $featured_img_url = get_the_post_thumbnail_url( $post->ID, 'medium' );
                        if ( ! $featured_img_url ) {
                            $featured_img_url = get_template_directory_uri() . '/img/default.jpg';
                        }
                        ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url( $featured_img_url ); ?>" alt="<?php the_title(); ?>" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-red-600"><?php the_title(); ?></a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                    <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                                </p>
                                <div class="text-xs text-gray-500">
                                    Por: <?php the_author(); ?> | <?php echo get_the_date('d \d\e F \d\e Y'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                else : ?>
                    <p class="col-span-2 text-center text-gray-600">No se encontraron publicaciones.</p>
                <?php endif;
                ?>
            </div>

<!-- Paginación -->
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div class="mt-8 flex justify-center w-full">
    <nav class="inline-flex space-x-2">
        <?php
        $links = paginate_links( array(
            'current' => max( 1, get_query_var('paged') ),
            'total'   => $wp_query->max_num_pages,
            'prev_text' => 'Anterior',
            'next_text' => 'Siguientes',
            'type'      => 'array', // Devuelve array en lugar de HTML
            'mid_size'  => 1,
            'end_size'  => 1,
        ) );

        if ( is_array( $links ) ) {
            foreach ( $links as $link ) {
                echo $link; // Ya incluye tags <a> o <span>
            }
        }
        ?>
    </nav>
</div>

<style>
.page-numbers {
    display: inline-flex;
    padding: 0.5rem 1rem;
    margin: 0 0.25rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    transition: all 0.2s;
    text-decoration: none;
    align-items: center;
    justify-content: center;
    background-color: #FFF;
    color: #111827;
    border: 1px solid #d1d5db;
}
.page-numbers.current {
    background-color: #eb2f21;
    color: white;
    font-weight: bold;
    border-color: #eb2f21;
}
.page-numbers:hover:not(.dots) {
    background-color: #eb2f21;
    color: white;
    border-color: #eb2f21;
}
.page-numbers.dots {
    background-color: transparent;
    color: #6b7280;
    pointer-events: none;
    border: none;
    padding: 0.5rem 0.25rem;
}
</style>
<?php endif; ?>
        </div>
        <div class="col-span-12 md:col-span-4">
            <?php get_sidebar(); ?> 
        </div>
    </div>
</div>
 