<?php

if ( ! function_exists( 'tokoo_jumbotron_element' ) ) {

	function tokoo_jumbotron_element( $atts, $content = null ){

		extract(shortcode_atts(array(
			'title'				=> '',
			'image'				=> '',
		), $atts));

		$args = array(
			'title'			=> $title,
			'image'			=> $image,
		);

		$html = '';
		if( function_exists( 'tokoo_jumbotron' ) ) {
			ob_start();
			tokoo_jumbotron( $args );
			$html = ob_get_clean();
		}

		return $html;
	}

}

add_shortcode( 'tokoo_jumbotron' , 'tokoo_jumbotron_element' );