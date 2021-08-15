<?php
/**
 * Template functions used in Footer
 */
if ( ! function_exists( 'tokoo_get_footer' ) ) {
	function tokoo_get_footer( $footer = '' ) {
		$footer_style = apply_filters( 'tokoo_footer_style', 'v1' );

		if ( ! empty( $footer ) ) {
			$footer_style = $footer;
		}

		get_footer( $footer_style );

	}
}

if ( ! function_exists( 'tokoo_footer_features_list' ) ) {
	function tokoo_footer_features_list() {
		$features = apply_filters(
			'tokoo_footer_features',
			array(
				array(
					'icon' => 'flaticon-security',
					'text' => wp_kses_post( __( '100% Payment <br>Secured', 'tokoo' ) ),
				),
				array(
					'icon' => 'flaticon-wallet',
					'text' => wp_kses_post( __( 'Support lots <br>of Payments', 'tokoo' ) ),
				),
				array(
					'icon' => 'flaticon-support',
					'text' => wp_kses_post( __( 'Friendly Customer <br>Support', 'tokoo' ) ),
				),
				array(
					'icon' => 'flaticon-shipped',
					'text' => wp_kses_post( __( 'Free Delivery <br>to All Destinations', 'tokoo' ) ),
				),
				array(
					'icon' => 'flaticon-price-tag',
					'text' => wp_kses_post( __( 'Best Price <br>Guaranteed', 'tokoo' ) ),
				),
				array(
					'icon' => 'flaticon-system',
					'text' => wp_kses_post( __( 'Mobile Apps <br>Ready', 'tokoo' ) ),
				),
			)
		);

		if ( ! empty( $features ) && apply_filters( 'tokoo_enable_footer_features_list', false ) ) {
			?><div class="footer-features">
				<div class="container">
					<ul class="features-list">
						<?php foreach ( $features as $feature ) : ?>
						<li class="feature">
							<i class="feature-icon <?php echo esc_attr( $feature['icon'] ); ?>"></i>
							<span class="feature-text"><?php echo wp_kses_post( $feature['text'] ); ?></span>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php
		}

	}
}

if ( ! function_exists( 'tokoo_footer_v1_content' ) ) {
	function tokoo_footer_v1_content() {
		?>
		<div class="footer-content">
			<div class="container">
			<?php
				do_action( 'tokoo_footer_v1_content' );
			?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_footer_v2_content' ) ) {
	function tokoo_footer_v2_content() {
		?>
		<div class="footer-content">
			<div class="container">
			<?php
				do_action( 'tokoo_footer_v2_content' );
			?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_get_social_networks' ) ) {
	function tokoo_get_social_networks() {
		return apply_filters(
			'tokoo_get_social_networks',
			array(
				'facebook'         => array(
					'label' => esc_html__( 'Facebook', 'tokoo' ),
					'icon'  => 'fab fa-facebook-f',
					'id'    => 'facebook_link',
				),
				'instagram'        => array(
					'label' => esc_html__( 'Instagram', 'tokoo' ),
					'icon'  => 'fab fa-instagram',
					'id'    => 'instagram_link',
				),
				'googleplus'       => array(
					'label' => esc_html__( 'Google+', 'tokoo' ),
					'icon'  => 'fab fa-google-plus-g',
					'id'    => 'googleplus_link',
				),
				'twitter'          => array(
					'label' => esc_html__( 'Twitter', 'tokoo' ),
					'icon'  => 'fab fa-twitter',
					'id'    => 'twitter_link',
				),
				'linkedin'         => array(
					'label' => esc_html__( 'LinkedIn', 'tokoo' ),
					'icon'  => 'fab fa-linkedin',
					'id'    => 'linkedin_link',
				),
				'whatsapp_mobile'  => array(
					'label' => esc_html__( 'Whatsapp Mobile', 'tokoo' ),
					'icon'  => 'fab fa-whatsapp mobile',
					'id'    => 'whatsapp_mobile_link',
				),
				'whatsapp_desktop' => array(
					'label' => esc_html__( 'Whatsapp Desktop', 'tokoo' ),
					'icon'  => 'fab fa-whatsapp desktop',
					'id'    => 'whatsapp_desktop_link',
				),
				'pinterest'        => array(
					'label' => esc_html__( 'Pinterest', 'tokoo' ),
					'icon'  => 'fab fa-pinterest',
					'id'    => 'pinterest_link',
				),
				'tumblr'           => array(
					'label' => esc_html__( 'Tumblr', 'tokoo' ),
					'icon'  => 'fab fa-tumblr',
					'id'    => 'tumblr_link',
				),
				'youtube'          => array(
					'label' => esc_html__( 'Youtube', 'tokoo' ),
					'icon'  => 'fab fa-youtube',
					'id'    => 'youtube_link',
				),
				'vimeo'            => array(
					'label' => esc_html__( 'Vimeo', 'tokoo' ),
					'icon'  => 'fab fa-vimeo-square',
					'id'    => 'vimeo_link',
				),
				'dribbble'         => array(
					'label' => esc_html__( 'Dribbble', 'tokoo' ),
					'icon'  => 'fab fa-dribbble',
					'id'    => 'dribbble_link',
				),
				'stumbleupon'      => array(
					'label' => esc_html__( 'StumbleUpon', 'tokoo' ),
					'icon'  => 'fab fa-stumbleupon',
					'id'    => 'stumble_upon_link',
				),
				'soundcloud'       => array(
					'label' => esc_html__( 'Sound Cloud', 'tokoo' ),
					'id'    => 'soundcloud_link',
					'icon'  => 'fab fa-soundcloud',
				),
				'vine'             => array(
					'label' => esc_html__( 'Vine', 'tokoo' ),
					'id'    => 'vine_link',
					'icon'  => 'fab fa-vine',
				),
				'vk'               => array(
					'label' => esc_html__( 'VKontakte', 'tokoo' ),
					'id'    => 'vk_link',
					'icon'  => 'fab fa-vk',
				),
				'telegram'         => array(
					'label' => esc_html__( 'Telegram', 'tokoo' ),
					'id'    => 'telegram_link',
					'icon'  => 'fab fa-telegram',
				),
				'rss'              => array(
					'label' => esc_html__( 'RSS', 'tokoo' ),
					'icon'  => 'fas fa-rss',
					'id'    => 'rss_link',
				),
			)
		);
	}
}

if ( ! function_exists( 'tokoo_footer_social_icons' ) ) {
	function tokoo_footer_social_icons() {
		$allowed_protocols   = wp_parse_args( array( 'whatsapp' ), wp_allowed_protocols() );
		$social_networks     = apply_filters( 'tokoo_set_social_networks', tokoo_get_social_networks() );
		$social_links_output = '';
		$social_link_html    = apply_filters( 'tokoo_footer_social_link_html', '<a class="social-icon %3$s" target="_blank" href="%2$s"><span class="fa-stack"><i class="fas fa-circle fa-stack-2x"></i><i class="fa-stack-1x fa-inverse %1$s"></i></span></a>' );

		foreach ( $social_networks as $key => $social_network ) {
			if ( isset( $social_network['link'] ) && ! empty( $social_network['link'] ) ) {
				$social_links_output .= sprintf( '<li>' . $social_link_html . '</li>', $social_network['icon'], $social_network['link'], $key );
			}
		}

		if ( apply_filters( 'tokoo_footer_social_icons', true ) && ! empty( $social_links_output ) ) {
			$footer_social_icons_text = apply_filters( 'tokoo_footer_social_icons_text', esc_html__( 'Follow us on :', 'tokoo' ) );

			ob_start();
			?>
			<div class="footer-social-icons">
				<div class="footer-social-icons-text"><?php echo wp_kses_post( $footer_social_icons_text ); ?></div>
				<ul class="social-icons list-unstyled">
					<?php echo wp_kses( $social_links_output, 'post', $allowed_protocols ); ?>
				</ul>
			</div>
			<?php
			echo apply_filters( 'tokoo_footer_social_links_html', ob_get_clean() );
		}
	}
}

if ( ! function_exists( 'tokoo_footer_logo_and_social' ) ) {
	function tokoo_footer_logo_and_social() {
		?>
		<div class="footer-logo-social">
		<?php
			tokoo_footer_logo();
			tokoo_footer_social_icons();
		?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_footer_logo' ) ) {
	function tokoo_footer_logo() {

		if ( apply_filters( 'tokoo_footer_logo', true ) ) {

			$footer_logo_text = apply_filters( 'tokoo_footer_logo_text', get_bloginfo( 'description' ) );

			ob_start();
			?>
			<div class="footer-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo-link">
					<?php tokoo_footer_logo_html(); ?>
					<span class="footer-logo-text"><?php echo wp_kses_post( $footer_logo_text ); ?></span>
				</a>
			</div>
			<?php
			echo apply_filters( 'tokoo_footer_logo_html', ob_get_clean() );
		}
	}
}

if ( ! function_exists( 'tokoo_footer_logo_html' ) ) {
	function tokoo_footer_logo_html() {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			the_custom_logo();
		} elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} elseif ( apply_filters( 'tokoo_site_logo_svg', true ) ) {
			tokoo_get_svg_logo();
		} else {
			?>
			<div class="footer-site-title"><?php bloginfo( 'name' ); ?></div>
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_footer_widgets' ) ) {
	/**
	 * Display the footer widget regions.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function tokoo_footer_widgets() {

		if ( apply_filters( 'tokoo_footer_widgets', true ) ) {

			$rows    = intval( apply_filters( 'tokoo_footer_widget_rows', 1 ) );
			$regions = intval( apply_filters( 'tokoo_footer_widget_columns', 4 ) );
			for ( $row = 1; $row <= $rows; $row++ ) :
				// Defines the number of active columns in this footer row.
				for ( $region = $regions; 0 < $region; $region-- ) {
					if ( is_active_sidebar( 'footer-' . strval( $region + $regions * ( $row - 1 ) ) ) ) {
						$columns = $region;
						break;
					}
				}
				if ( isset( $columns ) ) :
					?>
					<div class=<?php echo '"footer-widgets row-' . strval( $row ) . ' col-' . strval( $columns ) . ' fix"'; ?>>
										  <?php
											for ( $column = 1; $column <= $columns; $column++ ) :
												$footer_n = $column + $regions * ( $row - 1 );
												if ( is_active_sidebar( 'footer-' . strval( $footer_n ) ) ) :
													?>

								<div class="block footer-widget-<?php echo strval( $column ); ?>">
													<?php dynamic_sidebar( 'footer-' . strval( $footer_n ) ); ?>
								</div>
													<?php
													endif;
						endfor;
											?>

					</div><!-- .footer-widgets.row-<?php echo strval( $row ); ?> -->
															  <?php
																unset( $columns );
				endif;
			endfor;
		}
	}
}

if ( ! function_exists( 'tokoo_footer_bottom_bar' ) ) {
	function tokoo_footer_bottom_bar() {
		?>
		<div class="footer-bottom-bar">
			<div class="container">
				<?php
				if ( apply_filters( 'tokoo_enable_footer_bottom_bar', true ) ) :
					?>
					<div class="footer-bottom-bar-inner">
						<?php tokoo_footer_payment_icons(); ?>
						<?php tokoo_copyright_info(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}


if ( ! function_exists( 'tokoo_footer_payment_icons' ) ) {
	function tokoo_footer_payment_icons() {

		$footer_payment_icons_text = apply_filters( 'tokoo_footer_payment_icons_text', esc_html__( 'We are accepts', 'tokoo' ) );
		$payment_icons_image_src   = apply_filters( 'tokoo_footer_payment_icons_image_src', get_template_directory_uri() . '/assets/images/payment-logos.png' );

		if ( apply_filters( 'tokoo_enable_footer_payment_icons', false ) ) {
			?>
			<div class="payment-icons">
				<div class="payment-icon-text"><?php echo wp_kses_post( $footer_payment_icons_text ); ?></div>
				<?php tokoo_payment_icons(); ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_payment_icons' ) ) {

	function tokoo_payment_icons() {

		$credit_card_icons       = apply_filters( 'tokoo_footer_payment_icons_image_src', '' );
		$payment_icons_image_src = apply_filters( 'tokoo_footer_payment_icons_image_src', get_template_directory_uri() . '/assets/images/payment-logos.png' );

		if ( apply_filters( 'electro_enable_footer_credit_block', true ) ) :
			?>
			<?php if ( ! empty( $credit_card_icons ) ) { ?>
				<div class="payment-icons"><?php echo wp_kses_post( $credit_card_icons ); ?></div>
			<?php } else { ?>
			<img alt="" src="<?php echo esc_url( $payment_icons_image_src ); ?>" class="img-payment-icons" />
				<?php
			}

		endif;
	}
}

if ( ! function_exists( 'tokoo_copyright_info' ) ) {
	function tokoo_copyright_info() {
		$copyright_info = apply_filters( 'copyright_info', sprintf( wp_kses_post( __( '&copy; Copyright %1$s, <a href="%2$s">%3$s</a>. All Rights Reserved', 'tokoo' ) ), date( 'Y' ), esc_url( home_url( '/' ) ), get_bloginfo( 'name' ) ) );
		?>
		<div class="copyright-info"><?php echo wp_kses_post( $copyright_info ); ?></div>
		<?php
	}
}
