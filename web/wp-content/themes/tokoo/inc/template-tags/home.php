<?php

require_once get_template_directory() . '/inc/template-tags/home/home-v1.php';
require_once get_template_directory() . '/inc/template-tags/home/home-v2.php';
require_once get_template_directory() . '/inc/template-tags/home/home-v3.php';
require_once get_template_directory() . '/inc/template-tags/home/home-v4.php';
require_once get_template_directory() . '/inc/template-tags/home/home-v5.php';

if ( ! function_exists( 'tokoo_products_carousel' ) ) {
	function tokoo_products_carousel( $args = array() ) {

		$defaults = apply_filters(
			'tokoo_products_carousel_args',
			array(
				'header_args'    => array(
					'show_header'   => true,
					'section_title' => '',
					'header_aside'  => '',
				),
				'shortcode_atts' => array(
					'columns' => '6',
					'limit'   => '8',
				),
				'carousel_args'  => array(
					'slidesToShow'   => 6,
					'slidesToScroll' => 4,
					'infinite'       => false,
					'autoplay'       => false,
				),
			)
		);

		$args = wp_parse_args( $args, $defaults );

		if ( is_rtl() ) {
			$args['carousel_args']['rtl'] = true;
			if ( isset( $args['carousel_args']['prevArrow'] ) && isset( $args['carousel_args']['nextArrow'] ) ) {
				$carousel_args_temp_arrow           = $args['carousel_args']['prevArrow'];
				$args['carousel_args']['prevArrow'] = $args['carousel_args']['nextArrow'];
				$args['carousel_args']['nextArrow'] = $carousel_args_temp_arrow;
			}
		}

		$args['carousel_args'] = apply_filters( 'tokoo_get_products_carousel_carousel_args', $args['carousel_args'] );

		if ( ! isset( $args['shortcode_atts']['columns'] ) && isset( $args['carousel_args']['slidesToShow'] ) ) {
			$args['shortcode_atts']['columns'] = $args['carousel_args']['slidesToShow'];
		}

		?><section class="section-products-carousel">

			<?php if ( $args['header_args']['show_header'] ) : ?>
				<header class="flex-header">
					<?php if ( ! empty( $args['header_args']['section_title'] ) ) : ?>
					<h2 class="section-title"><?php echo wp_kses_post( $args['header_args']['section_title'] ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $args['header_args']['header_aside_action_text'] ) ) : ?>
					<div class="header-aside">
						<a href="<?php echo esc_url( $args['header_args']['header_aside_action_link'] ); ?>"><?php echo wp_kses_post( $args['header_args']['header_aside_action_text'] ); ?></a>
					</div>
					<?php endif; ?>
				</header>
			<?php endif; ?>

			<div class="products-carousel-wrap" data-ride="tk-slick-carousel" data-wrap=".products" data-slick="<?php echo esc_attr( json_encode( $args['carousel_args'] ), ENT_QUOTES, 'UTF-8' ); ?>">
				<?php echo tokoo_do_shortcode( 'products', $args['shortcode_atts'] ); ?>
			</div>
		</section>
		<?php
	}
}

if ( ! function_exists( 'tokoo_banner' ) ) {
	function tokoo_banner( $args = array() ) {

		$defaults = apply_filters(
			'tokoo_banner_args',
			array(
				'img_src'  => '//placehold.it/1170xx301',
				'img_alt'  => '',
				'link'     => '#',
				'el_class' => '',
			)
		);

		$args = wp_parse_args( $args, $defaults );

		extract( $args );

		$el_class = empty( $el_class ) ? 'banner section' : $el_class . ' banner section';
		?>
		<div class="<?php echo esc_attr( $el_class ); ?>">
			<a href="<?php echo esc_url( $link ); ?>" class="tokoo-banner-link">
				<img src="<?php echo esc_url( $img_src ); ?>" class="img-fluid" alt="<?php echo esc_attr( $img_alt ); ?>">
			</a>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_product_categories' ) ) {
	function tokoo_product_categories( $args = array() ) {
		if ( class_exists( 'Tokoo_Products' ) ) {
			$defaults = apply_filters(
				'tokoo_product_categories_args',
				array(
					'section_title' => esc_html__( 'Shop By Categories', 'tokoo' ),
					'category_args' => array(
						'number'     => '8',
						'columns'    => '4',
						'slug'       => '',
						'hide_empty' => 'true',
					),
				)
			);
			$args     = wp_parse_args( $args, $defaults );

			$category_args      = tokoo_get_atts_for_taxonomy_slugs( $args['category_args'] );
			$categories         = get_terms( 'product_cat', $category_args );
			$args['categories'] = $categories;

			?>

			<section class="section-home-product-categories">
				<header>
					<?php if ( ! empty( $args['section_title'] ) ) : ?>
						<h2 class="section-title"><?php echo esc_html( $args['section_title'] ); ?></h2>
					<?php endif; ?>
				</header>
				<div class="home-product-categories">
				   <?php echo Tokoo_Products::product_categories( $category_args ); ?>
			   </div>
			</section>
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_1_8_block' ) ) {
	function tokoo_1_8_block( $args = array() ) {
		if ( class_exists( 'Tokoo_Products' ) ) {
			$default_args = apply_filters(
				'tokoo_1_8_block_args',
				array(
					'section_title'  => esc_html__( 'Best Seller Products on Gaming Categories', 'tokoo' ),
					'tab_title'      => esc_html__( 'Gaming', 'tokoo' ),
					'shortcode_atts' => array(
						'columns' => '4',
						'limit'   => '9',
					),
					'category_args'  => array(
						'number'     => '8',
						'slug'       => '',
						'hide_empty' => true,
					),
				)
			);

			$args                               = wp_parse_args( $args, $default_args );
			$args['shortcode_atts']['per_page'] = 9;
			$args['shortcode_atts']['columns']  = 4;
			$products                           = Tokoo_Products::products( $args['shortcode_atts'] );

			$cat_args   = tokoo_get_atts_for_taxonomy_slugs( $args['category_args'] );
			$categories = get_terms( 'product_cat', $cat_args );

			?>
			<section class="products-1-8">
				<?php if ( ! empty( $categories ) ) : ?>

					<?php if ( $args['show_cat_title'] ) : ?>

						<ul class="nav nav-inline categories-nav nav-justified">
							<?php if ( ! empty( $args['tab_title'] ) ) : ?>
								<li class="nav-item"><a href="#" class="active nav-link"><?php echo esc_html( $args['tab_title'] ); ?></a></li>
							<?php endif; ?>

							<?php
							if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
								foreach ( $categories as $category ) :
									?>
									<li class="nav-item"><a class="nav-link" href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
									<?php
								endforeach;
							endif;
							?>
						</ul>
					<?php endif; ?>

				<?php endif; ?>

				<?php if ( ! empty( $args['section_title'] ) ) : ?>
				<header class="section-header">
					<h2 class="section-title"><?php echo esc_html( $args['section_title'] ); ?></h2>
				</header>
				<?php endif; ?>

				<?php if ( ! empty( $products ) ) : ?>

				<div class="columns-1-8">
					<div class="products-8">
						<ul class="products columns-4">
							<?php
							$products_count = 0;

							if ( $products->have_posts() ) {

								$_post = $GLOBALS['post'];

								while ( $products->have_posts() ) :
									$products->the_post();

									global $post;

									if ( is_int( $post ) ) {
										$GLOBALS['post'] = get_post( $post );
										setup_postdata( $GLOBALS['post'] );
									}

									if ( $products_count == 8 ) {
										echo '</ul></div>';
										echo '<div class="product-main-1-8 "><ul class="product-main-1-8 products columns-1">';
										tokoo_add_1_8_main_product_hooks();
									}

									wc_get_template_part( 'content', 'product' );

									if ( $products_count == 8 ) {
										tokoo_remove_1_8_main_product_hooks();
									}

									$products_count++;

									endwhile;

								$GLOBALS['post'] = $_post;

							}

								woocommerce_reset_loop();
								wp_reset_postdata();
							?>
						</ul>
					</div>
				</div>


				<a class="view-products" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
					<?php esc_html_e( 'View all Products', 'tokoo' ); ?>
				</a>
				<?php endif; ?>
			</section>
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_flash_sale_block' ) ) {
	function tokoo_flash_sale_block( $args = array() ) {

		$default_args = apply_filters(
			'tokoo_flash_sale_block_args',
			array(
				'show_header'    => true,
				'section_title'  => wp_kses_post( __( 'Fla<i class="flaticon-flash"></i>h <br> sale', 'tokoo' ) ),
				'header_timer'   => true,
				'timer_title'    => esc_html__( 'Sales Ends in', 'tokoo' ),
				'timer_value'    => '',
				'bg_img'         => '//placehold.it/1920x915',
				'shortcode_atts' => array(
					'columns' => '4',
					'limit'   => '8',
				),
				'carousel_args'  => array(
					'rows'           => '',
					'slidesPerRow'   => '',
					'slidesToShow'   => '',
					'slidesToScroll' => '',
					'arrows'         => false,
					'dots'           => true,
					'infinite'       => false,
					'autoplay'       => false,
				),

			)
		);

		$args = wp_parse_args( $args, $default_args );

		if ( is_rtl() ) {
			$args ['carousel_args']['rtl'] = true;
		}

		?>
		<section class="section-flash-sale-block" 
		<?php
		if ( ! empty( $args['bg_img'] ) ) :
			?>
			style="background-image: url( <?php echo esc_url( $args['bg_img'] ); ?> );"<?php endif; ?>>
			<?php if ( $args['show_header'] ) : ?>
				<header class="section-header">
					<?php if ( ! empty( $args['section_title'] ) ) : ?>
						<h2 class="section-title"><?php echo wp_kses_post( $args['section_title'] ); ?></h2>
						<?php
					endif;

					if ( isset( $args['header_timer'] ) && $args['header_timer'] && ! empty( $args['timer_value'] ) ) :

						$deal_end_time = strtotime( $args['timer_value'] );
						$current_time  = strtotime( 'now' );
						$time_diff     = ( $deal_end_time - $current_time );

						if ( $time_diff > 0 ) :
							?>
							<div class="deal-countdown-timer">
								<?php if ( ! empty( $args['timer_title'] ) ) : ?>
									<div class="marketing-text">
										<span><?php echo wp_kses_post( $args['timer_title'] ); ?></span>
									</div>
								<?php endif; ?>

								<span class="deal-time-diff"><?php echo esc_html( $time_diff ); ?></span>
								<div class="deal-countdown countdown"></div>
							</div>
							<?php
						endif;
					endif;
					?>
				</header>
			<?php endif; ?>

			<div class="container">
				<div class="products-carousel-wrap" data-ride="tk-slick-carousel" data-wrap=".products" data-slick="<?php echo esc_attr( json_encode( $args['carousel_args'] ), ENT_QUOTES, 'UTF-8' ); ?>">
					<?php echo tokoo_do_shortcode( 'products', $args['shortcode_atts'] ); ?>
				</div>
			</div>
		</section>
		<?php
	}
}

if ( ! function_exists( 'tokoo_4_1_4_block' ) ) {
	function tokoo_4_1_4_block( $args = array() ) {

		if ( class_exists( 'Tokoo_Products' ) ) {
			$defaults = apply_filters(
				'tokoo_4_1_4_block_args',
				array(
					'header_args'    => array(
						'show_header'   => true,
						'section_title' => '',
						'header_aside'  => '',
					),
					'shortcode_tag'  => 'products',
					'shortcode_atts' => array(
						'limit'   => '9',
						'columns' => '2',
					),
				)
			);

			$args                               = wp_parse_args( $args, $defaults );
			$args['shortcode_atts']['per_page'] = 9;
			$args['shortcode_atts']['columns']  = 2;

			$products = Tokoo_Products::products( $args['shortcode_atts'] );

			?>
			<section class="products-4-1-4">
				<?php if ( $args['header_args']['show_header'] ) : ?>
					<header class="flex-header">
						<?php if ( ! empty( $args['header_args']['section_title'] ) ) : ?>
							<h2 class="section-title"><?php echo esc_html( $args['header_args']['section_title'] ); ?></h2>
						<?php endif; ?>

						<?php if ( ! empty( $args['header_args']['header_aside_action_text'] ) ) : ?>
						<div class="header-aside">
							<a href="<?php echo esc_url( $args['header_args']['header_aside_action_link'] ); ?>"><?php echo wp_kses_post( $args['header_args']['header_aside_action_text'] ); ?></a>
						</div>
						<?php endif; ?>

					</header>
				<?php endif; ?>
				<?php if ( ! empty( $products ) ) : ?>

				<div class="columns-4-1-4">
					<div class="products-4 products-4-left">
						<ul class="products">
							<?php
							$products_count = 0;

							if ( $products->have_posts() ) {

								$_post = $GLOBALS['post'];

								while ( $products->have_posts() ) :
									$products->the_post();
									global $post;

									if ( is_int( $post ) ) {
										$GLOBALS['post'] = get_post( $post ); // WPCS: override ok.
										setup_postdata( $GLOBALS['post'] );
									}

									if ( $products_count == 4 || $products_count == 5 ) {

										echo '</ul>';

										if ( $products_count == 4 ) {
											tokoo_add_4_1_4_main_product_hooks();

											echo '</div><div class="products-1"><ul class="products product-main-4-1-4">';
										}

										if ( $products_count == 5 ) {
											echo '</div><div class="products-4 products-4-right"><ul class="products">';
										}
									}
									wc_get_template_part( 'content', 'product' );

									if ( $products_count == 4 ) {
										tokoo_remove_4_1_4_main_product_hooks();
									}

									$products_count++;

									endwhile;

								$GLOBALS['post'] = $_post;
							}

								woocommerce_reset_loop();
								wp_reset_postdata();
							?>
						</ul>
					</div>
				</div>

				<?php endif; ?>
			</section>
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_brands_carousel' ) ) {
	/**
	 * Display brands carousel
	 */
	function tokoo_brands_carousel( $section_args = array(), $taxonomy_args = array(), $carousel_args = array() ) {

		if ( tokoo_is_woocommerce_activated() ) {

			$default_section_args = array(
				'section_title' => esc_html__( 'Our Official Brand', 'tokoo' ),
			);

			$default_taxonomy_args = array(
				'orderby'    => 'title',
				'order'      => 'ASC',
				'number'     => 12,
				'hide_empty' => false,
			);

			$default_carousel_args = array(
				'infinite'       => false,
				'slidesToShow'   => 6,
				'slidesToScroll' => 1,
				'arrows'         => false,
				'autoplay'       => false,
			);

			$section_args  = wp_parse_args( $section_args, $default_section_args );
			$taxonomy_args = wp_parse_args( $taxonomy_args, $default_taxonomy_args );
			$carousel_args = wp_parse_args( $carousel_args, $default_carousel_args );

			tokoo_get_template(
				'sections/brands-carousel.php',
				array(
					'taxonomy_args' => $taxonomy_args,
					'section_args'  => $section_args,
					'carousel_args' => $carousel_args,
				)
			);

		}
	}
}

if ( ! function_exists( 'tokoo_get_atts_for_shortcode' ) ) {
	function tokoo_get_atts_for_shortcode( $args ) {
		$atts = array();

		if ( isset( $args['shortcode'] ) ) {

			if ( 'product_attribute' == $args['shortcode'] && ! empty( $args['attribute'] ) && ! empty( $args['terms'] ) ) {

				$atts['attribute']      = $args['attribute'];
				$atts['terms']          = $args['terms'];
				$atts['terms_operator'] = ! empty( $args['terms_operator'] ) ? $args['terms_operator'] : 'IN';

			} elseif ( 'product_category' == $args['shortcode'] && ! empty( $args['product_category_slug'] ) ) {

				$atts['category']     = $args['product_category_slug'];
				$atts['cat_operator'] = ! empty( $args['cat_operator'] ) ? $args['cat_operator'] : 'IN';

			} elseif ( 'products' == $args['shortcode'] && ! empty( $args['products_ids_skus'] ) ) {

				$ids_or_skus          = ! empty( $args['products_choice'] ) ? $args['products_choice'] : 'ids';
				$atts[ $ids_or_skus ] = $args['products_ids_skus'];
				$atts['orderby']      = 'post__in';

			} elseif ( $args['shortcode'] == 'sale_products' ) {

				$atts['on_sale'] = true;

			} elseif ( $args['shortcode'] == 'best_selling_products' ) {

				$atts['best_selling'] = true;

			} elseif ( $args['shortcode'] == 'featured_products' ) {

				$atts['visibility'] = 'featured';

			} elseif ( $args['shortcode'] == 'top_rated_products' ) {

				$atts['top_rated'] = true;

			} elseif ( $args['shortcode'] == 'recent_products' ) {

				$atts['visibility'] = 'visible';

			}
		}

		if ( isset( $args['shortcode_atts'] ) ) {
			$atts = wp_parse_args( $atts, $args['shortcode_atts'] );
		}

		return $atts;
	}
}

if ( ! function_exists( 'tokoo_get_atts_for_taxonomy_slugs' ) ) {
	function tokoo_get_atts_for_taxonomy_slugs( $args ) {
		if ( ! empty( $args['slug'] ) ) {
			$cat_slugs    = is_array( $args['slug'] ) ? $args['slug'] : explode( ',', $args['slug'] );
			$cat_slugs    = array_map( 'trim', $cat_slugs );
			$args['slug'] = $cat_slugs;

			$include = array();

			foreach ( $cat_slugs as $slug ) {
				$include[] = "'" . $slug . "'";
			}

			if ( ! empty( $include ) ) {
				$args['include'] = $include;
				$args['orderby'] = 'include';
			}
		}

		return $args;
	}
}

if ( ! function_exists( 'tokoo_features_list' ) ) {
	/**
	 * Display Features list
	 */
	function tokoo_features_list( $args = array() ) {

		$defaults = array(
			'section_class' => '',
			'features'      => array(),
		);

		$args = wp_parse_args( $args, $defaults );

		?>

		<div class="features-list-block <?php echo esc_attr( $args['section_class'] ); ?>">
			<div class="container">
				<ul class="features-list">
					<?php foreach ( $args['features'] as $feature ) : ?>
						<?php if ( ! empty( $feature['icon'] ) ) : ?>
							<li class="feature">
								<i class="feature-icon <?php echo esc_attr( $feature['icon'] ); ?>"></i>
								<span class="feature-text"><?php echo wp_kses_post( $feature['label'] ); ?></span>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_about_header_section' ) ) {
	/**
	 * Display About Header
	 */
	function tokoo_about_header_section( $args = array() ) {

		$defaults = apply_filters(
			'kidos_about_header_section_args',
			array(
				'section_class' => '',
				'pre_title'     => esc_html__( 'know us better', 'tokoo' ),
				'title'         => esc_html__( 'About Us', 'tokoo' ),
			)
		);

		$args = wp_parse_args( $args, $defaults );

		$section_class = empty( $section_class ) ? 'about-header' : 'about-header' . $section_class;

		if ( ! empty( $animation ) ) {
			$section_class .= ' animate-in-view';
		}

		?>
		<div class="<?php echo esc_attr( $section_class ); ?>" 
							   <?php
								if ( ! empty( $animation ) ) :
									?>
			data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
			<?php tokoo_page_header_image(); ?>
			<div class="header-content">
				<?php
				if ( ! empty( $args['pre_title'] ) ) {
					echo '<h3 class="pre-title">' . wp_kses_post( $args['pre_title'] ) . '</h3>';
				}

				if ( ! empty( $args['title'] ) ) {
					echo '<h2 class="title">' . wp_kses_post( $args['title'] ) . '</h2>';
				}
				?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_about_content_section' ) ) {
	/**
	 * Display About Header
	 */
	function tokoo_about_content_section( $args = array() ) {

		$defaults = apply_filters(
			'kidos_about_header_section_args',
			array(
				'section_class' => '',
				'about_content' => '',
			)
		);

		$args = wp_parse_args( $args, $defaults );

		$section_class = empty( $section_class ) ? 'about-content' : 'about-content' . $section_class;

		if ( ! empty( $animation ) ) {
			$section_class .= ' animate-in-view';
		}

		?>
		<div class="<?php echo esc_attr( $section_class ); ?>" 
							   <?php
								if ( ! empty( $animation ) ) :
									?>
			data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
			<?php
			if ( ! empty( $args['about_content'] ) ) {
				echo '<p>' . wp_kses_post( $args['about_content'] ) . '</p>';
			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_testimonial' ) ) {
	/**
	 * Display About Header
	 */
	function tokoo_testimonial( $section_args = array(), $taxonomy_args = array() ) {
		if ( is_our_team_activated() ) {

			$default_section_args = array(
				'section_title' => esc_html__( 'Our Team', 'tokoo' ),
			);

			$default_taxonomy_args = array(
				'limit'    => 3,
				'orderby'  => 'title',
				'order'    => 'ASC',
				'category' => '',
			);

			$section_args  = wp_parse_args( $section_args, $default_section_args );
			$taxonomy_args = wp_parse_args( $taxonomy_args, $default_taxonomy_args );

			tokoo_get_template(
				'sections/team-members.php',
				array(
					'section_args'  => $section_args,
					'taxonomy_args' => $taxonomy_args,
				)
			);
		}
	}
}

if ( ! function_exists( 'tokoo_job_section' ) ) {
	/**
	 * Display About Header
	 */
	function tokoo_job_section( $args = array() ) {

		$defaults = array(
			'section_class' => '',
			'section_title' => esc_html__( 'Join Us on Tokoo', 'tokoo' ),
			'jobs'          => array(),
		);

		$args = wp_parse_args( $args, $defaults );

		?>
		<div class="about-job">
			<header class="section-header">
				<?php
					echo '<h2 class="title">' . wp_kses_post( $args['section_title'] ) . '</h2>';
				?>
			</header>
			<ul>
				<?php foreach ( $args['jobs'] as $job ) : ?>
					<li class="about-job-list">
						<div class="about-job-list-inner">
							<h3 class="pre-title"><?php echo esc_html( $job['pre_title'] ); ?></h3>
							<a href="<?php echo esc_url( $job['job_title_link'] ); ?>">
								<h2 class="job-title"><?php echo esc_html( $job['job_title'] ); ?></h2>
							</a>
							<p class="description"><?php echo wp_kses_post( $job['description'] ); ?></p>
							<a href="<?php echo esc_url( $job['action_link'] ); ?>"><?php echo esc_html( $job['action_text'] ); ?></a>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_slider_product' ) ) {
	/**
	 * Displays Product
	 */
	function tokoo_slider_product( $args = array() ) {
		if ( tokoo_is_woocommerce_activated() ) {

			$defaults = apply_filters(
				'tokoo_slider_product_args',
				array(
					'shortcode_tag'  => 'recent_products',
					'shortcode_atts' => array(
						'per_page' => 1,
						'columns'  => 1,
					),
				)
			);

			$args = wp_parse_args( $args, $defaults );

			tokoo_add_slider_product_hooks();

			echo tokoo_do_shortcode( 'products', $args['shortcode_atts'] );

			tokoo_remove_slider_product_hooks();
		}
	}
}

if ( ! function_exists( 'tokoo_category_block' ) ) {
	/**
	 *
	 */
	function tokoo_category_block( $args = array() ) {

		if ( class_exists( 'Tokoo_Products' ) ) {
			$default_args = apply_filters(
				'tokoo_category_block_args',
				array(
					'section_class' => '',
					'animation'     => '',
					'category_args' => array(
						'number'     => '5',
						'columns'    => '5',
						'slug'       => '',
						'hide_empty' => 'true',
					),
				)
			);

			$args          = wp_parse_args( $args, $default_args );
			$category_args = tokoo_get_atts_for_taxonomy_slugs( $args['category_args'] );

			?>
			<div class="category-wrapper">
				<?php echo Tokoo_Products::product_categories( $category_args ); ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_vertical_nav' ) ) {
	/**
	 *
	 */
	function tokoo_vertical_nav( $args = array() ) {
		$defaults = apply_filters(
			'tokoo_vertical_nav_default_args',
			array(
				'menu_title'       => esc_html__( 'Categories', 'tokoo' ),
				'menu_action_text' => esc_html__( 'View All', 'tokoo' ),
				'menu_action_link' => '#',
				'menu'             => 'vertical-menu',
			)
		);

		$args = wp_parse_args( $args, $defaults );

		$section_class = empty( $args['section_class'] ) ? 'vertical-nav-block' : 'vertical-nav-block ' . $section_class;
		if ( ! empty( $args['animation'] ) ) {
			$section_class .= ' animate-in-view';
		}

		$vertical_nav = wp_nav_menu(
			array(
				'menu'           => $args['menu'],
				'theme_location' => 'vertical-nav',
				'container'      => false,
				'menu_class'     => 'vertical-nav yamm',
				'fallback_cb'    => false,
				'echo'           => false,
			)
		);

		$menu_title_v6 = apply_filters( 'tokoo_vertical_menu_title', esc_html__( 'Categories', 'tokoo' ) );

		?>
		<div class="<?php echo esc_attr( $section_class ); ?>" 
							   <?php
								if ( ! empty( $args['animation'] ) ) :
									?>
			data-animation="<?php echo esc_attr( $args['animation'] ); ?>"<?php endif; ?>>
			<div class="vertical-nav-block-inner">
				<div class="vertical-nav-inner tokoo-animate-dropdown">
					<div class="vertical-menu-title">
						<span class="title"><?php echo wp_kses_post( $args['menu_title'] ); ?></span>
						<a href="<?php echo esc_url( $args['menu_action_link'] ); ?>"><?php echo esc_html( $args['menu_action_text'] ); ?></a>
					</div>
					<div class="vertical-nav-wrapper"><?php echo wp_kses_post( $vertical_nav ); ?></div>
				</div>
			</div>
		</div>
		<?php
	}
}
