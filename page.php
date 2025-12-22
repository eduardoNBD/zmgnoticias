<?php
/**
 * The template for displaying all pages
 *
 * @package ZMG_Theme
 */

get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Contenido principal -->
        <main class="main-content flex-1">
            
            <?php while (have_posts()) : the_post(); ?>
                <article id="page-<?php the_ID(); ?>" <?php post_class('page-content bg-white rounded-lg shadow-md overflow-hidden'); ?>>
                    
                    <!-- Header de la página -->
                    <header class="page-header p-6 border-b border-gray-200">
                        <h1 class="page-title text-3xl font-bold text-gray-800 mb-4">
                            <?php the_title(); ?>
                        </h1>
                        
                        <!-- Meta de la página -->
                        <div class="page-meta text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <time datetime="<?php echo get_the_date('c'); ?>">
                                    <?php _e('Última actualización:', 'ZMG_Theme'); ?> <?php echo get_the_modified_date(); ?>
                                </time>
                            </div>
                        </div>
                    </header>

                    <!-- Contenido de la página -->
                    <div class="page-content-body p-6">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links text-sm text-gray-600 mt-6 pt-6 border-t border-gray-200">',
                            'after' => '</div>',
                            'link_before' => '<span class="page-link bg-gray-100 px-3 py-1 rounded mr-2 hover:bg-gray-200">',
                            'link_after' => '</span>',
                        ));
                        ?>
                    </div>

                    <!-- Footer de la página -->
                    <footer class="page-footer p-6 border-t border-gray-200 bg-gray-50">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            
                            <!-- Información de la página -->
                            <div class="page-info text-sm text-gray-500">
                                <p>
                                    <?php _e('Página creada el', 'ZMG_Theme'); ?> 
                                    <time datetime="<?php echo get_the_date('c'); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                </p>
                            </div>

                            <!-- Enlaces de navegación -->
                            <div class="page-navigation">
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <?php _e('Volver al inicio', 'ZMG_Theme'); ?>
                                </a>
                            </div>

                        </div>
                    </footer>

                </article>

                <!-- Comentarios (si están habilitados) -->
                <?php
                if (comments_open() || get_comments_number()) :
                    ?>
                    <div class="comments-section mt-8">
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <?php comments_template(); ?>
                        </div>
                    </div>
                    <?php
                endif;
                ?>

            <?php endwhile; ?>

        </main>

        <!-- Sidebar -->
        <aside class="sidebar w-full lg:w-80">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<?php get_footer(); ?>
