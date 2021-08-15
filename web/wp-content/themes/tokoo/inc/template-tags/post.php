<?php
/**
 * Template functions used in post
 */

if ( ! function_exists( 'tokoo_post_featured_image' ) ) {
	function tokoo_post_featured_image() {
		global $post;

		if ( has_post_thumbnail() ) {
			?><div class="entry-featured-image">
			<?php
			$featured_image_size = 'medium';

			if ( is_sticky() ) {
				$featured_image_size = 'full';
			}

			$post_thumbnail_url = get_the_post_thumbnail_url( $post->ID, $featured_image_size );
			?>
			<div class="post-image" style="background-image:url(<?php echo esc_attr( $post_thumbnail_url ); ?>);"><a href="<?php echo esc_url( get_permalink() ); ?>"></a></div>			</div>
			<?php

		} elseif ( apply_filters( 'tokoo_enable_post_icon_placeholder', false ) ) {
			echo sprintf( '<a class="post-icon-link" href="%s" rel="bookmark">', esc_url( get_permalink() ) );

			tokoo_post_icon();

			echo wp_kses_post( '</a>' );
		}
	}
}

if ( ! function_exists( 'tokoo_single_post_featured_image' ) ) {
	function tokoo_single_post_featured_image() {
		global $post;

		if ( has_post_thumbnail() ) {
			?>
			<div class="entry-featured-image">
			<?php
			$featured_image_size = 'full';

			$post_thumbnail_url = get_the_post_thumbnail_url( $post->ID, $featured_image_size );
			?>
			<div class="post-image single-post-image" style="background-image:url(<?php echo esc_attr( $post_thumbnail_url ); ?>);"></div>
			</div>
			<?php

		} elseif ( apply_filters( 'tokoo_enable_post_icon_placeholder', false ) ) {

			tokoo_post_icon();

		}
	}
}

if ( ! function_exists( 'tokoo_post_icon' ) ) {
	function tokoo_post_icon() {
		$post_format = get_post_format();
		switch ( $post_format ) {
			case 'aside':
				$icon = 'fas fa-hand-point-left';
				break;
			case 'gallery':
				$icon = 'far fa-images';
				break;
			case 'link':
				$icon = 'fas fa-link';
				break;
			case 'image':
				$icon = 'far fa-image';
				break;
			case 'quote':
				$icon = 'fas fa-quote-right';
				break;
			case 'status':
				$icon = 'far fa-comment-alt';
				break;
			case 'video':
				$icon = 'fas fa-video';
				break;
			case 'audio':
				$icon = 'fas fa-volume-up';
				break;
			case 'chat':
				$icon = 'far fa-comments';
				break;
			default:
				$icon = 'fab fa-wordpress';
		}

		$post_icon = apply_filters( 'tokoo_post_icon', $icon, $post_format );
		?>
		<div class="post-icon"><i class="<?php echo esc_attr( $post_icon ); ?>"></i></div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_get_sidebar' ) ) {
	/**
	 * Display tokoo sidebar
	 *
	 * @uses get_sidebar()
	 */
	function tokoo_get_sidebar( $name = null ) {
		get_sidebar( $name );
	}
}

if ( ! function_exists( 'tokoo_get_blog_layout' ) ) {
	function tokoo_get_blog_layout() {
		if ( is_single() && 'post' == get_post_type() ) {
			return tokoo_get_single_post_layout();
		} elseif ( is_home() || ( 'post' == get_post_type() && ( is_category() || is_tag() || is_author() || is_date() || is_year() || is_month() || is_time() ) ) ) {
			return apply_filters( 'tokoo_blog_layout', 'full-width' );
		} else {
			return apply_filters( 'tokoo_default_layout', 'blog full-width' );
		}
	}
}

if ( ! function_exists( 'tokoo_get_single_post_layout' ) ) {
	function tokoo_get_single_post_layout() {
		if ( is_single() && 'post' == get_post_type() ) {
			return apply_filters( 'tokoo_single_post_layout', 'full-width' );
		} else {
			return apply_filters( 'tokoo_default_layout', 'blog full-width' );
		}
	}
}

if ( ! function_exists( 'tokoo_get_blog_style' ) ) {
	function tokoo_get_blog_style() {
		return apply_filters( 'tokoo_blog_style', 'blog-grid' );
	}
}

if ( ! function_exists( 'tokoo_post_thumbnail' ) ) {
	/**
	 * Display post thumbnail
	 *
	 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
	 * @uses has_post_thumbnail()
	 * @uses the_post_thumbnail
	 * @param string $size the post thumbnail size.
	 * @since 1.5.0
	 */
	function tokoo_post_thumbnail( $size = 'full' ) {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( $size );
		}
	}
}

if ( ! function_exists( 'tokoo_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function tokoo_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( '%s', 'post date', 'tokoo' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo wp_kses(
			apply_filters( 'tokoo_single_post_posted_on_html', '<span class="posted-on">' . $posted_on . '</span>', $posted_on ),
			array(
				'span' => array(
					'class' => array(),
				),
				'a'    => array(
					'href'  => array(),
					'title' => array(),
					'rel'   => array(),
				),
				'time' => array(
					'datetime' => array(),
					'class'    => array(),
				),
			)
		);
	}
}

if ( ! function_exists( 'tokoo_post_categories' ) ) {
	function tokoo_post_categories() {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'tokoo' ) );

		if ( $categories_list ) :
			?>
			<div class="entry-categories cat-links">
				<?php echo wp_kses_post( $categories_list ); ?>
			</div>
		<?php endif; // End if categories. ?>

		<?php
		if ( apply_filters( 'tokoo_post_tags', false ) ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'tokoo' ) );

			if ( $tags_list ) :
				?>
				<div class="tags-links">
					<?php
					echo '<div class="label">' . esc_html__( 'Tagged', 'tokoo' ) . '</div>';
					echo wp_kses_post( $tags_list );
					?>
				</div>
				<?php
			endif; // End if $tags_list.
			?>
		</div><!-- /.tags -->
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_post_title' ) ) {
	function tokoo_post_title() {
		the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
	}
}

if ( ! function_exists( 'tokoo_single_post_title' ) ) {
	function tokoo_single_post_title() {
		the_title( '<h2 class="alpha entry-title">', '</h2>' );
	}
}

if ( ! function_exists( 'tokoo_post_header' ) ) {
	function tokoo_post_header() {
		?>
		<header class="entry-header">
		<?php
			do_action( 'tokoo_post_header' );
		?>
		</header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'tokoo_single_post_header' ) ) {
	function tokoo_single_post_header() {
		?>
		<header class="entry-header">
		<?php
			do_action( 'tokoo_single_post_header' );
		?>
		</header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'tokoo_post_meta' ) ) {
	/**
	 * Display the post meta
	 *
	 * @since 1.0.0
	 */
	function tokoo_post_meta() {
		?>
		<aside class="entry-meta">
			
			<div class="vcard author">
				<?php
					echo '<div class="label">' . esc_html__( 'Posted by', 'tokoo' ) . '</div>';
					echo sprintf( '<a href="%1$s" class="url fn" rel="author">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() );
				?>
			</div>

			<?php tokoo_posted_on(); ?>

		</aside>
		<?php
	}
}

if ( ! function_exists( 'tokoo_loop_wrap_open' ) ) {
	function tokoo_loop_wrap_open() {
		?>
		<div class="articles 
		<?php
		if ( ! apply_filters( 'tokoo_enable_post_icon_placeholder', false ) ) :
			echo esc_attr( 'masonry-articles' );
endif;
		?>
		">
		<?php
	}
}

if ( ! function_exists( 'tokoo_loop_wrap_close' ) ) {
	function tokoo_loop_wrap_close() {
		?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function tokoo_paging_nav() {
		global $wp_query;

		$args = array(
			'type'      => 'list',
			'next_text' => esc_html_x( 'Next', 'Next post', 'tokoo' ),
			'prev_text' => esc_html_x( 'Previous', 'Previous post', 'tokoo' ),
		);

		the_posts_pagination( $args );
	}
}
