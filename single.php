<?php
/**
 * Template for displaying single posts
 *
 * @package ZMG_Theme
 */

get_header();

// For single posts, use the post template
require_once(ZMG_Theme_PATH . '/templates-pages/page-post.php');

get_footer(); 
