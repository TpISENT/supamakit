<?php
/**
 * Template tags used in Pages
 */

if ( ! function_exists( 'tokoo_page_header' ) ) {
	/**
	 * Display the page header
	 *
	 * @since 1.0.0
	 */
	function tokoo_page_header() {
		global $post;

		$clean_page_meta_values = get_post_meta( $post->ID, '_tokoo_page_metabox', true );
		$page_meta_values       = maybe_unserialize( $clean_page_meta_values );

		if ( isset( $page_meta_values['page_title'] ) && ! empty( $page_meta_values['page_title'] ) ) {
			$page_title = $page_meta_values['page_title'];
		} else {
			$page_title = get_the_title();
		}

		if ( apply_filters( 'tokoo_show_page_header', true ) ) {
			?>
			<header class="page-header entry-header">
				<?php tokoo_page_header_image(); ?>
				<div class="page-header-caption">
					<h1 class="page-title entry-title"><?php echo apply_filters( 'tokoo_page_title', wp_kses_post( $page_title ) ); ?></h1>
					<?php if ( isset( $page_meta_values['page_subtitle'] ) && ! empty( $page_meta_values['page_subtitle'] ) ) { ?>
						<p class="entry-subtitle"><?php echo apply_filters( 'tokoo_page_subtitle', wp_kses_post( $page_meta_values['page_subtitle'] ), $post ); ?></p>
					<?php } ?>
				</div>
			</header><!-- .entry-header -->
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_toggle_breadcrumb' ) ) {
	function tokoo_toggle_breadcrumb( $show_breadcrumb ) {
		global $post;

		if ( isset( $post->ID ) ) {
			$clean_page_meta_values = get_post_meta( $post->ID, '_tokoo_page_metabox', true );
			$page_meta_values       = maybe_unserialize( $clean_page_meta_values );

			if ( isset( $page_meta_values['hide_breadcrumb'] ) && $page_meta_values['hide_breadcrumb'] == '1' ) {
				$show_breadcrumb = false;
			} elseif ( get_post_type() == 'post' && is_sticky() ) {
				$show_breadcrumb = false;
			} elseif ( get_post_type() == 'post' && is_single() ) {
				$show_breadcrumb = false;
			}
		}

		return $show_breadcrumb;
	}
}

if ( ! function_exists( 'tokoo_breadcrumb' ) ) {
	/**
	 * Display tokoo breadcrumb
	 *
	 * @uses woocommerce_breadcrumb()
	 * @since 1.0.0
	 */
	function tokoo_breadcrumb() {

		if ( tokoo_is_woocommerce_activated() && apply_filters( 'tokoo_show_breadcrumb', true ) ) {
			woocommerce_breadcrumb();
		}
	}
}


if ( ! function_exists( 'tokoo_page_content' ) ) {
	function tokoo_page_content() {
		?>
		<div class="page-content entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages(
					array(
						'before'   => '<div class="page-links">' . esc_html__( 'Pages:', 'tokoo' ) . '<nav class="page-numbers">',
						'pagelink' => '<span>%</span>',
						'after'    => '</nav></div>',
					)
				);
			?>
		</div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'tokoo_homepage_content' ) ) {
	/**
	 * Display homepage content
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @return  void
	 */
	function tokoo_homepage_content() {
		while ( have_posts() ) {
			the_post();

			?>
			<div class="entry-content">
				<?php
					the_content();
					wp_link_pages(
						array(
							'before'   => '<div class="page-links">' . esc_html__( 'Pages:', 'tokoo' ) . '<nav class="page-numbers">',
							'pagelink' => '<span>%</span>',
							'after'    => '</nav></div>',
						)
					);
				?>
			</div>
			<?php

		} // end of the loop.
	}
}

if ( ! function_exists( 'tokoo_toggle_page_header' ) ) {
	function tokoo_toggle_page_header() {
		global $post;

		$should_show_page_header = true;

		$clean_page_meta_values = get_post_meta( $post->ID, '_tokoo_page_metabox', true );
		$page_meta_values       = maybe_unserialize( $clean_page_meta_values );

		if ( isset( $page_meta_values['hide_page_header'] ) && $page_meta_values['hide_page_header'] == '1' ) {
			$should_show_page_header = false;
		}

		if ( tokoo_is_woocommerce_activated() && is_account_page() ) {
			$should_show_page_header = false;

			if ( ! is_user_logged_in() && is_wc_endpoint_url( 'lost-password' ) ) {
				$should_show_page_header = true;
			}
		}

		if ( tokoo_is_woocommerce_activated() && ( is_cart() || is_checkout() ) ) {
			$should_show_page_header = false;
		}

		return $should_show_page_header;
	}
}

if ( ! function_exists( 'tokoo_page_header_image' ) ) {
	/**
	 * Display the page header image
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function tokoo_page_header_image() {
		global $post;

		$image_url = apply_filters( 'tokoo_default_page_header_image', '' );

		if ( ! is_front_page() ) {

			$image_width = apply_filters( 'tokoo_page_header_image_width', 1170 );

			if ( $post ) {
				$image_id = get_post_thumbnail_id( $post->ID );
				$image    = wp_get_attachment_image_src( $image_id, array( $image_width, $image_width ) );
				if ( is_page() && has_post_thumbnail( $post->ID ) && $image[1] >= $image_width ) {
					echo '<div class="page-featured-image">' . get_the_post_thumbnail( $post->ID, 'full' ) . '</div>';
				}
			}
		}
	}
}
