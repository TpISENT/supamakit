<?php
/**
 * Template Hooks for homepage
 */

add_action( 'tokoo_before_about', 'tokoo_configure_about_hooks' );
add_action( 'tokoo_about', 'tokoo_about_header' );
add_action( 'tokoo_about', 'tokoo_about_content_1' );
add_action( 'tokoo_about', 'tokoo_about_features_list' );
add_action( 'tokoo_about', 'tokoo_about_content_2' );
add_action( 'tokoo_about', 'tokoo_about_testimonial' );
add_action( 'tokoo_about', 'tokoo_about_job_section' );
