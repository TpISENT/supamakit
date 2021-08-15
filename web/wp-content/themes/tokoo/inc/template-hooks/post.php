<?php
/**
 * Hooks for Post
 */
add_action( 'tokoo_loop_before', 'tokoo_loop_wrap_open', 10 );
add_action( 'tokoo_loop_after', 'tokoo_loop_wrap_close', 10 );
add_action( 'tokoo_loop_after', 'tokoo_paging_nav', 20 );

add_action( 'tokoo_loop_post', 'tokoo_post_featured_image', 10 );
add_action( 'tokoo_loop_post', 'tokoo_post_header', 20 );

add_action( 'tokoo_post_header', 'tokoo_post_categories', 10 );
add_action( 'tokoo_post_header', 'tokoo_post_title', 20 );
add_action( 'tokoo_post_header', 'tokoo_post_meta', 30 );

/**
 * Sidebar
 */
add_action( 'tokoo_sidebar', 'tokoo_get_sidebar', 10 );