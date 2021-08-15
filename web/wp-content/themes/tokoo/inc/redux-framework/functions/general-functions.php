<?php
/**
 * Filter functions for General Section of Theme Options
 */

if( ! function_exists( 'redux_toggle_scrollup' ) ) {
	function redux_toggle_scrollup() {
		global $tokoo_options;

		if( isset( $tokoo_options['scrollup'] ) && $tokoo_options['scrollup'] == '1' ) {
			$scrollup = true;
		} else {
			$scrollup = false;
		}

		return $scrollup;
	}
}

if ( ! function_exists( 'redux_toggle_tokoo_child_style' ) ) {
	function redux_toggle_tokoo_child_style() {
		global $tokoo_options;

		if ( isset( $tokoo_options['load_child_theme'] ) && $tokoo_options['load_child_theme'] == '1' ) {
			$load = true;
		} else {
			$load = false;
		}

		return $load;
	}
}