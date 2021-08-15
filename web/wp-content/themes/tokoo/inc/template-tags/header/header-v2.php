<?php
/*
 * Template tags used in header v2
 */

if ( ! function_exists( 'tokoo_header_v2_seconary_nav' ) ) {
	function tokoo_header_v2_seconary_nav() {
		?><div class="secondary-nav">
			<div class="secondary-nav-inner">
				<ul class="secondary-nav-menu">
				<?php
					$secondary_nav_menu = wp_nav_menu(
						array(
							'theme_location' => 'secondary-nav',
							'container'      => false,
							'menu_class'     => 'secondary-nav-menu',
							'fallback_cb'    => 'tokoo_header_v2_secondary_nav_fallback',
							'items_wrap'     => '%3$s',
						)
					);
				?>
					<?php tokoo_user_account_menu_item(); ?>
					<?php tokoo_secondary_nav_cart(); ?>
				</ul>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_user_account_menu_item' ) ) {
	function tokoo_user_account_menu_item() {
		if ( tokoo_is_woocommerce_activated() ) {
			if ( ! apply_filters( 'tokoo_enable_header_user_account', true ) ) {
				return;
			}

			$my_account_page_url     = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
			$is_registration_enabled = false;
			$not_logged_in_text      = esc_html__( 'Sign in', 'tokoo' );
			if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
				$is_registration_enabled = true;
				$not_logged_in_text      = esc_html__( 'Register or Sign in', 'tokoo' );
			}
			$not_logged_in_text         = apply_filters( 'tokoo_not_logged_in_text', $not_logged_in_text );
			$user_account_nav_menu      = apply_filters( 'tokoo_user_account_nav_menu_ID', 0 );
			$user_account_nav_menu_args = apply_filters(
				'tokoo_user_account_nav_menu_args',
				array(
					'container'  => false,
					'menu'       => $user_account_nav_menu,
					'menu_class' => 'sub-menu',
				)
			);

			?>
			<li class="menu-item-has-children">
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( $my_account_page_url ); ?>"><i class="<?php echo esc_attr( apply_filters( 'tokoo_header_user_account_icon', 'flaticon-social' ) ); ?>"></i><?php echo esc_html__( 'My Account', 'tokoo' ); ?></a>
					<?php
					if ( is_nav_menu( $user_account_nav_menu ) ) {
						wp_nav_menu( $user_account_nav_menu_args );
					} else {
						tokoo_user_account_nav_menu_fallback();
					}
					?>
				<?php else : ?>
				<a href="<?php echo esc_url( $my_account_page_url ); ?>"><i class="<?php echo esc_attr( apply_filters( 'tokoo_header_user_account_icon', 'flaticon-social' ) ); ?>"></i><?php echo wp_kses_post( $not_logged_in_text ); ?></a>
				<ul class="sub-menu">
					<li class="mega-menu">
						<div class="register-sign-in-dropdown-inner">
							<div class="sign-in">
								<p><?php echo esc_html__( 'Returning Customer ?', 'tokoo' ); ?></p>
								<div class="sign-in-action"><a href="<?php echo esc_url( $my_account_page_url ); ?>" class="sign-in-button"><?php echo esc_html__( 'Sign in', 'tokoo' ); ?></a></div>
							</div>
							<?php if ( $is_registration_enabled ) : ?>
							<div class="register">
								<p><?php echo esc_html__( 'Don\'t have an account ?', 'tokoo' ); ?></p>
								<div class="register-action"><a href="<?php echo esc_url( $my_account_page_url ); ?>"><?php echo esc_html__( 'Register', 'tokoo' ); ?></a></div>
							</div>
							<?php endif; ?>
						</div>
					</li>
				</ul>
				<?php endif; ?>
			</li>
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_user_account_nav_menu_fallback' ) ) {
	function tokoo_user_account_nav_menu_fallback() {
		?>
		<ul class="sub-menu">
			<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="menu-item">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
		<?php
	}
}

if ( ! function_exists( 'tokoo_header_v2_primary_nav' ) ) {
	function tokoo_primary_nav() {
		?>
		<div class="primary-nav">
			<div class="container">
				<div class="primary-nav-inner">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary-nav',
							'container'      => false,
							'menu_class'     => 'primary-nav-menu',
							'fallback_cb'    => 'tokoo_primary_nav_fallback',
						)
					);
				?>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_primary_nav_fallback' ) ) {
	function tokoo_primary_nav_fallback() {
		if ( tokoo_is_woocommerce_activated() ) {
			$list_categories_args = apply_filters(
				'tokoo_primary_nav_fallback_list_cat_args',
				array(
					'title_li'   => false,
					'echo'       => false,
					'taxonomy'   => 'product_cat',
					'hide_empty' => false,
				)
			);
			echo wp_kses_post( '<ul class="primary-nav-menu">' . wp_list_categories( $list_categories_args ) . '</ul>' );
		}
	}
}
