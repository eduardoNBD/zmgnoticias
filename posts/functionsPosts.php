<?php
/**
 * Template para mostrar entradas
 */
function get_ZMG_Theme_Post_Template($postTemplate) {  
    if(file_exists(ZMG_Theme_PATH . '/posts/templates/'.$postTemplate.'.php')){ 
        include ZMG_Theme_PATH . '/posts/templates/'.$postTemplate.'.php'; 
    } 
}

function get_ZMG_Theme_Post_Form($postTemplate) {  
    if(file_exists(ZMG_Theme_PATH . '/posts/search/'.$postTemplate.'.php')){ 
        include ZMG_Theme_PATH . '/posts/search/'.$postTemplate.'.php'; 
    } 
}

function get_ZMG_Theme_Posts_By_Category($categorySlug, $postsPerPage = 4) {
    $args = array(
        'category_name' => $categorySlug,
        'posts_per_page' => $postsPerPage,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    );
    
    $query = new WP_Query($args);
    $postList = $query->posts;

    include ZMG_Theme_PATH . '/posts/templates/gridPostCategory.php'; 
}

function get_ZMG_Theme_popular_post($postsPerPage = 4) {
    $args = array( 
        'posts_per_page' => $postsPerPage,
        'post_status' => 'publish',
        'meta_key' => 'post_views',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
    ); 

    $query = new WP_Query($args);
    $postList = $query->posts;

    include ZMG_Theme_PATH . '/posts/templates/gridPost.php'; 
}
function zmg_time_ago( $from = null ) {
    $now = new DateTime( current_time( 'mysql' ) );
    $ago = new DateTime( $from ? $from : get_the_date( 'Y-m-d H:i:s' ) );
    $diff = $now->diff( $ago );

    if ( $diff->y > 0 ) return $diff->y . ' año' . ( $diff->y > 1 ? 's' : '' );
    if ( $diff->m > 0 ) return $diff->m . ' mes' . ( $diff->m > 1 ? 'es' : '' );
    if ( $diff->d > 0 ) return $diff->d . ' día' . ( $diff->d > 1 ? 's' : '' );
    if ( $diff->h > 0 ) return $diff->h . ' hora' . ( $diff->h > 1 ? 's' : '' );
    if ( $diff->i > 0 ) return $diff->i . ' minuto' . ( $diff->i > 1 ? 's' : '' );
    return 'hace un momento';
}
