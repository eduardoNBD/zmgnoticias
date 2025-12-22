<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package ZMG_Theme
 */

get_header(); ?>

<div class="container mx-auto px-4 py-16">
    <div class="max-w-6xl mx-auto text-center"> 

        <!-- Título 404 -->
        <h1 class="error-title text-6xl font-bold text-gray-800 mb-4">
            404
        </h1>
        
        <h2 class="error-subtitle text-2xl font-semibold text-gray-600 mb-6">
            <?php _e('Página no encontrada', 'ZMG_Theme'); ?>
        </h2>

        <!-- Descripción -->
        <p class="error-description text-lg text-gray-600 mb-8">
            <?php _e('Lo sentimos, la página que estás buscando no existe o ha sido movida.', 'ZMG_Theme'); ?>
        </p>

        <!-- Acciones -->
        <div class="error-actions space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
            
            <!-- Botón de inicio -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center px-6 py-3 bg-[#09357A] text-white font-semibold rounded-lg hover:bg-[#125FBA] transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <?php _e('Volver al inicio', 'ZMG_Theme'); ?>
            </a>

            <!-- Botón de búsqueda -->
            <a href="#search" class="inline-flex items-center px-6 py-3 border-2 border-[#09357A] text-[#09357A] font-semibold rounded-lg hover:bg-[#09357A] hover:text-white transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <?php _e('Buscar', 'ZMG_Theme'); ?>
            </a>

        </div>

        <!-- Formulario de búsqueda -->
        <div id="search" class="search-form-wrapper mt-12"> 
            <div class="max-w-7xl mx-auto mt-4">
                <?php get_ZMG_Theme_Post_Form('homeSearchForm'); ?>
            </div>
        </div>  
    </div>
</div>

<?php get_footer(); ?>
