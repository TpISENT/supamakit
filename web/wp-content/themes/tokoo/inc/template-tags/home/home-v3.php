<?php
/**
 * Template functions in Home v3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function tokoo_get_default_home_v3_options() {
	$home_v3 = array(
		'vscwf' => array(
			'is_enabled'       => 'yes',
			'priority'         => 10,
			'animation'        => '',
			'slider_shortcode' => '',
			'nav'              => array(
				'is_enabled'       => 'yes',
				'menu_title'       => esc_html__( 'Categories', 'tokoo' ),
				'menu_action_text' => esc_html__( 'View All', 'tokoo' ),
				'menu_action_link' => '#',
				'menu'             => 'vertical-menu',
			),
			'cat'              => array(
				'is_enabled' => 'yes',
				'number'     => 5,
				'columns'    => 5,
				'slug'       => '',
				'hide_empty' => 'yes',
			),
			'fl'               => array(
				'is_enabled'    => 'yes',
				'section_class' => 'style-1',
				'features'      => array(
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
		),
		'pc'    => array(
			'is_enabled'               => 'yes',
			'priority'                 => 30,
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
		'pc1'   => array(
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
		'br'    => array(
			'is_enabled' => 'yes',
			'priority'   => 50,
			'animation'  => '',
			'image'      => 0,
			'el_class'   => '',
			'link'       => '#',
		),
		'pb2'   => array(
			'is_enabled'               => 'yes',
			'priority'                 => 60,
			'animation'                => '',
			'show_header'              => 'yes',
			'header_aside_action_text' => esc_html__( 'View all', 'tokoo' ),
			'header_aside_action_link' => '#',
			'section_title'            => esc_html__( 'New Arrivals', 'tokoo' ),
			'shortcode_content'        => array(
				'shortcode'      => 'featured_products',
				'shortcode_atts' => array(
					'columns'  => '2',
					'per_page' => '9',
				),
			),
		),
		'pb1'   => array(
			'is_enabled'        => 'yes',
			'priority'          => 70,
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
		'fsc'   => array(
			'is_enabled'        => 'yes',
			'priority'          => 80,
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
		'cat'   => array(
			'is_enabled'    => 'yes',
			'priority'      => 90,
			'animation'     => '',
			'section_title' => esc_html__( 'Shop by Categories', 'tokoo' ),
			'number'        => 12,
			'columns'       => 4,
			'slug'          => '',
			'hide_empty'    => 'yes',
		),
		'bc'    => array(
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

	return apply_filters( 'tokoo_get_default_home_v3_options', $home_v3 );
}

function tokoo_get_home_v3_meta( $merge_default = true ) {
	global $post;

	if ( isset( $post->ID ) ) {

		$clean_home_v3_options = get_post_meta( $post->ID, '_home_v3_options', true );
		$home_v3_options       = maybe_unserialize( $clean_home_v3_options );

		if ( ! is_array( $home_v3_options ) ) {
			$home_v3_options = json_decode( $clean_home_v3_options, true );
		}

		if ( $merge_default ) {
			$default_options = tokoo_get_default_home_v3_options();
			$home_v3         = wp_parse_args( $home_v3_options, $default_options );
		} else {
			$home_v3 = $home_v3_options;
		}

		return apply_filters( 'tokoo_home_v3_meta', $home_v3, $post );
	}
}

if ( ! function_exists( 'tokoo_home_v3_revslider' ) ) {
	/**
	 * Displays Slider in Home v3
	 */
	function tokoo_home_v3_revslider() {

		$home_v3 = tokoo_get_home_v3_meta();
		$vscwf   = $home_v3['vscwf'];

		$is_enabled = isset( $vscwf['is_enabled'] ) ? filter_var( $vscwf['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

		if ( ! $is_enabled ) {
			return;
		}

		$animation = isset( $vscwf['animation'] ) ? $vscwf['animation'] : '';
		$shortcode = ! empty( $vscwf['slider_shortcode'] ) ? $vscwf['slider_shortcode'] : '[rev_slider alias="home-v3-slider"]';

		$section_class = 'home-v3-slider';
		if ( ! empty( $animation ) ) {
			$section_class = ' animate-in-view';
		}
		?>
		<div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>
			data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
			<?php echo apply_filters( 'tokoo_home_v3_slider_html', do_shortcode( $shortcode ) ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_home_v3_vertical_menu_slider_category_with_features' ) ) {
	function tokoo_home_v3_vertical_menu_slider_category_with_features() {

		$home_v3       = tokoo_get_home_v3_meta();
		$vscwf_options = $home_v3['vscwf'];
		$nav_options   = $vscwf_options['nav'];
		$cat_options   = $vscwf_options['cat'];
		$fl_options    = $vscwf_options['fl'];

		$is_enabled = isset( $vscwf_options['is_enabled'] ) ? $vscwf_options['is_enabled'] : 'no';

		if ( 'yes' !== $is_enabled ) {
			return;
		}

		$animation = isset( $vscwf_options['animation'] ) ? $vscwf_options['animation'] : '';

		$nav_args = apply_filters(
			'tokoo_home_v3_vertical_nav_menu_args',
			array(
				'animation'        => $animation,
				'is_enabled'       => isset( $nav_options['is_enabled'] ) ? $nav_options['is_enabled'] : 'yes',
				'menu_title'       => isset( $nav_options['menu_title'] ) ? $nav_options['menu_title'] : esc_html__( 'Categories', 'tokoo' ),
				'menu_action_text' => isset( $nav_options['menu_action_text'] ) ? $nav_options['menu_action_text'] : esc_html__( 'View All', 'tokoo' ),
				'menu_action_link' => isset( $nav_options['menu_action_link'] ) ? $nav_options['menu_action_link'] : '#',
				'menu'             => isset( $nav_options['menu'] ) ? $nav_options['menu'] : 'vertical-menu',
			)
		);

		$cat_args = apply_filters(
			'tokoo_home_v3_slider_with_category_cat_args',
			array(
				'animation'     => $animation,
				'is_enabled'    => isset( $cat_options['is_enabled'] ) ? $cat_options['is_enabled'] : 'yes',
				'category_args' => array(
					'number'     => isset( $cat_options['number'] ) ? $cat_options['number'] : '5',
					'columns'    => isset( $cat_options['columns'] ) ? $cat_options['columns'] : '5',
					'slug'       => isset( $cat_options['slug'] ) ? $cat_options['slug'] : ( isset( $cat_options['slugs'] ) ? $cat_options['slugs'] : '' ),
					'hide_empty' => isset( $cat_options['hide_empty'] ) ? filter_var( $cat_options['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
				),
			)
		);

		$fl_args = array(
			'animation'     => $animation,
			'is_enabled'    => isset( $fl_options['is_enabled'] ) ? $fl_options['is_enabled'] : 'yes',
			'section_class' => isset( $fl_options['section_class'] ) ? $fl_options['section_class'] : 'style-1',
			'features'      => array(),
		);

		foreach ( $fl_options['features'] as $key => $feature ) {

			if ( isset( $feature['icon'] ) && isset( $feature['label'] ) ) {
				$fl_args['features'][] = array(
					'icon'  => $feature['icon'],
					'label' => $feature['label'],
				);
			}
		}

		$nav_is_enabled = isset( $nav_options['is_enabled'] ) ? $nav_options['is_enabled'] : 'no';

		$slider_cat_section_class = ( 'yes' !== $nav_is_enabled ) ? 'slider-with-catogory slider-with-catogory-stretch' : 'slider-with-catogory';

		$cat_is_enabled = isset( $cat_options['is_enabled'] ) ? $cat_options['is_enabled'] : 'no';
		$fl_is_enabled  = isset( $fl_options['is_enabled'] ) ? $fl_options['is_enabled'] : 'no';

		?>
		<div class="vertical-menu-slider-category-with-features">
			<div class="container">
				<div class="vertical-menu-slider-category">
					<?php
					if ( 'yes' === $nav_is_enabled ) :
						tokoo_vertical_nav( $nav_args );
					endif;
					?>

					<div class=" <?php echo esc_attr( $slider_cat_section_class ); ?>">
						<?php
						tokoo_home_v3_revslider();
						if ( 'yes' === $cat_is_enabled ) :
							tokoo_category_block( $cat_args );
						endif;
						?>
					</div>
				</div>

				<?php if ( 'yes' === $fl_is_enabled ) : ?>
					<div class="slider-feature-list">
						<?php tokoo_features_list( $fl_args ); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_home_v3_products_carousel_1' ) ) {
	function tokoo_home_v3_products_carousel_1() {

		if ( tokoo_is_woocommerce_activated() ) {
			$home_v3 = tokoo_get_home_v3_meta();
			$pc      = $home_v3['pc'];

			$is_enabled = isset( $pc['is_enabled'] ) ? $pc['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $pc['animation'] ) ? $pc['animation'] : '';

			$args = array(
				'animation'      => $animation,
				'shortcode_atts' => isset( $home_v3['pc']['shortcode_content'] ) ? tokoo_get_atts_for_shortcode( $home_v3['pc']['shortcode_content'] ) : array(
					'columns' => '6',
					'limit'   => '8',
				),
				'header_args'    => array(
					'show_header'              => isset( $home_v3['pc']['show_header'] ) ? filter_var( $home_v3['pc']['show_header'], FILTER_VALIDATE_BOOLEAN ) : false,
					'section_title'            => isset( $home_v3['pc']['section_title'] ) ? $home_v3['pc']['section_title'] : esc_html__( 'Deals of the day', 'tokoo' ),
					'header_aside_action_text' => isset( $home_v3['pc']['header_aside_action_text'] ) ? $home_v3['pc']['header_aside_action_text'] : esc_html__( 'View All', 'tokoo' ),
					'header_aside_action_link' => isset( $home_v3['pc']['header_aside_action_link'] ) ? $home_v3['pc']['header_aside_action_link'] : '#',
				),
				'carousel_args'  => array(
					'slidesToShow'   => isset( $home_v3['pc']['carousel_args']['slidesToShow'] ) ? intval( $home_v3['pc']['carousel_args']['slidesToShow'] ) : 6,
					'slidesToScroll' => isset( $home_v3['pc']['carousel_args']['slidesToScroll'] ) ? intval( $home_v3['pc']['carousel_args']['slidesToScroll'] ) : 6,
					'dots'           => isset( $home_v3['pc']['carousel_args']['dots'] ) ? filter_var( $home_v3['pc']['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
					'arrows'         => isset( $home_v3['pc']['carousel_args']['arrows'] ) ? filter_var( $home_v3['pc']['carousel_args']['arrows'], FILTER_VALIDATE_BOOLEAN ) : true,
					'autoplay'       => isset( $home_v3['pc']['carousel_args']['autoplay'] ) ? filter_var( $home_v3['pc']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
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

if ( ! function_exists( 'tokoo_home_v3_products_carousel_2' ) ) {
	function tokoo_home_v3_products_carousel_2() {

		if ( tokoo_is_woocommerce_activated() ) {
			$home_v3 = tokoo_get_home_v3_meta();
			$pc1     = $home_v3['pc1'];

			$is_enabled = isset( $pc1['is_enabled'] ) ? $pc1['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $pc1['animation'] ) ? $pc1['animation'] : '';

			$args = array(
				'animation'      => $animation,
				'shortcode_atts' => isset( $home_v3['pc1']['shortcode_content'] ) ? tokoo_get_atts_for_shortcode( $home_v3['pc1']['shortcode_content'] ) : array(
					'columns' => '6',
					'limit'   => '8',
				),
				'header_args'    => array(
					'show_header'              => isset( $home_v3['pc1']['show_header'] ) ? filter_var( $home_v3['pc1']['show_header'], FILTER_VALIDATE_BOOLEAN ) : false,
					'section_title'            => isset( $home_v3['pc1']['section_title'] ) ? $home_v3['pc1']['section_title'] : esc_html__( 'Deals of the day', 'tokoo' ),
					'header_aside_action_text' => isset( $home_v3['pc1']['header_aside_action_text'] ) ? $home_v3['pc1']['header_aside_action_text'] : esc_html__( 'View All', 'tokoo' ),
					'header_aside_action_link' => isset( $home_v3['pc1']['header_aside_action_link'] ) ? $home_v3['pc1']['header_aside_action_link'] : '#',
				),
				'carousel_args'  => array(
					'slidesToShow'   => isset( $home_v3['pc1']['carousel_args']['slidesToShow'] ) ? intval( $home_v3['pc1']['carousel_args']['slidesToShow'] ) : 6,
					'slidesToScroll' => isset( $home_v3['pc1']['carousel_args']['slidesToScroll'] ) ? intval( $home_v3['pc1']['carousel_args']['slidesToScroll'] ) : 6,
					'dots'           => isset( $home_v3['pc1']['carousel_args']['dots'] ) ? filter_var( $home_v3['pc1']['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
					'arrows'         => isset( $home_v3['pc1']['carousel_args']['arrows'] ) ? filter_var( $home_v3['pc1']['carousel_args']['arrows'], FILTER_VALIDATE_BOOLEAN ) : true,
					'autoplay'       => isset( $home_v3['pc1']['carousel_args']['autoplay'] ) ? filter_var( $home_v3['pc1']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
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

if ( ! function_exists( 'tokoo_home_v3_banner' ) ) {
	function tokoo_home_v3_banner() {

		$home_v3 = tokoo_get_home_v3_meta();
		$br      = $home_v3['br'];

		$is_enabled = isset( $br['is_enabled'] ) ? $br['is_enabled'] : 'no';

		if ( 'yes' !== $is_enabled ) {
			return;
		}

		$animation = isset( $br['animation'] ) ? $br['animation'] : '';
		$args      = apply_filters(
			'tokoo_home_v3_banner_args',
			array(
				'animation' => $animation,
				'img_src'   => ( isset( $home_v3['br']['image'] ) && 0 !== $home_v3['br']['image'] ) ? wp_get_attachment_url( $home_v3['br']['image'] ) : 'http://placehold.it/1170x301',
				'link'      => isset( $home_v3['br']['link'] ) ? $home_v3['br']['link'] : '#',
				'el_class'  => isset( $home_v3['br']['el_class'] ) ? $home_v3['br']['el_class'] : '',
			)
		);

		tokoo_banner( $args );
	}
}

if ( ! function_exists( 'tokoo_home_v3_products_4_1_4_block' ) ) {
	function tokoo_home_v3_products_4_1_4_block() {

		if ( tokoo_is_woocommerce_activated() ) {
			$home_v3 = tokoo_get_home_v3_meta();
			$pb2     = $home_v3['pb2'];

			$is_enabled = isset( $pb2['is_enabled'] ) ? $pb2['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $pb2['animation'] ) ? $pb2['animation'] : '';

			$args = apply_filters(
				'tokoo_home_v3_products_4_1_4_block_args',
				array(
					'animation'      => $animation,
					'shortcode_atts' => isset( $home_v3['pb2']['shortcode_content'] ) ? tokoo_get_atts_for_shortcode( $home_v3['pb2']['shortcode_content'] ) : array(
						'columns' => '2',
						'limit'   => '9',
					),
					'header_args'    => array(
						'show_header'              => isset( $home_v3['pb2']['show_header'] ) ? filter_var( $home_v3['pb2']['show_header'], FILTER_VALIDATE_BOOLEAN ) : false,
						'section_title'            => isset( $home_v3['pb2']['section_title'] ) ? $home_v3['pb2']['section_title'] : esc_html__( 'New Arrivals', 'tokoo' ),
						'header_aside_action_text' => isset( $home_v3['pb2']['header_aside_action_text'] ) ? $home_v3['pb2']['header_aside_action_text'] : esc_html__( 'View All', 'tokoo' ),
						'header_aside_action_link' => isset( $home_v3['pb2']['header_aside_action_link'] ) ? $home_v3['pb2']['header_aside_action_link'] : '#',
					),

				)
			);

			tokoo_4_1_4_block( $args );
		}
	}
}

if ( ! function_exists( 'tokoo_home_v3_products_1_8_block' ) ) {
	function tokoo_home_v3_products_1_8_block() {

		if ( tokoo_is_woocommerce_activated() ) {
			$home_v3 = tokoo_get_home_v3_meta();
			$pb1     = $home_v3['pb1'];

			$is_enabled = isset( $pb1['is_enabled'] ) ? $pb1['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $pb1['animation'] ) ? $pb1['animation'] : '';

			$default_product_cat = get_option( 'default_product_cat' );

			$args = apply_filters(
				'tokoo_home_v3_products_1_8_block_args',
				array(
					'section_title'  => isset( $home_v3['pb1']['section_title'] ) ? $home_v3['pb1']['section_title'] : esc_html__( 'Best seller products on Gaming categories', 'tokoo' ),
					'show_cat_title' => isset( $home_v3['pb1']['show_cat_title'] ) ? filter_var( $home_v3['pb1']['show_cat_title'], FILTER_VALIDATE_BOOLEAN ) : false,
					'tab_title'      => isset( $home_v3['pb1']['tab_title'] ) ? $home_v3['pb1']['tab_title'] : esc_html__( 'Gaming', 'tokoo' ),
					'shortcode_atts' => isset( $home_v3['pb1']['shortcode_content'] ) ? tokoo_get_atts_for_shortcode( $home_v3['pb1']['shortcode_content'] ) : array(
						'columns' => '4',
						'limit'   => '9',
					),
					'category_args'  => array(
						'exclude'    => $default_product_cat,
						'number'     => isset( $home_v3['pb1']['number'] ) ? $home_v3['pb1']['number'] : 7,
						'slug'       => isset( $home_v3['pb1']['slug'] ) ? $home_v3['pb1']['slug'] : ( isset( $home_v3['pb1']['slugs'] ) ? $home_v3['pb1']['slugs'] : '' ),
						'hide_empty' => isset( $home_v3['pb1']['hide_empty'] ) ? filter_var( $home_v3['pb1']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : true,
					),
				)
			);
			tokoo_1_8_block( $args );
		}
	}
}

if ( ! function_exists( 'tokoo_home_v3_flash_sale_block' ) ) {
	function tokoo_home_v3_flash_sale_block() {

		if ( tokoo_is_woocommerce_activated() ) {

			$home_v3 = tokoo_get_home_v3_meta();
			$fsc     = $home_v3['fsc'];

			$is_enabled = isset( $fsc['is_enabled'] ) ? $fsc['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $fsc['animation'] ) ? $fsc['animation'] : '';

			$args = array(
				'show_header'    => isset( $home_v3['fsc']['show_header'] ) ? filter_var( $home_v3['fsc']['show_header'], FILTER_VALIDATE_BOOLEAN ) : false,
				'section_title'  => isset( $home_v3['fsc']['section_title'] ) ? $home_v3['fsc']['section_title'] : wp_kses_post( __( 'Fla<i class="flaticon-flash"></i>h <br> sale', 'tokoo' ) ),
				'header_timer'   => isset( $home_v3['fsc']['header_timer'] ) ? filter_var( $home_v3['fsc']['header_timer'], FILTER_VALIDATE_BOOLEAN ) : false,
				'timer_title'    => isset( $home_v3['fsc']['timer_title'] ) ? $home_v3['fsc']['timer_title'] : esc_html__( 'Sales Ends in', 'tokoo' ),
				'timer_value'    => isset( $home_v3['fsc']['timer_value'] ) ? $home_v3['fsc']['timer_value'] : '+8 hours',
				'bg_img'         => ( isset( $home_v3['fsc']['bg_img'] ) && 0 !== $home_v3['fsc']['bg_img'] ) ? wp_get_attachment_url( $home_v3['fsc']['bg_img'] ) : 'http://placehold.it/1920x915',
				'shortcode_atts' => isset( $home_v3['fsc']['shortcode_content'] ) ? tokoo_get_atts_for_shortcode( $home_v3['fsc']['shortcode_content'] ) : array(
					'columns'  => '4',
					'per_page' => '24',
				),
				'carousel_args'  => array(
					'rows'           => isset( $home_v3['fsc']['carousel_args']['rows'] ) ? intval( $home_v3['fsc']['carousel_args']['rows'] ) : 2,
					'slidesPerRow'   => isset( $home_v3['fsc']['carousel_args']['slidesPerRow'] ) ? intval( $home_v3['fsc']['carousel_args']['slidesPerRow'] ) : 4,
					'slidesToShow'   => isset( $home_v3['fsc']['carousel_args']['slidesToShow'] ) ? intval( $home_v3['fsc']['carousel_args']['slidesToShow'] ) : 1,
					'slidesToScroll' => isset( $home_v3['fsc']['carousel_args']['slidesToScroll'] ) ? intval( $home_v3['fsc']['carousel_args']['slidesToScroll'] ) : 1,
					'dots'           => isset( $home_v3['fsc']['carousel_args']['dots'] ) ? filter_var( $home_v3['fsc']['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
					'arrows'         => isset( $home_v3['fsc']['carousel_args']['arrows'] ) ? filter_var( $home_v3['fsc']['carousel_args']['arrows'], FILTER_VALIDATE_BOOLEAN ) : false,
					'autoplay'       => isset( $home_v3['fsc']['carousel_args']['autoplay'] ) ? filter_var( $home_v3['fsc']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
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

if ( ! function_exists( 'tokoo_home_v3_product_categories' ) ) {
	function tokoo_home_v3_product_categories() {

		$home_v3 = tokoo_get_home_v3_meta();
		$cat     = $home_v3['cat'];

		$is_enabled = isset( $cat['is_enabled'] ) ? $cat['is_enabled'] : 'no';

		if ( 'yes' !== $is_enabled ) {
			return;
		}

		$animation = isset( $cat['animation'] ) ? $cat['animation'] : '';

		$args = apply_filters(
			'tokoo_home_v3_product_categories_args',
			array(
				'section_title' => isset( $home_v3['cat']['section_title'] ) ? $home_v3['cat']['section_title'] : esc_html__( 'Shop By Categories', 'tokoo' ),
				'category_args' => array(
					'number'     => isset( $home_v3['cat']['number'] ) ? $home_v3['cat']['number'] : '8',
					'columns'    => isset( $home_v3['cat']['columns'] ) ? $home_v3['cat']['columns'] : '4',
					'slug'       => isset( $home_v3['cat']['slug'] ) ? $home_v3['cat']['slug'] : ( isset( $home_v3['cat']['slugs'] ) ? $home_v3['cat']['slugs'] : '' ),
					'hide_empty' => isset( $home_v3['cat']['hide_empty'] ) ? filter_var( $home_v3['cat']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
				),
			)
		);

		tokoo_product_categories( $args );
	}
}

if ( ! function_exists( 'tokoo_home_v3_brands_list' ) ) {
	/**
	 * Display brands carousel
	 */
	function tokoo_home_v3_brands_list() {

		if ( tokoo_is_woocommerce_activated() ) {

			$home_v3 = tokoo_get_home_v3_meta();
			$bc      = $home_v3['bc'];

			$is_enabled = isset( $bc['is_enabled'] ) ? $bc['is_enabled'] : 'no';

			if ( 'yes' !== $is_enabled ) {
				return;
			}

			$animation = isset( $bc['animation'] ) ? $bc['animation'] : '';

			$section_args = apply_filters(
				'tokoo_home_v3_brands_list_section_args',
				array(
					'animation'     => $animation,
					'section_title' => isset( $home_v3['bc']['section_title'] ) ? $home_v3['bc']['section_title'] : esc_html__( 'Our Official Brand', 'tokoo' ),
				)
			);

			$taxonomy_args = apply_filters(
				'tokoo_home_v3_brands_list_taxonomy_args',
				array(
					'orderby'    => isset( $home_v3['bc']['orderby'] ) ? $home_v3['bc']['orderby'] : 'title',
					'order'      => isset( $home_v3['bc']['order'] ) ? $home_v3['bc']['order'] : 'ASC',
					'number'     => isset( $home_v3['bc']['number'] ) ? $home_v3['bc']['number'] : 12,
					'columns'    => isset( $home_v3['bc']['columns'] ) ? $home_v3['bc']['columns'] : 6,
					'hide_empty' => isset( $home_v3['bc']['hide_empty'] ) ? filter_var( $home_v3['bc']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
				)
			);

			$carousel_args = apply_filters(
				'tokoo_home_v3_brands_list_carousel_args',
				array(
					'slidesToShow'   => isset( $home_v3['bc']['carousel_args']['slidesToShow'] ) ? intval( $home_v3['bc']['carousel_args']['slidesToShow'] ) : 6,
					'slidesToScroll' => isset( $home_v3['bc']['carousel_args']['slidesToScroll'] ) ? intval( $home_v3['bc']['carousel_args']['slidesToScroll'] ) : 1,
					'autoplay'       => isset( $home_v3['bc']['carousel_args']['autoplay'] ) ? filter_var( $home_v3['bc']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
					'infinite'       => isset( $home_v3['bc']['carousel_args']['infinite'] ) ? filter_var( $home_v3['bc']['carousel_args']['infinite'], FILTER_VALIDATE_BOOLEAN ) : false,
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

if ( ! function_exists( 'tokoo_configure_home_v3_hooks' ) ) {
	function tokoo_configure_home_v3_hooks() {
		if ( is_page_template( array( 'template-homepage-v3.php' ) ) ) {
			remove_all_actions( 'tokoo_home_v3' );

			$home_v3 = tokoo_get_home_v3_meta();

			$is_enabled = isset( $home_v3['hpc']['is_enabled'] ) ? filter_var( $home_v3['hpc']['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

			if ( $is_enabled ) {
				add_action( 'tokoo_home_v3', 'tokoo_homepage_content', isset( $home_v3['hpc']['priority'] ) ? intval( $home_v3['hpc']['priority'] ) : 5 );
			}

			add_action( 'tokoo_home_v3', 'tokoo_home_v3_vertical_menu_slider_category_with_features', isset( $home_v3['swc']['priority'] ) ? intval( $home_v3['swc']['priority'] ) : 10 );
			add_action( 'tokoo_home_v3', 'tokoo_home_v3_products_carousel_1', isset( $home_v3['pc']['priority'] ) ? intval( $home_v3['pc']['priority'] ) : 30 );
			add_action( 'tokoo_home_v3', 'tokoo_home_v3_products_carousel_2', isset( $home_v3['pc1']['priority'] ) ? intval( $home_v3['pc1']['priority'] ) : 40 );
			add_action( 'tokoo_home_v3', 'tokoo_home_v3_banner', isset( $home_v3['br']['priority'] ) ? intval( $home_v3['br']['priority'] ) : 50 );
			add_action( 'tokoo_home_v3', 'tokoo_home_v3_products_4_1_4_block', isset( $home_v3['pb2']['priority'] ) ? intval( $home_v3['pb2']['priority'] ) : 60 );
			add_action( 'tokoo_home_v3', 'tokoo_home_v3_products_1_8_block', isset( $home_v3['pb1']['priority'] ) ? intval( $home_v3['pb1']['priority'] ) : 70 );
			add_action( 'tokoo_home_v3', 'tokoo_home_v3_flash_sale_block', isset( $home_v3['fsc']['priority'] ) ? intval( $home_v3['fsc']['priority'] ) : 80 );
			add_action( 'tokoo_home_v3', 'tokoo_home_v3_product_categories', isset( $home_v3['cat']['priority'] ) ? intval( $home_v3['cat']['priority'] ) : 90 );
			add_action( 'tokoo_home_v3', 'tokoo_home_v3_brands_list', isset( $home_v3['bc']['priority'] ) ? intval( $home_v3['bc']['priority'] ) : 100 );
		}
	}
}
