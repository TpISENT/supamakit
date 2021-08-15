<?php
/**
 * Template functions used in Header
 */
if ( ! function_exists( 'tokoo_get_header' ) ) {
	function tokoo_get_header( $header = '' ) {
		$header_style = apply_filters( 'tokoo_header_style', 'v1' );

		if ( ! empty( $header ) ) {
			$header_style = $header;
		}

		get_header( $header_style );
	}
}

if ( ! function_exists( 'tokoo_top_bar' ) ) {
	function tokoo_top_bar() {
		if ( apply_filters( 'tokoo_enable_top_bar', true ) ) :

			$topbar_left = wp_nav_menu(
				array(
					'theme_location' => 'top-bar-left',
					'container'      => false,
					'depth'          => 2,
					'menu_class'     => 'top-bar-nav top-bar-left',
					'fallback_cb'    => false,
					'echo'           => false,

				)
			);

			$topbar_right = wp_nav_menu(
				array(
					'theme_location' => 'top-bar-right',
					'container'      => false,
					'depth'          => 2,
					'menu_class'     => 'top-bar-nav top-bar-right',
					'fallback_cb'    => false,
					'echo'           => false,
				)
			);

			?>
		<div class="top-bar">
			<div class="container">
				<div class="top-bar-inner"><?php echo wp_kses_post( $topbar_left . $topbar_right ); ?></div>
			</div>
		</div>
			<?php
		endif;
	}
}

if ( ! function_exists( 'tokoo_masthead_v1' ) ) {
	function tokoo_masthead_v1() {
		?>
		<div class="masthead masthead-v1">
			<div class="container">
				<div class="masthead-inner">
				<?php do_action( 'tokoo_masthead_v1' ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_masthead_v2' ) ) {
	function tokoo_masthead_v2() {
		?>
		<div class="masthead masthead-v2">
			<div class="container">
				<div class="masthead-inner">
				<?php do_action( 'tokoo_masthead_v2' ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_masthead_v3' ) ) {
	function tokoo_masthead_v3() {
		?>
		<div class="masthead masthead-v3">
			<div class="container">
				<div class="masthead-inner">
				<?php do_action( 'tokoo_masthead_v3' ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_header_logo_area' ) ) {
	function tokoo_header_logo_area() {
		?>
		<div class="header-logo-area">
			<div class="header-logo-area-inner">
			<?php
			do_action( 'tokoo_header_logo_area' );
			?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_header_logo' ) ) {
	/**
	 * Displays theme logo
	 */
	function tokoo_header_logo() {
		?>
		<div class="site-branding">
		<?php
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			the_custom_logo();
		} elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} elseif ( apply_filters( 'tokoo_site_logo_svg', true ) ) {
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="header-logo-link" rel="home">';
			tokoo_get_svg_logo();
			echo '</a>';
		} else {
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="header-logo-link" rel="home">';
			?>
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<?php if ( '' != get_bloginfo( 'description' ) ) : ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php
				endif;
				echo '</a>';
		}
		?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_get_svg_logo' ) ) {
	/**
	 * Gets logo-svg.php template
	 */
	function tokoo_get_svg_logo() {
		tokoo_get_template( 'global/logo-svg.php' );
	}
}

if ( ! function_exists( 'tokoo_departments_menu' ) ) {
	function tokoo_departments_menu() {

		$menu_location = 'departments-menu';
		$menu_link     = apply_filters( 'tokoo_departments_menu_link', function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) );
		$menu_title    = apply_filters( 'tokoo_departments_menu_title', esc_html__( 'Categories', 'tokoo' ) );
		$menu_icon     = '';
		$menu_title    = $menu_title . '<i class="departments-menu-icon ' . esc_attr( $menu_icon ) . '"></i>';

		?>
		<div class="departments-menu">
			<div class="dropdown">
				<a href="<?php echo esc_url( $menu_link ); ?>" class="departments-menu-title">
					<i class="departments-menu-icon <?php echo esc_attr( apply_filters( 'tokoo_departments_menu_icon', 'flaticon-list' ) ); ?>"></i>
					<span><?php echo wp_kses_post( $menu_title ); ?></span>
				</a>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => $menu_location,
							'container'      => false,
							'menu_class'     => 'dropdown-menu yamm',
							'fallback_cb'    => 'tokoo_departments_menu_fallback',
						)
					);
				?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_departments_menu_fallback' ) ) {
	function tokoo_departments_menu_fallback() {
		if ( tokoo_is_woocommerce_activated() ) {

			$departments_menu = $departments_menu = '<ul class="sub-menu">' . '<li class="all-categories"><a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">' . esc_html__( 'All Categories', 'tokoo' ) . '</a>' . wp_list_categories(
				array(
					'title_li'   => false,
					'echo'       => false,
					'taxonomy'   => 'product_cat',
					'hide_empty' => false,
				)
			) . '</ul>';

		} else {
			$departments_menu = '<ul class="sub-menu">' . wp_list_categories(
				array(
					'title_li' => false,
					'echo'     => false,
				)
			) . '</ul>';
		}

		echo wp_kses_post( $departments_menu );
	}
}

if ( ! function_exists( 'tokoo_header_search' ) ) {
	function tokoo_header_search() {
		?>
		<div class="header-search">
		<?php
		if ( tokoo_is_woocommerce_activated() ) {
			the_widget( 'WC_Widget_Product_Search', 'title=' );
		} else {
			the_widget( 'WP_Widget_Search', 'title=' );
		}
		?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_header_icons' ) ) {
	function tokoo_header_icons() {
		ob_start();
		do_action( 'tokoo_header_icons' );
		$header_icons = ob_get_clean();

		if ( ! empty( $header_icons ) ) :

			?>
		<div class="header-icons">
			<?php
			echo wp_kses_post( $header_icons );
			?>
			</div><!-- /.header-icons -->
			<?php
endif;
	}
}

if ( ! function_exists( 'tokoo_get_user_account_link' ) ) {
	function tokoo_get_user_account_link() {

		$user_account_link = '';

		if ( tokoo_is_woocommerce_activated() ) {
			$user_account_link = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		} else {
			if ( ! is_user_logged_in() ) {
				if ( get_option( 'users_can_register' ) ) {
					$user_account_link = wp_registration_url();
				} else {
					$user_account_link = '';
				}
			} elseif ( current_user_can( 'read' ) ) {
				$user_account_link = admin_url();
			} else {
				$user_account_link = '';
			}
		}

		return apply_filters( 'tokoo_user_account_link', $user_account_link );
	}
}

if ( ! function_exists( 'tokoo_handheld_header_user_account' ) ) {
	function tokoo_handheld_header_user_account() {

		$user_account_link = tokoo_get_user_account_link();

		if ( ! empty( $user_account_link ) ) :

			?>
		<div class="header-icon">
			<a href="<?php echo esc_url( $user_account_link ); ?>" class="header-icon-link"><i class="<?php echo esc_attr( apply_filters( 'tokoo_header_user_account_icon', 'flaticon-social' ) ); ?>"></i></a>
		</div>
			<?php
		endif;
	}
}

if ( ! function_exists( 'tokoo_header_user_account' ) ) {
	function tokoo_header_user_account() {
		if ( ! apply_filters( 'tokoo_enable_header_user_account', true ) ) {
			return;
		}

		if ( tokoo_is_woocommerce_activated() ) {
			?>
			<div class="header-icon">
				<ul class="header-user-account-dropdown">
					<?php tokoo_user_account_menu_item(); ?>
				</ul>
			</div>
			<?php
		} else {
			$user_account_link = tokoo_get_user_account_link();

			if ( ! empty( $user_account_link ) ) :

				?>
			<div class="header-icon">
				<a href="<?php echo esc_url( $user_account_link ); ?>" class="header-icon-link"><i class="<?php echo esc_attr( apply_filters( 'tokoo_header_user_account_icon', 'flaticon-social' ) ); ?>"></i></a>
			</div>
				<?php
			endif;
		}
	}
}

if ( ! function_exists( 'tokoo_header_wishlist' ) ) {
	function tokoo_header_wishlist() {
		if ( function_exists( 'tokoo_get_wishlist_url' ) ) :
			?>
		<div class="header-icon">
			<a href="<?php echo esc_url( tokoo_get_wishlist_url() ); ?>" class="header-icon-link header-wishlist">
				<i class="flaticon-heart"></i>

				<?php if ( apply_filters( 'tokoo_show_wishlist_count', false ) ) : ?>
				<span class="navbar-wishlist-count count header-icon-counter" class="value"><?php echo yith_wcwl_count_products(); ?></span> 
				<?php endif; ?>
			</a>
		</div>
			<?php
	endif;
	}
}


if ( ! function_exists( 'tokoo_header_cart' ) ) {
	function tokoo_header_cart() {
		if ( tokoo_is_woocommerce_activated() && tokoo_get_shop_catalog_mode() == false ) :
			ob_start();
			the_widget( 'WC_Widget_Cart', 'title=' );
			$wc_widget_cart               = ob_get_clean();
			$disable_header_cart_dropdown = apply_filters( 'tokoo_header_cart_dropdown_disable', false );
			?>
		<div class="header-cart-icon header-icon">
			<div class="header-cart-icon-dropdown 
			<?php
			if ( ! $disable_header_cart_dropdown ) :
				?>
				dropdown<?php endif; ?>">
			<?php
				tokoo_cart_link();
			if ( ! empty( $wc_widget_cart ) ) :
				?>
				<div class="header-cart-dropdown-menu dropdown-menu">
					<?php echo wp_kses_post( $wc_widget_cart ); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
			<?php
		endif;
	}
}

if ( ! function_exists( 'tokoo_secondary_nav_cart' ) ) {
	function tokoo_secondary_nav_cart() {
		if ( tokoo_is_woocommerce_activated() && tokoo_get_shop_catalog_mode() == false ) :
			ob_start();
			the_widget( 'WC_Widget_Cart', 'title=' );
			$wc_widget_cart               = ob_get_clean();
			$disable_header_cart_dropdown = apply_filters( 'tokoo_header_cart_dropdown_disable', false );
			?>
			<li class="secondary-nav-cart-dropdown 
			<?php
			if ( ! $disable_header_cart_dropdown ) :
				?>
				dropdown<?php endif; ?>">
															<?php
															tokoo_cart_link();
															if ( ! empty( $wc_widget_cart ) ) {
																?>
				<div class="sub-menu">
																<?php echo wp_kses_post( $wc_widget_cart ); ?>
				</div>
																<?php
															}
															?>
			</li>
			<?php
endif;
	}
}

if ( ! function_exists( 'tokoo_has_handheld_header' ) ) {
	/**
	 * Load Different Header for handheld devices
	 */
	function tokoo_has_handheld_header() {
		return apply_filters( 'tokoo_has_handheld_header', true );
	}
}

if ( ! function_exists( 'tokoo_header_handheld' ) ) {
	/**
	 * Displays HandHeld Header
	 */
	function tokoo_header_handheld() {

		if ( tokoo_has_handheld_header() ) :
			?>
			<div class="handheld-only">
				<div class="container">
					<?php do_action( 'tokoo_before_header_handheld' ); ?>
					<div class="handheld-header">
					<?php
					/**
					 * @hooked tokoo_off_canvas_nav - 10
					 * @hooked tokoo_header_logo - 20
					 * @hooked tokoo_handheld_header_cart_link - 40
					 * @hooked tokoo_handheld_header_links - 50
					 */
					do_action( 'tokoo_header_handheld' );
					?>
					</div>
				</div>
			</div>
			<?php
		endif;
	}
}

if ( ! function_exists( 'tokoo_handheld_header_logo' ) ) {
	function tokoo_handheld_header_logo() {

		if ( apply_filters( 'tokoo_handheld_header_logo_show', true ) ) {

			ob_start();
			?>
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo-link">
					<?php tokoo_handheld_logo_html(); ?>
				</a>
			</div>
			<?php
			echo apply_filters( 'tokoo_header_logo_html', ob_get_clean() );
		} else {
			tokoo_header_logo();
		}
	}
}

if ( ! function_exists( 'tokoo_handheld_logo_html' ) ) {
	function tokoo_handheld_logo_html() {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			the_custom_logo();
		} elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} elseif ( apply_filters( 'tokoo_site_logo_svg', true ) ) {
			tokoo_get_svg_logo();
		} else {
			?>
			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_off_canvas_nav' ) ) {
	/**
	 * Displays Off Canvas Navigation
	 */
	function tokoo_off_canvas_nav() {
		if ( has_nav_menu( 'hand-held-nav' ) ) {
			?>
			<div class="off-canvas-navigation-wrapper">
				<div class="off-canvas-navbar-toggle-buttons clearfix">
					<button class="navbar-toggler navbar-toggle-hamburger " type="button">
						<i class="navbar-toggler-icon"></i>
					</button>
					<button class="navbar-toggler navbar-toggle-close " type="button">
						<i class="glyph-icon flaticon-close"></i>
					</button>
				</div>
				<div class="off-canvas-navigation" id="default-oc-header">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'hand-held-nav',
								'container'      => false,
								'menu_class'     => 'nav yamm',
								'fallback_cb'    => 'tokoo_handheld_nav_fallback',
							)
						);
					?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_handheld_nav_fallback' ) ) {
	/**
	 * Displays HandHeld Navigation Fallback
	 */
	function tokoo_handheld_nav_fallback() {
		wp_nav_menu(
			array(
				'theme_location' => 'hand-held-nav',
				'container'      => false,
				'menu_class'     => 'handheld-nav-menu',

			)
		);
	}
}

if ( ! function_exists( 'tokoo_handheld_header_links' ) ) {
	/**
	 * Display a menu intended for use on handheld devices
	 *
	 * @since 1.0.0
	 */
	function tokoo_handheld_header_links() {
		$links = array(
			'search'     => array(
				'priority' => 10,
				'callback' => 'tokoo_handheld_header_search_link',
			),
			'my-account' => array(
				'priority' => 20,
				'callback' => 'tokoo_handheld_header_user_account',
			),
			'cart'       => array(
				'priority' => 30,
				'callback' => 'tokoo_cart_link',
			),
		);

		if ( ! function_exists( 'wc_get_page_id' ) || wc_get_page_id( 'myaccount' ) === -1 || ! apply_filters( 'tokoo_enable_header_user_account', true ) ) {
			unset( $links['my-account'] );
		}

		if ( ! function_exists( 'wc_get_page_id' ) || wc_get_page_id( 'cart' ) === -1 || tokoo_get_shop_catalog_mode() == true ) {
			unset( $links['cart'] );
		}

		$links = apply_filters( 'tokoo_handheld_header_links', $links );
		?>
		<div class="handheld-header-links">
			<ul class="columns-<?php echo count( $links ); ?>">
				<?php foreach ( $links as $key => $link ) : ?>
					<li class="<?php echo esc_attr( $key ); ?>">
						<?php
						if ( $link['callback'] ) {
							call_user_func( $link['callback'], $key, $link );
						}
						?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_handheld_header_search_link' ) ) {
	/**
	 * The search callback function for the handheld header bar
	 *
	 * @since 2.0.0
	 */
	function tokoo_handheld_header_search_link() {
		echo '<a href="">' . esc_attr__( 'Search', 'tokoo' ) . '</a>';
		tokoo_header_search();
	}
}

if ( ! function_exists( 'tokoo_has_sticky_header' ) ) {
	/**
	 * Load sticky header
	 */
	function tokoo_has_sticky_header() {
		return apply_filters( 'tokoo_has_sticky_header', false );
	}
}

if ( ! function_exists( 'tokoo_sticky_wrap_start' ) ) {
	/**
	 * Open sticky wrapper
	 */
	function tokoo_sticky_wrap_start() {
		if ( tokoo_has_sticky_header() ) {
			?>
			<div class="tokoo-sticky-wrap">
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_sticky_wrap_end' ) ) {
	/**
	 * Close sticky wrapper
	 */
	function tokoo_sticky_wrap_end() {
		if ( tokoo_has_sticky_header() ) {
			?>
			</div><!-- /.tokoo-sticky-wrap -->
			<?php
		}
	}
}

require_once get_template_directory() . '/inc/template-tags/header/header-v2.php';