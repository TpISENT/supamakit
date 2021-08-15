<?php
/**
 * Filter functions for Footer Section of Theme Options
 */

if ( ! function_exists( 'redux_apply_footer_features' ) ) {
	function redux_apply_footer_features( $features ) {
		global $tokoo_options;

		if( ! empty( $tokoo_options['footer_feature_list_text'] ) ) {

			$info = array();

			foreach( $tokoo_options['footer_feature_list_text'] as $key => $text ) {
				if( ! empty( $tokoo_options['footer_feature_list_icon'][$key] ) ) {
					$info[] = array(
						'text' => $text,
						'icon' => $tokoo_options['footer_feature_list_icon'][$key],
					);
				} else {
					$info[] = array(
						'text' => $text,
						'icon' => '',
					);
				}
			}

			if( ! empty( $info ) ) {
				$features = $info;
			}
		}


		return $features;
	}
}


if ( ! function_exists( 'redux_toggle_footer_features_output' ) ) {
	function redux_toggle_footer_features_output( $enable ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['footer_feature_list_show'] ) && $tokoo_options['footer_feature_list_show'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}


if ( ! function_exists( 'redux_apply_footer_style' ) ) {
	function redux_apply_footer_style( $footer_style ) {
		global $tokoo_options;

		if( isset( $tokoo_options['footer_style'] ) ) {
			$footer_style = $tokoo_options['footer_style'];
		}

		return $footer_style;
	}
}


if ( ! function_exists( 'redux_toggle_footer_logo' ) ) {
	function redux_toggle_footer_logo( $enable ) {
		global $tokoo_options;

		if( isset( $tokoo_options['show_footer_logo'] ) && $tokoo_options['show_footer_logo'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_footer_logo' ) ) {
	function redux_apply_footer_logo( $logo ) {
		global $tokoo_options;

		if ( ! empty( $tokoo_options['site_footer_logo']['url'] ) ) {

			$logo_image_src = $tokoo_options['site_footer_logo']['url'];
			$footer_logo_text =  $tokoo_options['footer_text'];
			if ( is_ssl() ) {
				$logo_image_src = str_replace( 'http:', 'https:', $logo_image_src );
			}
			
			ob_start();
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home">
				<img src="<?php echo esc_url( $logo_image_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo esc_attr( $tokoo_options['site_footer_logo']['width'] ); ?>" height="<?php echo esc_attr( $tokoo_options['site_footer_logo']['height'] ); ?>" />
				<span class="footer-logo-text"><?php echo wp_kses_post( $footer_logo_text ); ?></span>
			</a>
			<?php
			$logo = ob_get_clean();
		}

		return $logo;
	}
}

if ( ! function_exists( 'redux_toggle_footer_logo_text' ) ) {
	function redux_toggle_footer_logo_text( $text ) {
		global $tokoo_options;

		if( isset( $tokoo_options['footer_text'] ) ) {
			$text = $tokoo_options['footer_text'];
		}

		return $text;
	}
}

if ( ! function_exists( 'redux_toggle_footer_social_icons' ) ) {
	function redux_toggle_footer_social_icons( $enable ) {
		global $tokoo_options;

		if( isset( $tokoo_options['show_footer_social_icons'] ) && $tokoo_options['show_footer_social_icons'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_social_networks' ) ) {
	function redux_apply_social_networks( $social_icons ) {
		global $tokoo_options;

		$social_icons = array(
			'facebook' 		=> array(
				'label'		=> esc_html__( 'Facebook', 'tokoo' ),
				'icon'		=> 'fab fa-facebook-f',
				'icon_hh'	=> 'fa fa-facebook-official',
				'id'		=> 'facebook_link',
			),
			'instagram' 	=> array(
				'label'		=> esc_html__( 'Instagram', 'tokoo' ),
				'icon'		=> 'fab fa-instagram',
				'id'		=> 'instagram_link'
			),
			'twitter' 		=> array(
				'label'		=> esc_html__( 'Twitter', 'tokoo' ),
				'icon'		=> 'fab fa-twitter',
				'icon_hh'	=> 'fa fa-twitter-square',
				'id'		=> 'twitter_link',
			),
			'googleplus' 	=> array(
				'label'		=> esc_html__( 'Google+', 'tokoo' ),
				'icon'		=> 'fab fa-google-plus-g',
				'icon_hh'	=> 'fa fa-google-plus-square',
				'id'		=> 'googleplus_link',
			),
			'linkedin' 		=> array(
				'label'		=> esc_html__( 'LinkedIn', 'tokoo' ),
				'icon'		=> 'fab fa-linkedin-in',
				'icon_hh'	=> 'fa fa-linkedin-square',
				'id'		=> 'linkedin_link',
			),
			'whatsapp-mobile' 	=> array(
				'label'	=> esc_html__( 'Whatsapp Mobile', 'tokoo' ),
				'icon'	=> 'fab fa-whatsapp mobile',
				'id'	=> 'whatsapp_mobile_link',
			),
			'whatsapp-desktop' 	=> array(
				'label'	=> esc_html__( 'Whatsapp Desktop', 'tokoo' ),
				'icon'	=> 'fab fa-whatsapp desktop',
				'id'	=> 'whatsapp_desktop_link',
			),
			'pinterest' 	=> array(
				'label'		=> esc_html__( 'Pinterest', 'tokoo' ),
				'icon'		=> 'fab fa-pinterest',
				'id'		=> 'pinterest_link',
			),
			'tumblr' 		=> array(
				'label'		=> esc_html__( 'Tumblr', 'tokoo' ),
				'icon'		=> 'fab fa-tumblr',
				'icon_hh'	=> 'fa fa-tumblr-square',
				'id'		=> 'tumblr_link'
			),
			'youtube'		=> array(
				'label'		=> esc_html__( 'Youtube', 'tokoo' ),
				'icon'		=> 'fab fa-youtube',
				'icon_hh'	=> 'fa fa-youtube-play',
				'id'		=> 'youtube_link'
			),
			'vimeo'			=> array(
				'label'		=> esc_html__( 'Vimeo', 'tokoo' ),
				'icon'		=> 'fab fa-vimeo-square',
				'id'		=> 'vimeo_link'
			),
			'dribbble' 		=> array(
				'label'		=> esc_html__( 'Dribbble', 'tokoo' ),
				'icon'		=> 'fab fa-dribbble',
				'id'		=> 'dribbble_link',
			),
			'stumbleupon' 	=> array(
				'label'		=> esc_html__( 'StumbleUpon', 'tokoo' ),
				'icon'		=> 'fab fa-stumbleupon',
				'icon_hh'	=> 'fa fa-stumbleupon-circle',
				'id'		=> 'stumble_upon_link'
			),
			'soundcloud'	=> array(
				'label'		=> esc_html__('Sound Cloud', 'tokoo'),
				'icon'		=> 'fab fa-soundcloud',
				'id'		=> 'soundcloud',
			),
			'vine'			=> array(
				'label'		=> esc_html__('Vine', 'tokoo'),
				'icon'		=> 'fab fa-vine',
				'id'		=> 'vine',
			),
			'vk'			=> array(
				'label'		=> esc_html__('VKontakte', 'tokoo'),
				'icon'		=> 'fab fa-vk',
				'id'		=> 'vk',
			),
			'telegram'      => array(
				'label' 	=> esc_html__('Telegram', 'tokoo'),
				'id'    	=> 'telegram_link',
				'icon'  	=> 'fab fa-telegram',
			),
			'rss'			=> array(
				'label'		=> esc_html__( 'RSS', 'tokoo' ),
				'icon'		=> 'fas fa-rss',
				'id'		=> 'rss_link',
			)
		);

		foreach( $social_icons as $key => $social_icon ) {
			if( ! empty( $tokoo_options[$key] ) ) {
				$social_icons[$key]['link'] = $tokoo_options[$key];
			}
		}

		if( isset( $tokoo_options['show_footer_rss_icon'] ) && $tokoo_options['show_footer_rss_icon'] ) {
			$social_icons['rss']['link'] = get_bloginfo( 'rss2_url' );
		}

		return $social_icons;
	}
}

if ( ! function_exists( 'redux_apply_footer_social_icons_text' ) ) {
	function redux_apply_footer_social_icons_text( $text ) {
		global $tokoo_options;

		if( isset( $tokoo_options['footer_social_icons_text'] ) ) {
			$text = $tokoo_options['footer_social_icons_text'];
		}

		return $text;
	}
}
		
if ( ! function_exists( 'redux_toggle_footer_widgets' ) ) {
	function redux_toggle_footer_widgets( $enable ) {
		global $tokoo_options;

		if( isset( $tokoo_options['show_footer_widgets'] ) && $tokoo_options['show_footer_widgets'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_toggle_footer_bottom_bar' ) ) {
	function redux_toggle_footer_bottom_bar( $enable ) {
		global $tokoo_options;

		$tokoo_options['footer_bottom_bar_enable'] = isset( $tokoo_options['footer_bottom_bar_enable'] ) ? $tokoo_options['footer_bottom_bar_enable'] : true;

		if( $tokoo_options['footer_bottom_bar_enable'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_toggle_footer_payment_icons' ) ) {
	function redux_toggle_footer_payment_icons( $enable ) {
		global $tokoo_options;

		$tokoo_options['footer_payment_icons_enable'] = isset( $tokoo_options['footer_payment_icons_enable'] ) ? $tokoo_options['footer_payment_icons_enable'] : true;

		if( $tokoo_options['footer_payment_icons_enable'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_footer_payment_icons_text' ) ) {
	function redux_apply_footer_payment_icons_text( $text ) {
		global $tokoo_options;

		if( isset( $tokoo_options['footer_payment_text'] ) ) {
			$text = $tokoo_options['footer_payment_text'];
		}

		return $text;
	}
}

if ( ! function_exists( 'redux_apply_footer_payment_icons' ) ) {
	function redux_apply_footer_payment_icons( $content ) {
		global $tokoo_options;

		if ( ! empty( $tokoo_options['footer_payment_icons']['url'] ) ) {

			$payment_icons_img_src = $tokoo_options['footer_payment_icons']['url'];
			
			if ( is_ssl() ) {
				$payment_icons_img_src = str_replace( 'http:', 'https:', $payment_icons_img_src );
			}
			
			ob_start();
			?>
			<div class="footer-payment-logo">
				<img class="payment-icons-img" src="<?php echo esc_url( $payment_icons_img_src ); ?>" alt="<?php echo esc_html__( 'Payment Icons', 'tokoo' ); ?>" width="<?php echo esc_attr( $tokoo_options['footer_payment_icons']['width'] ); ?>" height="<?php echo esc_attr( $tokoo_options['footer_payment_icons']['height'] ); ?>" />
			</div>
			<?php
			$content = ob_get_clean();
		}

		return $content;
	}
}

if ( ! function_exists( 'redux_apply_footer_copyright_text' ) ) {
	function redux_apply_footer_copyright_text( $text ) {
		global $tokoo_options;

		if( isset( $tokoo_options['footer_copyright'] ) ) {
			$text = $tokoo_options['footer_copyright'];
		}

		return $text;
	}
}