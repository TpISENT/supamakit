<?php
/**
 * Template Hooks for Pages
 */

add_action( 'tokoo_page', 'tokoo_page_header',  10 );
add_action( 'tokoo_page', 'tokoo_page_content', 20 );
add_action( 'tokoo_page_after', 'tokoo_display_comments', 10 );
add_filter( 'tokoo_show_breadcrumb',   'tokoo_toggle_breadcrumb',   10 );

add_filter( 'tokoo_show_page_header', 'tokoo_toggle_page_header', 10 );