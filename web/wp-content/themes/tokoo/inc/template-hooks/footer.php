<?php
/**
 * Template Hooks used in Footer
 */

add_action( 'tokoo_footer_v1', 'tokoo_footer_features_list' );
add_action( 'tokoo_footer_v1', 'tokoo_footer_v1_content' );
add_action( 'tokoo_footer_v1', 'tokoo_footer_bottom_bar' );


add_action( 'tokoo_footer_v2', 'tokoo_footer_features_list' );
add_action( 'tokoo_footer_v2', 'tokoo_footer_v2_content' );
add_action( 'tokoo_footer_v2_content', 'tokoo_footer_widgets' );
add_action( 'tokoo_footer_v2', 'tokoo_footer_bottom_bar' );

add_action( 'tokoo_footer_v1_content', 'tokoo_footer_logo_and_social' );
add_action( 'tokoo_footer_v1_content', 'tokoo_footer_widgets' );