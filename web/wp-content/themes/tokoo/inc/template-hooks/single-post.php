<?php
/**
 * Template Hooks for single post
 */

add_action( 'tokoo_single_post', 'tokoo_single_post_featured_image', 20 );
add_action( 'tokoo_single_post', 'tokoo_single_post_header', 30 );
add_action( 'tokoo_single_post', 'tokoo_post_content', 50 );

add_action( 'tokoo_single_post_header', 'tokoo_post_categories', 10 );
add_action( 'tokoo_single_post_header', 'tokoo_single_post_title', 20 );
add_action( 'tokoo_single_post_header', 'tokoo_post_meta', 30 );

add_action( 'tokoo_single_post_bottom', 'tokoo_post_nav', 10 );
add_action( 'tokoo_single_post_bottom', 'tokoo_post_footer', 20 );
add_action( 'tokoo_single_post_bottom', 'tokoo_display_comments', 30 );

add_action( 'tokoo_single_post_after', 'tokoo_related_posts', 10 );

add_filter( 'comment_form_fields', 'tokoo_move_comment_field_to_bottom' );