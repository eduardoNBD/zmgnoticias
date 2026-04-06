<?php
/**
 * Tailwind Theme functions and definitions
 *
 * @package ZMG_Theme
 */
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes del tema
define('ZMG_Theme_VERSION', '1.0.0');
define('ZMG_Theme_PATH', get_template_directory());
define('ZMG_Theme_URL', get_template_directory_uri());

/**
 * Configuración del tema
 */
function ZMG_Theme_setup() {
    // Soporte para idiomas
    load_theme_textdomain('zmg-theme', get_template_directory() . '/languages');

    // Soporte para características del tema
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');

    // Registrar menús
    register_nav_menus(array(
        'primary-menu' => __('Menú Principal', 'zmg-theme'),
        'footer' => __('Menú Footer', 'zmg-theme'),
    ));
}
add_action('after_setup_theme', 'ZMG_Theme_setup');

/**
 * Enqueue scripts
 */
function ZMG_Theme_scripts() {
    // Scripts personalizados
    $scrtps = [
        '/assets/js/utils.js',
        '/assets/js/theme.js',
    ];

    $styles = [
        '/assets/css/global.css'
    ];

    foreach ($styles as $key => $style) {
        $filepath = ZMG_Theme_PATH . $style;

        if (file_exists($filepath)) {
            $mod_time = filemtime($filepath);  
            wp_enqueue_style('zmg-theme-style-' . $key, ZMG_Theme_URL . $style, [], $mod_time);
        }
    }

    foreach ($scrtps as $key => $script) {
        $filepath = ZMG_Theme_PATH . $script;

        if (file_exists($filepath)) {
            $mod_time = filemtime($filepath);  
            wp_enqueue_script('zmg-theme-script-' . $key, ZMG_Theme_URL . $script, [], $mod_time, true);
        }
    }
}

add_action('wp_enqueue_scripts', 'ZMG_Theme_scripts', 1);

/**
 * Registrar áreas de widgets
 */
function ZMG_Theme_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar Principal', 'zmg-theme'),
        'id' => 'sidebar-1',
        'description' => __('Widgets que aparecen en la sidebar principal.', 'zmg-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title text-xl font-semibold mb-4 text-gray-800">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Widgets', 'zmg-theme'),
        'id' => 'footer-widgets',
        'description' => __('Widgets que aparecen en el footer.', 'zmg-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s text-white">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title text-lg font-semibold mb-4">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'ZMG_Theme_widgets_init');

/**
 * Agregar opción de imagenes al personalizador
 */
function ZMG_Theme_customize_register($wp_customize) {
    // Sección para imagenes
    $wp_customize->add_section('zmg_images_section', array(
        'title'    => __('Imagenes', 'zmg-theme'),
        'priority' => 30,
    )); 

    // Sección para gelerias
    $wp_customize->add_section('zmg_galleries_section', array(
        'title'    => __('Galerias', 'zmg-theme'),
        'priority' => 29,
    )); 
}

add_action('customize_register', 'ZMG_Theme_customize_register');

/**
 * Personalizar el excerpt
 */
function ZMG_Theme_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'ZMG_Theme_excerpt_length');

function ZMG_Theme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ZMG_Theme_excerpt_more');

/**
 * Calcular tiempo de lectura estimado
 */
function ZMG_Theme_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 palabras por minuto
    return $reading_time;
}
 

/**
 * Personalizar el formulario de búsqueda
 */
function ZMG_Theme_search_form($form) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">
        <div class="flex">
            <label for="search-field" class="sr-only">' . __('Buscar:', 'zmg-theme') . '</label>
            <input type="search" id="search-field" class="search-field flex-1 px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="' . esc_attr_x('Buscar...', 'placeholder', 'zmg-theme') . '" value="' . get_search_query() . '" name="s" />
            <button type="submit" class="search-submit bg-blue-600 text-white px-6 py-2 rounded-r-md hover:bg-blue-700 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <span class="sr-only">' . __('Buscar', 'zmg-theme') . '</span>
            </button>
        </div>
    </form>';
    return $form;
}

add_filter('get_search_form', 'ZMG_Theme_search_form');
 
/**
 * Función simple para mostrar el logo personalizado
 * 
 * @param array $args Argumentos de personalización
 * @return string HTML del logo
 */
function ZMG_Theme_logo($args = array()) {
    $defaults = array(
        'class' => 'site-logo w-[250px] md:w-[300px]', // Cambia h-18 por h-28 o más
        'link_class' => 'logo-link hover:opacity-80 transition-opacity duration-200 block',
        'show_title' => true,
        'show_description' => false,
        'title_class' => 'site-title text-4xl font-bold text-gray-800', // Más grande
        'description_class' => 'site-description text-sm text-gray-600 ml-4 hidden md:block',
        'wrapper_class' => 'site-branding block md:flex items-center', // Asegura que ocupe todo el ancho
        'size' => 'medium', // Usa el tamaño completo del logo subido
    );
    
    $args = wp_parse_args($args, $defaults);
    
    $output = '<div class="' . esc_attr($args['wrapper_class']) . '">';
    
    // Enlace del logo
    $output .= '<a href="' . esc_url(home_url('/')) . '" rel="home" class="' . esc_attr($args['link_class']) . '">';
    
    // Logo personalizado o por defecto
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image($custom_logo_id, $args['size'], false, array(
            'class' => esc_attr($args['class']),
            'alt' => get_bloginfo('name'),
        ));
        $output .= $logo;
    } else {
        // Logo de texto
        $output .= '<h1 class="' . esc_attr($args['title_class']) . '">';
        $output .= esc_html(get_bloginfo('name'));
        $output .= '</h1>';
    }
    
    $output .= '</a>';
    
    // Descripción del sitio (opcional)
    if ($args['show_description']) {
        $description = get_bloginfo('description', 'display');
        if ($description || is_customize_preview()) {
            $output .= '<p class="' . esc_attr($args['description_class']) . '">';
            $output .= esc_html($description);
            $output .= '</p>';
        }
    }
    
    $output .= '</div>';
    
    return $output;
}


/**
 * Función simple para mostrar iconos de redes sociales
 * 
 * @param array $args Argumentos de personalización
 * @return string HTML de los iconos
 */
function ZMG_Theme_social_icons($args = array()) {
    $defaults = array(
        'wrapper_class' => 'social-icons flex justify-center md:justify-end space-x-2',
        'icon_class' => 'social-icon w-10 h-10 rounded-full flex items-center justify-center text-white transition-all duration-200 hover:scale-110',
        'show_facebook' => true,
        'show_twitter' => true,
        'show_instagram' => true,
        'show_tiktok' => true,
        'show_youtube' => true,
        'facebook_url' => 'https://www.facebook.com/DirmedalMx',
        'twitter_url' => 'https://x.com/dirmedal?t=TE9nrAYUGWo-du58IVQwug&s=09',
        'instagram_url' => 'https://www.instagram.com/dirmedalmexico?igsh=MW0xYWRnZ2h2OTNqOQ==',
        'tiktok_url' => 'https://www.tiktok.com/@dirmedal.mexico',
        'youtube_url' => 'https://youtube.com/@dirmedal?si=ikVSXJU173rQZpqP',
    );
    
    $args = wp_parse_args($args, $defaults);
     

    $output = '<div class="' . esc_attr($args['wrapper_class']) . '">';
    
    // Facebook
    if ($args['show_facebook']) {
        $output .= '<a href="' . esc_url($args['facebook_url']) . '" target="_blank" rel="noopener" class="' . esc_attr($args['icon_class']) . ' bg-blue-600 hover:bg-blue-700" title="Facebook">';
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">';
        $output .= '<path d="M18 2a1 1 0 0 1 .993 .883l.007 .117v4a1 1 0 0 1 -.883 .993l-.117 .007h-3v1h3a1 1 0 0 1 .991 1.131l-.02 .112l-1 4a1 1 0 0 1 -.858 .75l-.113 .007h-2v6a1 1 0 0 1 -.883 .993l-.117 .007h-4a1 1 0 0 1 -.993 -.883l-.007 -.117v-6h-2a1 1 0 0 1 -.993 -.883l-.007 -.117v-4a1 1 0 0 1 .883 -.993l.117 -.007h2v-1a6 6 0 0 1 5.775 -5.996l.225 -.004h3z"/>';
        $output .= '</svg>';
        $output .= '</a>';
    }
    
    // Twitter/X
    if ($args['show_twitter']) {
        $output .= '<a href="' . esc_url($args['twitter_url']) . '" target="_blank" rel="noopener" class="' . esc_attr($args['icon_class']) . ' bg-black hover:bg-gray-800" title="X (Twitter)">';
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">';
        $output .= '<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>';
        $output .= '</svg>';
        $output .= '</a>';
    }
    
    // Instagram
    if ($args['show_instagram']) {
        $output .= '<a href="' . esc_url($args['instagram_url']) . '" target="_blank" rel="noopener" class="' . esc_attr($args['icon_class']) . ' bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600" title="Instagram">';
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">';
        $output .= '<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>';
        $output .= '</svg>';
        $output .= '</a>';
    }
    
    // TikTok
    if ($args['show_tiktok']) {
        $output .= '<a href="' . esc_url($args['tiktok_url']) . '" target="_blank" rel="noopener" class="' . esc_attr($args['icon_class']) . ' bg-black hover:bg-gray-800" title="TikTok">';
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">';
        $output .= '<path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>';
        $output .= '</svg>';
        $output .= '</a>';
    }
    
    // YouTube
    if ($args['show_youtube']) {
        $output .= '<a href="' . esc_url($args['youtube_url']) . '" target="_blank" rel="noopener" class="' . esc_attr($args['icon_class']) . ' bg-red-600 hover:bg-red-700" title="YouTube">';
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">';
        $output .= '<path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>';
        $output .= '</svg>';
        $output .= '</a>';
    }
    
    $output .= '</div>';
    
    return $output;
}

/**
 * Cargar CSS minificado en todos los sitios
 */
function ZMG_Theme_load_minified_css() {
    $minified_css_path = ZMG_Theme_URL . '/dist/css/build.css'; 
   
    //$version = filemtime($minified_css_path) ? : ZMG_Theme_VERSION;
    $version = date('YmdHi'); // Usar la fecha y hora actual para evitar caché durante el desarrollo
    wp_enqueue_style('zmg-theme-minified', $minified_css_path, array(), $version);
     
}

/**
 * Hook para cargar CSS minificado
 */
add_action('wp_enqueue_scripts', 'ZMG_Theme_load_minified_css', 5);

/**
 * Cargar CSS de Tailwind en el admin de WordPress solo en pantallas de edición
 */
function ZMG_Theme_load_admin_css($hook) {
    // Solo cargar en pantallas de edición/creación de posts
    // post.php = editar post existente
    // post-new.php = crear nuevo post
    if ($hook !== 'post.php' && $hook !== 'post-new.php') {
        return;
    }
    
    $minified_css_path = ZMG_Theme_URL . '/dist/css/build.css'; 
    $version = date('YmdHi'); // Usar la fecha y hora actual para evitar caché durante el desarrollo
    wp_enqueue_style('zmg-theme-admin-tailwind', $minified_css_path, array(), $version);
}

add_action('admin_enqueue_scripts', 'ZMG_Theme_load_admin_css');

/**
 * Cargar scripts específicos para usuarios logueados
 */
function ZMG_Theme_load_user_scripts() {
    if (is_user_logged_in()) {
        wp_enqueue_script('zmg-user-menu', ZMG_Theme_URL . '/assets/js/user-menu.js', array('jquery'), ZMG_Theme_VERSION, true);
    }
}

// Contar vistas
function zmg_set_post_views($postID) {
    $count_key = 'post_views';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Mostrar vistas
function zmg_get_post_views($postID) {
    $count_key = 'post_views';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        return "0";
    }
    return $count;
}

// Hook para contar vistas cuando se ve un post
function zmg_track_post_views($post_id) {
    if (is_single() && !is_admin()) {
        zmg_set_post_views($post_id);
    }
}

add_action('wp_head', function() {
    if (is_single()) {
        global $post;
        if ($post) {
            zmg_set_post_views($post->ID);
        }
    }
});

/**
 * Enqueue scripts específicos para plantillas personalizadas
 */
function ZMG_Theme_enqueue_page_scripts() {
    global $wp;

    $posts_page_id = get_option('page_for_posts');
    $posts_page_url = '';

    if ($posts_page_id) {
        // Si hay una página específica configurada
        $posts_page_url = get_permalink($posts_page_id);
    } else {
        // Si no hay página específica, usar el archivo de posts por defecto
        $posts_page_url = get_post_type_archive_link('post');
    }
    // Verificar si estamos en página de posts o categoría
    $current_url = home_url(add_query_arg(array(), $wp->request));
    $isPostPage = $current_url."/" == str_replace('index.php/','',$posts_page_url);

    // Detectar página de categoría correctamente
    $isCategoryPage = is_category(); // Detecta cualquier página de categoría
    $isTaxonomyPage = is_tax('category'); // Detecta página de taxonomía categoría
    $isSearch = is_search('posts');
    $queried_types = get_query_var('post_type');
     
    if ($isPostPage || $isCategoryPage || $isSearch) {
        // Registrar y encolar scripts específicos para posts
        wp_enqueue_script(
            'page-posts-js',
            get_template_directory_uri() . '/assets/js/pages/page-posts.js',
            array('jquery'),
            date('YmdHi'),
            true
        ); 
    }

    if(is_front_page()){
        wp_enqueue_script(
            'front-page-js',
            get_template_directory_uri() . '/assets/js/pages/front-page.js',
            array('jquery'),
            date('YmdHi'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'ZMG_Theme_enqueue_page_scripts');


/**
 * Enqueue scripts específicos para posts
 */
function ZMG_Theme_enqueue_post_scripts() {
    global $wp;

    if ( is_singular('post') ) {

        wp_enqueue_style(
            'page-posts-css',
            get_template_directory_uri() . '/assets/css/post_content.css',
            array(),
            date('YmdHi'),
        );
    }
}

add_action('wp_enqueue_scripts', 'ZMG_Theme_enqueue_post_scripts');

require_once ZMG_Theme_PATH . '/templates-pages/init.php';
require_once ZMG_Theme_PATH . '/functions/menuFunctions.php';
require_once ZMG_Theme_PATH . '/partials/functionsPartials.php'; 
require_once ZMG_Theme_PATH . '/posts/functionsPosts.php';
require_once ZMG_Theme_PATH . '/functions/widgets.php';

//Load Modules
$modules = glob(ZMG_Theme_PATH . '/modules/*/init.php');
if ($modules) {
    foreach ($modules as $module) {
        require_once $module;
    }
}

/**
 * Obtener la URL del logo del sitio para usar como fallback
 * 
 * @return string URL del logo o imagen por defecto
 */
function zmg_get_logo_url() {
    // Verificar si hay un logo personalizado configurado
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
        if ($logo_url) {
            return $logo_url;
        }
    }
    
    // Fallback a imagen por defecto si no hay logo personalizado
    return get_template_directory_uri() . '/img/default-hero.jpg';
}

/**
 * Obtener la URL de la imagen por defecto (default.webp)
 * 
 * @return string URL de la imagen default.webp
 */
function zmg_get_default_image_url() {
    return get_template_directory_uri() . '/assets/img/default.webp';
}