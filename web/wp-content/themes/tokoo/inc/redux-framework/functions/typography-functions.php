<?php
/**
 * Filter functions for Typography Section of Theme Options
 */

if( ! function_exists( 'redux_has_google_fonts' ) ) {
	function redux_has_google_fonts( $load_default ) {
		global $tokoo_options;

		if( isset( $tokoo_options['use_predefined_font'] ) ) {
			$load_default = $tokoo_options['use_predefined_font'];
		}

		return $load_default;
	}
}

if( ! function_exists( 'redux_apply_custom_fonts' ) ) {
	function redux_apply_custom_fonts() {
		global $tokoo_options;

		if( isset( $tokoo_options['use_predefined_font'] ) && !$tokoo_options['use_predefined_font'] ) {
			$title_font 			= $tokoo_options['tokoo_title_font'];
			$content_font			= $tokoo_options['tokoo_content_font'];
			$title_font_family 		= $title_font['font-family'];
			$title_font_weight		= $title_font['font-weight'];
			$content_font_family	= $content_font['font-family'];
			?>
			<style type="text/css">

				h1, .h1,
				h2, .h2,
				h3, .h3,
				h4, .h4,
				h5, .h5,
				h6, .h6{
					font-family: <?php echo esc_html( $title_font_family );?> !important;
					font-weight: <?php echo esc_html( $title_font_weight );?> !important;
				}

				body {
					font-family: <?php echo esc_html( $content_font_family );?> !important;
				}

			</style>
			<?php
		}
	}
}