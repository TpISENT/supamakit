<?php
/**
 * Template functions used in Widgets
 */

if ( ! function_exists( 'tokoo_modify_widget_pages_args' ) ) {
	function tokoo_modify_widget_pages_args( $args, $instance ) {
		require_once get_template_directory() . '/inc/classes/class-tokoo-walker-page.php';
		$args['walker'] = new Tokoo_Walker_Page();
		return $args;
	}
}

if ( ! function_exists( 'tokoo_modify_widget_categories_args' ) ) {
	function tokoo_modify_widget_categories_args( $args, $instance ) {
		require_once get_template_directory() . '/inc/classes/class-tokoo-walker-category.php';
		$args['walker'] = new Tokoo_Walker_Category();
		return $args;
	}
}
