<?php
/**
 * The main template file
 *
 * @package ZMG_Theme
 */

get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">

        <!-- Contenido principal -->
        <main class="main-content flex-1">

            <?php if (have_posts()) : ?>

                <!-- Header del blog -->
                <header class="page-header mb-8">
                    <?php if (is_home() && !is_front_page()) : ?>
                        <h1 class="page-title text-3xl font-bold text-gray-800 mb-4">
                            <?php single_post_title(); ?>
                        </h1>
                    <?php endif; ?>
                </header>

                <!-- Loop de posts -->
                <div class="posts-grid grid gap-8">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300'); ?>>

                            <!-- Imagen destacada -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>" class="block">
                                        <?php the_post_thumbnail('large', array('class' => 'w-full h-48 object-cover')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="post-content p-6">

                                <!-- Meta del post -->
                                <div class="post-meta text-sm text-gray-500 mb-3">
                                    <span class="post-date">
                                        <time datetime="<?php echo get_the_date('c'); ?>">
                                            <?php echo get_the_date(); ?>
                                        </time>
                                    </span>
                                    <span class="mx-2">•</span>
                                    <span class="post-author">
                                        <?php _e('Por', 'ZMG_Theme'); ?>
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="text-blue-600 hover:text-blue-800">
                                            <?php the_author(); ?>
                                        </a>
                                    </span>
                                    <?php if (has_category()) : ?>
                                        <span class="mx-2">•</span>
                                        <span class="post-categories">
                                            <?php the_category(', '); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Título del post -->
                                <h2 class="post-title text-xl font-semibold text-gray-800 mb-3">
                                    <a href="<?php the_permalink(); ?>" class="text-gray-800 hover:text-blue-600 transition-colors duration-200">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <!-- Excerpt -->
                                <div class="post-excerpt text-gray-600 mb-4">
                                    <?php the_excerpt(); ?>
                                </div>

                                <!-- Enlace de leer más -->
                                <div class="post-more">
                                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                                        <?php _e('Leer más', 'ZMG_Theme'); ?>
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Paginación -->
                <div class="pagination-wrapper mt-12">
                    <?php ZMG_Theme_pagination(); ?>
                </div>

            <?php else : ?>

                <!-- No hay posts -->
                <div class="no-posts text-center py-12">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                        <?php _e('No se encontraron publicaciones', 'ZMG_Theme'); ?>
                    </h2>
                    <p class="text-gray-600 mb-6">
                        <?php _e('Parece que no hay nada aquí. ¡Intenta buscar algo diferente!', 'ZMG_Theme'); ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                        <?php _e('Volver al inicio', 'ZMG_Theme'); ?>
                    </a>
                </div>

            <?php endif; ?>

        </main>

        <!-- Sidebar -->
        <aside class="sidebar w-full lg:w-80">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<?php get_footer(); ?>