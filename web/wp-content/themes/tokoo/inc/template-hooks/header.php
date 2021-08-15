<?php
/**
 * Template hooks for Headers
 */

add_action( 'tokoo_header_v1', 'tokoo_top_bar' );
add_action( 'tokoo_header_v1', 'tokoo_sticky_wrap_start' );
add_action( 'tokoo_header_v1', 'tokoo_masthead_v1' );
add_action( 'tokoo_header_v1', 'tokoo_sticky_wrap_end' );

add_action( 'tokoo_masthead_v1', 'tokoo_header_logo_area' );
add_action( 'tokoo_masthead_v1', 'tokoo_header_search' );
add_action( 'tokoo_masthead_v1', 'tokoo_header_icons' );

add_action( 'tokoo_header_logo_area', 'tokoo_header_logo' );
add_action( 'tokoo_header_logo_area', 'tokoo_departments_menu' );

add_action( 'tokoo_header_icons', 'tokoo_header_cart' );
add_action( 'tokoo_header_icons', 'tokoo_header_wishlist' );
add_action( 'tokoo_header_icons', 'tokoo_header_user_account' );

add_action( 'tokoo_header_v2', 'tokoo_sticky_wrap_start' );
add_action( 'tokoo_header_v2', 'tokoo_masthead_v2' );
add_action( 'tokoo_header_v2', 'tokoo_sticky_wrap_end' );
add_action( 'tokoo_header_v2', 'tokoo_primary_nav' );

add_action( 'tokoo_masthead_v2', 'tokoo_header_logo' );
add_action( 'tokoo_masthead_v2', 'tokoo_header_search' );
add_action( 'tokoo_masthead_v2', 'tokoo_header_v2_seconary_nav' );

add_action( 'tokoo_header_v3', 'tokoo_top_bar' );
add_action( 'tokoo_header_v3', 'tokoo_sticky_wrap_start' );
add_action( 'tokoo_header_v3', 'tokoo_masthead_v2' );
add_action( 'tokoo_header_v3', 'tokoo_sticky_wrap_end' );

add_action( 'tokoo_header_v4', 'tokoo_top_bar' );
add_action( 'tokoo_header_v4', 'tokoo_sticky_wrap_start' );
add_action( 'tokoo_header_v4', 'tokoo_masthead_v3' );
add_action( 'tokoo_header_v4', 'tokoo_sticky_wrap_end' );
add_action( 'tokoo_header_v4', 'tokoo_primary_nav' );

add_action( 'tokoo_masthead_v3', 'tokoo_header_logo' );
add_action( 'tokoo_masthead_v3', 'tokoo_header_search' );
add_action( 'tokoo_masthead_v3', 'tokoo_header_v2_seconary_nav' );


add_action( 'tokoo_after_header',      	  'tokoo_sticky_wrap_start',         5 );
add_action( 'tokoo_after_header', 		  'tokoo_header_handheld', 			10 );

add_action( 'tokoo_header_handheld',      'tokoo_off_canvas_nav', 			10 );
add_action( 'tokoo_header_handheld',      'tokoo_handheld_header_logo',     20 );
add_action( 'tokoo_header_handheld',      'tokoo_handheld_header_links',    30 );
add_action( 'tokoo_after_header',      	  'tokoo_sticky_wrap_end',          20 );