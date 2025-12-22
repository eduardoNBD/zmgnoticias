<?php
/**
 * Template for displaying single standard posts
 *
 * @package ZMG_Theme
 */

get_header();

// For single posts, use the post template
require_once(ZMG_Theme_PATH . '/templates-pages/page-posts.php');

get_footer();