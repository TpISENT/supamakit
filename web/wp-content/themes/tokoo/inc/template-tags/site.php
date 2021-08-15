<?php
/**
 * Template functions used across the site
 */

if ( ! function_exists( 'tokoo_container_div_open' ) ) {
	function tokoo_container_div_open() {
		?><div class="container">
		<?php
	}
}

if ( ! function_exists( 'tokoo_container_div_close' ) ) {
	function tokoo_container_div_close() {
		?>
		</div><!-- /.container -->
		<?php
	}
}
