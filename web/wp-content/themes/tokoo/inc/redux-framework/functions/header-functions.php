<?php
/**
 * Filter functions for Header Section of Theme Options
 */

if ( ! function_exists ( 'redux_toggle_top_bar' ) ) {
	function redux_toggle_top_bar( $enable ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['header_top_bar_show'] ) ) {
			$tokoo_options['header_top_bar_show'] = true;
		}

		if ( $tokoo_options['header_top_bar_show'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}	
}

if( ! function_exists( 'redux_toggle_logo_svg' ) ) {
	function redux_toggle_logo_svg() {
		global $tokoo_options;

		if( isset( $tokoo_options['logo_svg'] ) && $tokoo_options['logo_svg'] == '1' ) {
			$logo_svg = true;
		} else {
			$logo_svg = false;
		}

		return $logo_svg;
	}
}

if ( ! function_exists( 'redux_apply_header_style' ) ) {
	function redux_apply_header_style( $header_style ) {
		global $tokoo_options;

		if( isset( $tokoo_options['header_style'] ) ) {
			$header_style = $tokoo_options['header_style'];
		}

		return $header_style;
	}
}


if( ! function_exists( 'redux_toggle_sticky_header' ) ) {
	function redux_toggle_sticky_header() {
		global $tokoo_options;

		if( isset( $tokoo_options['sticky_header'] ) && $tokoo_options['sticky_header'] == '1' ) {
			$sticky_header = true;
		} else {
			$sticky_header = false;
		}

		return $sticky_header;
	}
}

if ( ! function_exists( 'redux_apply_departments_menu_icon' ) ) {
	function redux_apply_departments_menu_icon( $icon ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['header_departments_menu_icon'] ) ) {
			$tokoo_options['header_departments_menu_icon'] = esc_html__( 'flaticon-list', 'tokoo' );
		}

		return $tokoo_options['header_departments_menu_icon'];
	}
}

if ( ! function_exists( 'redux_apply_departments_menu_title' ) ) {
	function redux_apply_departments_menu_title( $title ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['header_departments_menu_title'] ) ) {
			$tokoo_options['header_departments_menu_title'] = esc_html__( 'Categories', 'tokoo' );
		}

		return $tokoo_options['header_departments_menu_title'];
	}
}


if ( ! function_exists( 'redux_apply_header_search_placeholder_text' ) ) {
	function redux_apply_header_search_placeholder_text( $placeholder ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['header_navbar_search_placeholder'] ) ) {
			$tokoo_options['header_navbar_search_placeholder'] = esc_html__( 'What are you looking for ?', 'tokoo' );
		}

		return $tokoo_options['header_navbar_search_placeholder'];
	}
}

if ( ! function_exists( 'redux_apply_header_cart_icon' ) ) {
	function redux_apply_header_cart_icon( $icon ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['header_cart_icon'] ) ) {
			$tokoo_options['header_cart_icon'] = 'ec ec-shopping-bag';
		}

		return $tokoo_options['header_cart_icon'];
	}
}

if ( ! function_exists( 'redux_toggle_header_cart_dropdown' ) ) {
	function redux_toggle_header_cart_dropdown( $enable ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['header_cart_dropdown_disable'] ) ) {
			$tokoo_options['header_cart_dropdown_disable'] = false;
		}

		if ( $tokoo_options['header_cart_dropdown_disable'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_header_user_account_menu' ) ) {
	function redux_apply_header_user_account_menu( $menu_ID ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['header_user_account_logged_in_menu'] ) ) {
			$tokoo_options['header_user_account_logged_in_menu'] = '0';
		}

		return $tokoo_options['header_user_account_logged_in_menu'];
	}
}

if ( ! function_exists( 'redux_toggle_header_user_account_enable' ) ) {
	function redux_toggle_header_user_account_enable( $enable ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options[ 'header_user_account_enable'] ) ) {
			$tokoo_options['header_user_account_enable'] = false;
		}

		if ( $tokoo_options['header_user_account_enable'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_header_user_account_icon' ) ) {
	function redux_apply_header_user_account_icon( $icon ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['header_user_account_icon'] ) ) {
			$tokoo_options['header_user_account_icon'] = 'ec ec-user';
		}

		return $tokoo_options['header_user_account_icon'];
	}
}


if ( ! function_exists ( 'redux_toggle_live_search' ) ) {
	function redux_toggle_live_search( $enable ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['header_live_search'] ) ) {
			$tokoo_options['header_live_search'] = true;
		}

		if ( $tokoo_options['header_live_search'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}	
}

if ( ! function_exists( 'redux_toggle_handheld_logo' ) ) {
	function redux_toggle_handheld_logo( $enable ) {
		global $tokoo_options;

		if( isset( $tokoo_options['show_handheld_logo'] ) && $tokoo_options['show_handheld_logo'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_handheld_logo' ) ) {
	function redux_apply_handheld_logo( $logo ) {
		global $tokoo_options;

		if ( ! empty( $tokoo_options['site_handheld_logo']['url'] ) ) {

			$logo_image_src = $tokoo_options['site_handheld_logo']['url'];
			if ( is_ssl() ) {
				$logo_image_src = str_replace( 'http:', 'https:', $logo_image_src );
			}
			
			ob_start();
			?>
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo-link" rel="home">
					<img src="<?php echo esc_url( $logo_image_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo esc_attr( $tokoo_options['site_handheld_logo']['width'] ); ?>" height="<?php echo esc_attr( $tokoo_options['site_handheld_logo']['height'] ); ?>" />
				</a>
			</div>
			<?php
			$logo = ob_get_clean();
		}

		return $logo;
	}
}