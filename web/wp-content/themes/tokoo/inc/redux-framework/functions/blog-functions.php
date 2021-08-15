<?php
/**
 * Filter functions for Blog Section of Theme Options
 */

if ( ! function_exists( 'redux_apply_blog_page_view' ) ) {
	function redux_apply_blog_page_view( $blog_view ) {
		global $tokoo_options;

		if( isset( $tokoo_options['blog_view'] ) ) {
			$blog_view = $tokoo_options['blog_view'];
		}

		return $blog_view;
	}
}

if ( ! function_exists( 'redux_apply_blog_page_layout' ) ) {
	function redux_apply_blog_page_layout( $blog_layout ) {
		global $tokoo_options;

		if( isset( $tokoo_options['blog_layout'] ) ) {
			$blog_layout = $tokoo_options['blog_layout'];
		}

		return $blog_layout;
	}
}

if ( ! function_exists( 'redux_apply_single_post_layout' ) ) {
	function redux_apply_single_post_layout( $single_post_layout ) {
		global $tokoo_options;

		if( isset( $tokoo_options['single_post_layout'] ) ) {
			$single_post_layout = $tokoo_options['single_post_layout'];
		}

		return $single_post_layout;
	}
}

if ( ! function_exists( 'redux_toggle_post_icon_placeholder' ) ) {
	function redux_toggle_post_icon_placeholder( $enable ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['enable_post_icon_placeholder'] ) ) {
			$tokoo_options['enable_post_icon_placeholder'] = true;
		}

		if ( $tokoo_options['enable_post_icon_placeholder'] ) {
			$enable = true;
		} else {
			$enable = false;
		}
		
		return $enable;
	}
}

if ( ! function_exists( 'redux_toggle_author_info' ) ) {
	function redux_toggle_author_info( $enable ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['show_blog_post_author_info'] ) ) {
			$tokoo_options['show_blog_post_author_info'] = true;
		}

		if ( $tokoo_options['show_blog_post_author_info'] ) {
			$enable = true;
		} else {
			$enable = false;
		}
		
		return $enable;
	}
}
