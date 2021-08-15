<?php
/**
 * Template functions in Home v5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Gets the default Home options for v5
 */
function tokoo_get_default_home_v5_options() {
	$home_v5 = array(
		'sdr' => array(
			'is_enabled' => 'yes',
			'priority'   => 10,
			'animation'  => '',
			'shortcode'  => '',
		),
		'fl'  => array(
			'is_enabled' => 'yes',
			'priority'   => 30,
			'animation'  => '',
			'features'   => array(
				array(
					'icon'  => 'flaticon-security',
					'label' => esc_html__( '100% Payment <br>Secured', 'tokoo' ),
				),
				array(
					'icon'  => 'flaticon-wallet',
					'label' => esc_html__( 'Support lots <br>of Payments', 'tokoo' ),
				),
				array(
					'icon'  => 'flaticon-support',
					'label' => esc_html__( '24hours/7days <br>Support', 'tokoo' ),
				),
				array(
					'icon'  => 'flaticon-shipped',
					'label' => esc_html__( 'Free Delivery <br>with $50', 'tokoo' ),
				),
				array(
					'icon'  => 'flaticon-price-tag',
					'label' => esc_html__( 'Best Price <br>Guaranteed', 'tokoo' ),
				),
				array(
					'icon'  => 'flaticon-system',
					'label' => esc_html__( 'Mobile Apps <br>Ready', 'tokoo' ),
				),
			),
		),
		'pb2' => array(
			'is_enabled'               => 'yes',
			'priority'                 => 30,
			'animation'                => '',
			'show_header'              => 'yes',
			'section_title'            => esc_html__( 'New Arrivals', 'tokoo' ),
			'header_aside_action_text' => esc_html__( 'View all', 'tokoo' ),
			'header_aside_action_link' => '#',
			'shortcode_content'        => array(
				'shortcode'      => 'featured_products',
				'shortcode_atts' => array(
					'columns'  => '2',
					'per_page' => '9',
				),
			),
		),
		'pc1' => array(
			'is_enabled'               => 'yes',
			'priority'                 => 40,
			'animation'                => '',
			'show_header'              => 'yes',
			'section_title'            => esc_html__( 'Best Rated Products', 'tokoo' ),
			'header_aside_action_text' => esc_html__( 'View all', 'tokoo' ),
			'header_aside_action_link' => '#',
			'shortcode_content'        => array(
				'shortcode'      => 'products',
				'shortcode_atts' => array(
					'columns'  => '6',
					'per_page' => '8',
				),
			),
			'carousel_args'            => array(
				'slidesToShow'   => 6,
				'slidesToScroll' => 6,
				'infinite'       => 'no',
				'autoplay'       => 'no',
			),
		),
		'pc'  => array(
			'is_enabled'               => 'yes',
			'priority'                 => 50,
			'animation'                => '',
			'show_header'              => 'yes',
			'section_title'            => esc_html__( 'Deals of the day', 'tokoo' ),
			'header_aside_action_text' => esc_html__( 'View all', 'tokoo' ),
			'header_aside_action_link' => '#',
			'shortcode_content'        => array(
				'shortcode'      => 'sale_products',
				'shortcode_atts' => array(
					'columns'  => '6',
					'per_page' => '8',
				),
			),
			'carousel_args'            => array(
				'slidesToShow'   => 6,
				'slidesToScroll' => 6,
				'infinite'       => 'no',
				'autoplay'       => 'no',
			),
		),
		'br'  => array(
			'is_enabled' => 'yes',
			'priority'   => 60,
			'animation'  => '',
			'image'      => 0,
			'el_class'   => '',
			'link'       => '#',
		),
		'fsc' => array(
			'is_enabled'        => 'yes',
			'priority'          => 70,
			'animation'         => '',
			'section_title'     => wp_kses_post( __( 'Fla<i class="flaticon-flash"></i>h <br> sale', 'tokoo' ) ),
			'show_header'       => 'yes',
			'header_timer'      => 'yes',
			'timer_title'       => esc_html__( 'Sales Ends in', 'tokoo' ),
			'timer_value'       => '+8 hours',
			'bg_img'            => 'https://placehold.it/1920x915',
			'shortcode_content' => array(
				'shortcode'      => 'sale_products',
				'shortcode_atts' => array(
					'columns'  => 4,
					'per_page' => 24,
				),
			),
			'carousel_args'     => array(
				'rows'           => 2,
				'slidesPerRow'   => 4,
				'slidesToShow'   => 1,
				'slidesToScroll' => 1,
				'arrows'         => 'no',
				'dots'           => 'yes',
			),
		),
		'pb1' => array(
			'is_enabled'        => 'yes',
			'priority'          => 80,
			'animation'         => '',
			'show_cat_title'    => 'yes',
			'tab_title'         => esc_html__( 'Gaming', 'tokoo' ),
			'section_title'     => esc_html__( 'Best Seller Products on Gaming Categories', 'tokoo' ),
			'number'            => '7',
			'slug'              => '',
			'hide_empty'        => 'yes',
			'shortcode_content' => array(
				'shortcode'      => 'recent_products',
				'shortcode_atts' => array(
					'per_page' => 9,
					'columns'  => 4,
				),
			),
		),
		'cat' => array(
			'is_enabled'    => 'yes',
			'priority'      => 90,
			'animation'     => '',
			'section_title' => esc_html__( 'Shop by Categories', 'tokoo' ),
			'number'        => 12,
			'columns'       => 4,
			'slug'          => '',
			'hide_empty'    => 'yes',
		),
		'bc'  => array(
			'is_enabled'    => 'yes',
			'priority'      => 100,
			'animation'     => '',
			'section_title' => esc_html__( 'Our Official Brand', 'tokoo' ),
			'orderby'       => 'title',
			'order'         => 'ASC',
			'number'        => 15,
			'columns'       => 5,
			'hide_empty'    => 'no',
			'carousel_args' => array(
				'slidesToShow'   => 6,
				'slidesToScroll' => 1,
				'infinite'       => 'no',
				'autoplay'       => 'no',

			),
		),
	);

	return apply_filters( 'tokoo_get_default_home_v5_options', $home_v5 );
}

/**
 * Get the home v5 meta options
 *
 * @param boolean $merge_default Should merge with default options or not.
 */
function tokoo_get_home_v5_meta( $merge_default = true ) {
	global $post;

	if ( isset( $post->ID ) ) {

		$clean_home_v5_options = get_post_meta( $post->ID, '_home_v5_options', true );
		$home_v5_options       = maybe_unserialize( $clean_home_v5_options );

		if ( ! is_array( $home_v5_options ) ) {
			$home_v5_options = json_decode( $clean_home_v5_options, true );
		}

		if ( $merge_default ) {
			$default_options = tokoo_get_default_home_v5_options();
			$home_v5         = wp_parse_args( $home_v5_options, $default_options );
		} else {
			$home_v5 = $home_v5_options;
		}

		return apply_filters( 'tokoo_home_v5_meta', $home_v5, $post );
	}
}

if ( ! function_exists( 'tokoo_home_v5_revslider' ) ) {
	/**
	 * Displays Slider in Home v5
	 */
	function tokoo_home_v5_revslider() {

		$home_v5 = tokoo_get_home_v5_meta();
		$sdr     = $home_v5['sdr'];

		$is_enabled = isset( $sdr['is_enabled'] ) ? filter_var( $sdr['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

		if ( ! $is_enabled ) {
			return;
		}

		$animation = isset( $sdr['animation'] ) ? $sdr['animation'] : '';
		$shortcode = ! empty( $sdr['shortcode'] ) ? $sdr['shortcode'] : '[rev_slider alias="home-v5-slider"]';

		$section_class = 'home-v5-slider';
		if ( ! empty( $animation ) ) {
			$section_class = ' animate-in-view';
		}
		?>
		<div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>
			data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
			<?php echo apply_filters( 'tokoo_home_v5_slider_html', do_shortcode( $shortcode ) ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_home_v5_features_list' ) ) {
	/**
	 * Display home_v5 Feature List
	 */
	function tokoo_home_v5_features_list() {
		$home_v5    = tokoo_get_home_v5_meta();
		$fl_options = $home_v5['fl'];

		$is_enabled = isset( $fl_options['is_enabled'] ) ? filter_var( $fl_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

		if ( ! $is_enabled ) {
			return;
		}

		$animation = isset( $fl_options['animation'] ) ? $fl_options['animation'] : '';

		$args = array(
			'section_class' => 'style-1 box-shadow',
			'animation'     => $animation,
			'features'      => array(),
		);

		foreach ( $fl_options['features'] as $key => $feature ) {
			if ( isset( $feature['icon'] ) && isset( $feature['label'] ) ) {
				$args['features'][] = array(
					'icon'  => $feature['icon'],
					'label' => $feature['label'],
				);
			}
		}

		$args = apply_filters( 'tokoo_home_v5_features_list_args', $args );

		tokoo_features_list( $args );
	}
}

if ( ! function_exists( 'tokoo_home_v5_products_4_1_4_block' ) ) {
	/**
	 * Displays 4-1-4 Block in Home v5
	 */
	function tokoo_home_v5_products_4_1_4_block() {

		if ( tokoo_is_woocommerce_activated() ) {
			$home_v5 = tokoo_get_home_v5_meta();
			$pb2     = $home_v5['pb2'];

			$is_enabled = isset( $pb2['is_enabled'] ) ? $pb2['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $pb2['animation'] ) ? $pb2['animation'] : '';

			$args = apply_filters(
				'tokoo_home_v5_products_4_1_4_block_args',
				array(
					'animation'      => $animation,
					'shortcode_atts' => isset( $home_v5['pb2']['shortcode_content'] ) ? tokoo_get_atts_for_shortcode( $home_v5['pb2']['shortcode_content'] ) : array(
						'columns' => '2',
						'limit'   => '9',
					),
					'header_args'    => array(
						'show_header'              => isset( $home_v5['pb2']['show_header'] ) ? filter_var( $home_v5['pb2']['show_header'], FILTER_VALIDATE_BOOLEAN ) : false,
						'section_title'            => isset( $home_v5['pb2']['section_title'] ) ? $home_v5['pb2']['section_title'] : esc_html__( 'New Arrivals', 'tokoo' ),
						'header_aside_action_text' => isset( $home_v5['pb2']['header_aside_action_text'] ) ? $home_v5['pb2']['header_aside_action_text'] : esc_html__( 'View All', 'tokoo' ),
						'header_aside_action_link' => isset( $home_v5['pb2']['header_aside_action_link'] ) ? $home_v5['pb2']['header_aside_action_link'] : '#',
					),

				)
			);

			tokoo_4_1_4_block( $args );
		}
	}
}

if ( ! function_exists( 'tokoo_home_v5_products_carousel_2' ) ) {
	/**
	 * Displays Carousel in Home v5
	 */
	function tokoo_home_v5_products_carousel_2() {

		if ( tokoo_is_woocommerce_activated() ) {
			$home_v5 = tokoo_get_home_v5_meta();
			$pc1     = $home_v5['pc1'];

			$is_enabled = isset( $pc1['is_enabled'] ) ? $pc1['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $pc1['animation'] ) ? $pc1['animation'] : '';

			$args = array(
				'animation'      => $animation,
				'shortcode_atts' => isset( $home_v5['pc1']['shortcode_content'] ) ? tokoo_get_atts_for_shortcode( $home_v5['pc1']['shortcode_content'] ) : array(
					'columns' => '6',
					'limit'   => '8',
				),
				'header_args'    => array(
					'show_header'              => isset( $home_v5['pc1']['show_header'] ) ? filter_var( $home_v5['pc1']['show_header'], FILTER_VALIDATE_BOOLEAN ) : false,
					'section_title'            => isset( $home_v5['pc1']['section_title'] ) ? $home_v5['pc1']['section_title'] : esc_html__( 'Deals of the day', 'tokoo' ),
					'header_aside_action_text' => isset( $home_v5['pc1']['header_aside_action_text'] ) ? $home_v5['pc1']['header_aside_action_text'] : esc_html__( 'View All', 'tokoo' ),
					'header_aside_action_link' => isset( $home_v5['pc1']['header_aside_action_link'] ) ? $home_v5['pc1']['header_aside_action_link'] : '#',
				),
				'carousel_args'  => array(
					'slidesToShow'   => isset( $home_v5['pc1']['carousel_args']['slidesToShow'] ) ? intval( $home_v5['pc1']['carousel_args']['slidesToShow'] ) : 6,
					'slidesToScroll' => isset( $home_v5['pc1']['carousel_args']['slidesToScroll'] ) ? intval( $home_v5['pc1']['carousel_args']['slidesToScroll'] ) : 6,
					'dots'           => isset( $home_v5['pc1']['carousel_args']['dots'] ) ? filter_var( $home_v5['pc1']['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
					'arrows'         => isset( $home_v5['pc1']['carousel_args']['arrows'] ) ? filter_var( $home_v5['pc1']['carousel_args']['arrows'], FILTER_VALIDATE_BOOLEAN ) : true,
					'autoplay'       => isset( $home_v5['pc1']['carousel_args']['autoplay'] ) ? filter_var( $home_v5['pc1']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
					'responsive'     => array(
						array(
							'breakpoint' => 0,
							'settings'   => array(
								'slidesToShow'   => 2,
								'slidesToScroll' => 2,
							),
						),
						array(
							'breakpoint' => 576,
							'settings'   => array(
								'slidesToShow'   => 2,
								'slidesToScroll' => 2,
							),
						),
						array(
							'breakpoint' => 768,
							'settings'   => array(
								'slidesToShow'   => 2,
								'slidesToScroll' => 2,
							),
						),
						array(
							'breakpoint' => 992,
							'settings'   => array(
								'slidesToShow'   => 3,
								'slidesToScroll' => 3,
							),
						),
						array(
							'breakpoint' => 1200,
							'settings'   => array(
								'slidesToShow'   => 4,
								'slidesToScroll' => 4,
							),
						),
					),
				),
			);

			tokoo_products_carousel( $args );
		}
	}
}

if ( ! function_exists( 'tokoo_home_v5_products_carousel_1' ) ) {
	/**
	 * Displays Product Carousel in Home v5
	 */
	function tokoo_home_v5_products_carousel_1() {

		if ( tokoo_is_woocommerce_activated() ) {
			$home_v5 = tokoo_get_home_v5_meta();
			$pc      = $home_v5['pc'];

			$is_enabled = isset( $pc['is_enabled'] ) ? $pc['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $pc['animation'] ) ? $pc['animation'] : '';

			$args = array(
				'animation'      => $animation,
				'shortcode_atts' => isset( $home_v5['pc']['shortcode_content'] ) ? tokoo_get_atts_for_shortcode( $home_v5['pc']['shortcode_content'] ) : array(
					'columns' => '6',
					'limit'   => '8',
				),
				'header_args'    => array(
					'show_header'              => isset( $home_v5['pc']['show_header'] ) ? filter_var( $home_v5['pc']['show_header'], FILTER_VALIDATE_BOOLEAN ) : false,
					'section_title'            => isset( $home_v5['pc']['section_title'] ) ? $home_v5['pc']['section_title'] : esc_html__( 'Deals of the day', 'tokoo' ),
					'header_aside_action_text' => isset( $home_v5['pc']['header_aside_action_text'] ) ? $home_v5['pc']['header_aside_action_text'] : esc_html__( 'View All', 'tokoo' ),
					'header_aside_action_link' => isset( $home_v5['pc']['header_aside_action_link'] ) ? $home_v5['pc']['header_aside_action_link'] : '#',
				),
				'carousel_args'  => array(
					'slidesToShow'   => isset( $home_v5['pc']['carousel_args']['slidesToShow'] ) ? intval( $home_v5['pc']['carousel_args']['slidesToShow'] ) : 6,
					'slidesToScroll' => isset( $home_v5['pc']['carousel_args']['slidesToScroll'] ) ? intval( $home_v5['pc']['carousel_args']['slidesToScroll'] ) : 6,
					'dots'           => isset( $home_v5['pc']['carousel_args']['dots'] ) ? filter_var( $home_v5['pc']['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
					'arrows'         => isset( $home_v5['pc']['carousel_args']['arrows'] ) ? filter_var( $home_v5['pc']['carousel_args']['arrows'], FILTER_VALIDATE_BOOLEAN ) : true,
					'autoplay'       => isset( $home_v5['pc']['carousel_args']['autoplay'] ) ? filter_var( $home_v5['pc']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
					'responsive'     => array(
						array(
							'breakpoint' => 0,
							'settings'   => array(
								'slidesToShow'   => 2,
								'slidesToScroll' => 2,
							),
						),
						array(
							'breakpoint' => 576,
							'settings'   => array(
								'slidesToShow'   => 2,
								'slidesToScroll' => 2,
							),
						),
						array(
							'breakpoint' => 768,
							'settings'   => array(
								'slidesToShow'   => 2,
								'slidesToScroll' => 2,
							),
						),
						array(
							'breakpoint' => 992,
							'settings'   => array(
								'slidesToShow'   => 3,
								'slidesToScroll' => 3,
							),
						),
						array(
							'breakpoint' => 1200,
							'settings'   => array(
								'slidesToShow'   => 6,
								'slidesToScroll' => 6,
							),
						),
					),
				),
			);

			tokoo_products_carousel( $args );
		}
	}
}

if ( ! function_exists( 'tokoo_home_v5_banner' ) ) {
	/**
	 * Displays Home v5 Banner
	 */
	function tokoo_home_v5_banner() {

		$home_v5 = tokoo_get_home_v5_meta();
		$br      = $home_v5['br'];

		$is_enabled = isset( $br['is_enabled'] ) ? $br['is_enabled'] : 'no';

		if ( 'yes' !== $is_enabled ) {
			return;
		}

		$animation = isset( $br['animation'] ) ? $br['animation'] : '';
		$args      = apply_filters(
			'tokoo_home_v5_banner_args',
			array(
				'animation' => $animation,
				'img_src'   => ( isset( $home_v5['br']['image'] ) && 0 !== $home_v5['br']['image'] ) ? wp_get_attachment_url( $home_v5['br']['image'] ) : 'http://placehold.it/1170x301',
				'link'      => isset( $home_v5['br']['link'] ) ? $home_v5['br']['link'] : '#',
				'el_class'  => isset( $home_v5['br']['el_class'] ) ? $home_v5['br']['el_class'] : '',
			)
		);

		tokoo_banner( $args );
	}
}

if ( ! function_exists( 'tokoo_home_v5_flash_sale_block' ) ) {
	/**
	 * Displays Home v5 Flash Sale Block
	 */
	function tokoo_home_v5_flash_sale_block() {

		if ( tokoo_is_woocommerce_activated() ) {

			$home_v5 = tokoo_get_home_v5_meta();
			$fsc     = $home_v5['fsc'];

			$is_enabled = isset( $fsc['is_enabled'] ) ? $fsc['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $fsc['animation'] ) ? $fsc['animation'] : '';

			$args = array(
				'show_header'    => isset( $home_v5['fsc']['show_header'] ) ? filter_var( $home_v5['fsc']['show_header'], FILTER_VALIDATE_BOOLEAN ) : false,
				'section_title'  => isset( $home_v5['fsc']['section_title'] ) ? $home_v5['fsc']['section_title'] : wp_kses_post( __( 'Fla<i class="flaticon-flash"></i>h <br> sale', 'tokoo' ) ),
				'header_timer'   => isset( $home_v5['fsc']['header_timer'] ) ? filter_var( $home_v5['fsc']['header_timer'], FILTER_VALIDATE_BOOLEAN ) : false,
				'timer_title'    => isset( $home_v5['fsc']['timer_title'] ) ? $home_v5['fsc']['timer_title'] : esc_html__( 'Sales Ends in', 'tokoo' ),
				'timer_value'    => isset( $home_v5['fsc']['timer_value'] ) ? $home_v5['fsc']['timer_value'] : '+8 hours',
				'bg_img'         => ( isset( $home_v5['fsc']['bg_img'] ) && 0 !== $home_v5['fsc']['bg_img'] ) ? wp_get_attachment_url( $home_v5['fsc']['bg_img'] ) : 'http://placehold.it/1920x915',
				'shortcode_atts' => isset( $home_v5['fsc']['shortcode_content'] ) ? tokoo_get_atts_for_shortcode( $home_v5['fsc']['shortcode_content'] ) : array(
					'columns'  => '4',
					'per_page' => '24',
				),
				'carousel_args'  => array(
					'rows'           => isset( $home_v5['fsc']['carousel_args']['rows'] ) ? intval( $home_v5['fsc']['carousel_args']['rows'] ) : 2,
					'slidesPerRow'   => isset( $home_v5['fsc']['carousel_args']['slidesPerRow'] ) ? intval( $home_v5['fsc']['carousel_args']['slidesPerRow'] ) : 4,
					'slidesToShow'   => isset( $home_v5['fsc']['carousel_args']['slidesToShow'] ) ? intval( $home_v5['fsc']['carousel_args']['slidesToShow'] ) : 1,
					'slidesToScroll' => isset( $home_v5['fsc']['carousel_args']['slidesToScroll'] ) ? intval( $home_v5['fsc']['carousel_args']['slidesToScroll'] ) : 1,
					'dots'           => isset( $home_v5['fsc']['carousel_args']['dots'] ) ? filter_var( $home_v5['fsc']['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
					'arrows'         => isset( $home_v5['fsc']['carousel_args']['arrows'] ) ? filter_var( $home_v5['fsc']['carousel_args']['arrows'], FILTER_VALIDATE_BOOLEAN ) : false,
					'autoplay'       => isset( $home_v5['fsc']['carousel_args']['autoplay'] ) ? filter_var( $home_v5['fsc']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
					'responsive'     => array(
						array(
							'breakpoint' => 0,
							'settings'   => array(
								'slidesPerRow'   => 2,
								'slidesToShow'   => 1,
								'slidesToScroll' => 1,
							),
						),
						array(
							'breakpoint' => 576,
							'settings'   => array(
								'slidesPerRow'   => 2,
								'slidesToShow'   => 1,
								'slidesToScroll' => 2,
							),
						),
						array(
							'breakpoint' => 768,
							'settings'   => array(
								'slidesPerRow'   => 2,
								'slidesToShow'   => 1,
								'slidesToScroll' => 1,
							),
						),
						array(
							'breakpoint' => 992,
							'settings'   => array(
								'slidesPerRow'   => 3,
								'slidesToShow'   => 1,
								'slidesToScroll' => 1,
							),
						),
						array(
							'breakpoint' => 1200,
							'settings'   => array(
								'slidesPerRow'   => 4,
								'slidesToShow'   => 1,
								'slidesToScroll' => 1,
							),
						),
					),
				),
			);

			tokoo_flash_sale_block( $args );
		}
	}
}

if ( ! function_exists( 'tokoo_home_v5_products_1_8_block' ) ) {
	/**
	 * Displays 1-8 Block in Home v5
	 */
	function tokoo_home_v5_products_1_8_block() {

		if ( tokoo_is_woocommerce_activated() ) {
			$home_v5 = tokoo_get_home_v5_meta();
			$pb1     = $home_v5['pb1'];

			$is_enabled = isset( $pb1['is_enabled'] ) ? $pb1['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $pb1['animation'] ) ? $pb1['animation'] : '';

			$default_product_cat = get_option( 'default_product_cat' );

			$args = apply_filters(
				'tokoo_home_v5_products_1_8_block_args',
				array(
					'section_title'  => isset( $home_v5['pb1']['section_title'] ) ? $home_v5['pb1']['section_title'] : esc_html__( 'Best seller products on Gaming categories', 'tokoo' ),
					'show_cat_title' => isset( $home_v5['pb1']['show_cat_title'] ) ? filter_var( $home_v5['pb1']['show_cat_title'], FILTER_VALIDATE_BOOLEAN ) : false,
					'tab_title'      => isset( $home_v5['pb1']['tab_title'] ) ? $home_v5['pb1']['tab_title'] : esc_html__( 'Gaming', 'tokoo' ),
					'shortcode_atts' => isset( $home_v5['pb1']['shortcode_content'] ) ? tokoo_get_atts_for_shortcode( $home_v5['pb1']['shortcode_content'] ) : array(
						'columns' => '4',
						'limit'   => '9',
					),
					'category_args'  => array(
						'exclude'    => $default_product_cat,
						'number'     => isset( $home_v5['pb1']['number'] ) ? $home_v5['pb1']['number'] : 7,
						'slug'       => isset( $home_v5['pb1']['slug'] ) ? $home_v5['pb1']['slug'] : ( isset( $home_v5['pb1']['slugs'] ) ? $home_v5['pb1']['slugs'] : '' ),
						'hide_empty' => isset( $home_v5['pb1']['hide_empty'] ) ? filter_var( $home_v5['pb1']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : true,
					),
				)
			);

			tokoo_1_8_block( $args );
		}
	}
}

if ( ! function_exists( 'tokoo_home_v5_product_categories' ) ) {
	/**
	 * Displays Home v5 Product Categories
	 */
	function tokoo_home_v5_product_categories() {

		$home_v5 = tokoo_get_home_v5_meta();
		$cat     = $home_v5['cat'];

		$is_enabled = isset( $cat['is_enabled'] ) ? $cat['is_enabled'] : 'no';

		if ( 'yes' !== $is_enabled ) {
			return;
		}

		$animation = isset( $cat['animation'] ) ? $cat['animation'] : '';

		$args = apply_filters(
			'tokoo_home_v5_product_categories_args',
			array(
				'section_title' => isset( $home_v5['cat']['section_title'] ) ? $home_v5['cat']['section_title'] : esc_html__( 'Shop By Categories', 'tokoo' ),
				'category_args' => array(
					'number'     => isset( $home_v5['cat']['number'] ) ? $home_v5['cat']['number'] : '8',
					'columns'    => isset( $home_v5['cat']['columns'] ) ? $home_v5['cat']['columns'] : '4',
					'slug'       => isset( $home_v5['cat']['slug'] ) ? $home_v5['cat']['slug'] : ( isset( $home_v5['cat']['slugs'] ) ? $home_v5['cat']['slugs'] : '' ),
					'hide_empty' => isset( $home_v5['cat']['hide_empty'] ) ? filter_var( $home_v5['cat']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,

				),
			)
		);

		tokoo_product_categories( $args );
	}
}

if ( ! function_exists( 'tokoo_home_v5_brands_list' ) ) {
	/**
	 * Display brands carousel
	 */
	function tokoo_home_v5_brands_list() {

		if ( tokoo_is_woocommerce_activated() ) {

			$home_v5 = tokoo_get_home_v5_meta();
			$bc      = $home_v5['bc'];

			$is_enabled = isset( $bc['is_enabled'] ) ? $bc['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $bc['animation'] ) ? $bc['animation'] : '';

			$section_args = apply_filters(
				'tokoo_home_v5_brands_list_section_args',
				array(
					'animation'     => $animation,
					'section_title' => isset( $home_v5['bc']['section_title'] ) ? $home_v5['bc']['section_title'] : esc_html__( 'Our Official Brand', 'tokoo' ),
				)
			);

			$taxonomy_args = apply_filters(
				'tokoo_home_v5_brands_list_taxonomy_args',
				array(
					'orderby'    => isset( $home_v5['bc']['orderby'] ) ? $home_v5['bc']['orderby'] : 'title',
					'order'      => isset( $home_v5['bc']['order'] ) ? $home_v5['bc']['order'] : 'ASC',
					'number'     => isset( $home_v5['bc']['number'] ) ? $home_v5['bc']['number'] : 12,
					'columns'    => isset( $home_v5['bc']['columns'] ) ? $home_v5['bc']['columns'] : 6,
					'hide_empty' => isset( $home_v5['bc']['hide_empty'] ) ? filter_var( $home_v5['bc']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
				)
			);

			$carousel_args = apply_filters(
				'tokoo_home_v5_brands_list_carousel_args',
				array(
					'slidesToShow'   => isset( $home_v5['bc']['carousel_args']['slidesToShow'] ) ? intval( $home_v5['bc']['carousel_args']['slidesToShow'] ) : 6,
					'slidesToScroll' => isset( $home_v5['bc']['carousel_args']['slidesToScroll'] ) ? intval( $home_v5['bc']['carousel_args']['slidesToScroll'] ) : 1,
					'autoplay'       => isset( $home_v5['bc']['carousel_args']['autoplay'] ) ? filter_var( $home_v5['bc']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
					'infinite'       => isset( $home_v5['bc']['carousel_args']['infinite'] ) ? filter_var( $home_v5['bc']['carousel_args']['infinite'], FILTER_VALIDATE_BOOLEAN ) : false,
					'responsive'     => array(
						array(
							'breakpoint' => 767,
							'settings'   => array(
								'slidesToShow'   => 1,
								'slidesToScroll' => 1,
							),
						),
						array(
							'breakpoint' => 992,
							'settings'   => array(
								'slidesToShow'   => 3,
								'slidesToScroll' => 3,
							),
						),
						array(
							'breakpoint' => 1200,
							'settings'   => array(
								'slidesToShow'   => 6,
								'slidesToScroll' => 6,
							),
						),
					),

				)
			);

			tokoo_brands_carousel( $section_args, $taxonomy_args, $carousel_args );
		}
	}
}

if ( ! function_exists( 'tokoo_configure_home_v5_hooks' ) ) {
	/**
	 * Configure Home v5 Hooks
	 */
	function tokoo_configure_home_v5_hooks() {
		if ( is_page_template( array( 'template-homepage-v5.php' ) ) ) {
			remove_all_actions( 'tokoo_home_v5' );

			$home_v5 = tokoo_get_home_v5_meta();

			$is_enabled = isset( $home_v5['hpc']['is_enabled'] ) ? filter_var( $home_v5['hpc']['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

			if ( $is_enabled ) {
				add_action( 'tokoo_home_v5', 'tokoo_homepage_content', isset( $home_v5['hpc']['priority'] ) ? intval( $home_v5['hpc']['priority'] ) : 5 );
			}

			add_action( 'tokoo_home_v5', 'tokoo_home_v5_revslider', isset( $home_v5['sdr']['priority'] ) ? intval( $home_v5['sdr']['priority'] ) : 10 );
			add_action( 'tokoo_home_v5', 'tokoo_home_v5_features_list', isset( $home_v5['fl']['priority'] ) ? intval( $home_v5['fl']['priority'] ) : 20 );
			add_action( 'tokoo_home_v5', 'tokoo_home_v5_products_4_1_4_block', isset( $home_v5['pb2']['priority'] ) ? intval( $home_v5['pb2']['priority'] ) : 30 );
			add_action( 'tokoo_home_v5', 'tokoo_home_v5_products_carousel_2', isset( $home_v5['pc1']['priority'] ) ? intval( $home_v5['pc1']['priority'] ) : 40 );
			add_action( 'tokoo_home_v5', 'tokoo_home_v5_products_carousel_1', isset( $home_v5['pc']['priority'] ) ? intval( $home_v5['pc']['priority'] ) : 50 );
			add_action( 'tokoo_home_v5', 'tokoo_home_v5_banner', isset( $home_v5['br']['priority'] ) ? intval( $home_v5['br']['priority'] ) : 60 );
			add_action( 'tokoo_home_v5', 'tokoo_home_v5_flash_sale_block', isset( $home_v5['fsc']['priority'] ) ? intval( $home_v5['fsc']['priority'] ) : 70 );
			add_action( 'tokoo_home_v5', 'tokoo_home_v5_products_1_8_block', isset( $home_v5['pb1']['priority'] ) ? intval( $home_v5['pb1']['priority'] ) : 80 );
			add_action( 'tokoo_home_v5', 'tokoo_home_v5_product_categories', isset( $home_v5['cat']['priority'] ) ? intval( $home_v5['cat']['priority'] ) : 90 );
			add_action( 'tokoo_home_v5', 'tokoo_home_v5_brands_list', isset( $home_v5['bc']['priority'] ) ? intval( $home_v5['bc']['priority'] ) : 100 );
		}
	}
}
