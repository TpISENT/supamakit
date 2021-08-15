<?php
/**
 * Template functions for Single Post
 */

if ( ! function_exists( 'tokoo_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function tokoo_post_content() {
		?>
		<div class="entry-content">
			<div class="entry-content-inner">
			<?php

			/**
			 * Functions hooked in to tokoo_post_content_before action.
			 *
			 * @hooked tokoo_post_thumbnail - 10
			 */
			do_action( 'tokoo_post_content_before' );

			the_content(
				sprintf(
					wp_kses_post( __( 'Continue reading %s', 'tokoo' ) ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				)
			);

			do_action( 'tokoo_post_content_after' );

			wp_link_pages(
				array(
					'before'   => '<div class="page-links nav-links">' . esc_html__( 'Pages:', 'tokoo' ) . '<nav class="page-numbers">',
					'pagelink' => '<span>%</span>',
					'after'    => '</nav></div>',
				)
			);
			?>
			</div>
		</div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'tokoo_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function tokoo_post_nav() {
		$args = array(
			'next_text' => '%title',
			'prev_text' => '%title',
		);
		the_post_navigation( $args );
	}
}

if ( ! function_exists( 'tokoo_display_comments' ) ) {
	/**
	 * tokoo display comments
	 *
	 * @since  1.0.0
	 */
	function tokoo_display_comments() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || '0' != get_comments_number() ) :
			comments_template();
		endif;
	}
}

if ( ! function_exists( 'tokoo_comment' ) ) {
	/**
	 * tokoo comment template
	 *
	 * @param array $comment the comment array.
	 * @param array $args the comment args.
	 * @param int   $depth the comment depth.
	 * @since 1.0.0
	 */
	function tokoo_comment( $comment, $args, $depth ) {
		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-body">
		<?php
			$comment_avatar = get_avatar( $comment, 84 );
		if ( ! empty( $comment_avatar ) ) :
			?>
		<div class="comment-author-gravatar"><?php echo wp_kses_post( $comment_avatar ); ?></div><?php endif; ?>
		<div class="comment-meta-and-content">
		<div class="comment-meta commentmetadata">
			<div class="comment-author vcard">
			<?php printf( wp_kses_post( '<cite class="comment-author-name fn">%s</cite>', 'tokoo' ), get_comment_author_link() ); ?>
			</div>
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'tokoo' ); ?></em>
			<?php endif; ?>
			<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>" class="comment-date">
				<?php echo '<time datetime="' . get_comment_date( 'c' ) . '">' . get_comment_date() . '</time>'; ?>
			</a>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-content">
		<?php endif; ?>
		<div class="comment-text">
		<?php comment_text(); ?>
		</div>
		<div class="reply">
		<?php
		comment_reply_link(
			array_merge(
				$args,
				array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				)
			)
		);
		?>
		<?php edit_comment_link( esc_html__( 'Edit', 'tokoo' ), '  ', '' ); ?>
		</div>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_move_comment_field_to_bottom' ) ) {
	function tokoo_move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}
}

if ( ! function_exists( 'tokoo_get_comment_form_args' ) ) {
	function tokoo_get_comment_form_args() {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );

		$comment_fields = array(
			'author' =>
				'<p class="comment-form-author form-row form-row-first"><label class="sr-only" for="author">' . esc_html__( 'Name', 'tokoo' ) .
				( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
				'<input id="author" class="input-text" placeholder="' . esc_attr__( 'Name', 'tokoo' ) . ( $req ? ' *' : '' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30"' . $aria_req . ' /></p>',

			'email'  =>
				'<p class="comment-form-email form-row form-row-last"><label class="sr-only" for="email">' . esc_html__( 'Email', 'tokoo' ) .
				( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
				'<input id="email" class="input-text" placeholder="' . esc_attr__( 'Email', 'tokoo' ) . ( $req ? ' *' : '' ) . '" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' /></p>',

			'url'    =>
				'<p class="comment-form-url form-row form-row-wide"><label class="sr-only" for="url">' . esc_html__( 'Website', 'tokoo' ) . '</label>' .
				'<input id="url" name="url" class="input-text" placeholder="' . esc_attr__( 'Website', 'tokoo' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" size="30" /></p>',
		);

		$args = apply_filters(
			'tokoo_default_comment_form_args',
			array(
				'title_reply_before' => '<span id="reply-title" class="gamma comment-reply-title">',
				'title_reply_after'  => '</span>',
				'comment_field'      => '<p class="comment-form-comment form-row form-row-wide"><label class="sr-only" for="comment">' . esc_html__( 'Comment', 'tokoo' ) .
											'</label><textarea id="comment" class="input-text" placeholder="' . esc_attr__( 'Comment', 'tokoo' ) . ( $req ? ' *' : '' ) . '" name="comment" cols="45" rows="8" aria-required="true">' .
											'</textarea></p>',
				'fields'             => apply_filters( 'comment_form_default_fields', $comment_fields ),
			)
		);

		return $args;
	}
}

if ( ! function_exists( 'tokoo_post_footer' ) ) {
	function tokoo_post_footer() {
		$description = get_the_author_meta( 'description' );
		ob_start();
		if ( function_exists( 'tokoo_show_jetpack_share' ) ) {
			tokoo_show_jetpack_share();
		}
		$jetpack_share_html = ob_get_clean();

		if ( apply_filters( 'tokoo_show_author_info', true ) && ( ! empty( $description ) || ! empty( $jetpack_share_html ) ) ) {
			?>
			<div class="single-post-footer">
				<div class="single-post-author">
					<div class="author-info">
						<div class="author-gravatar">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_avatar( get_the_author_meta( 'ID' ), 112 ); ?></a>
						</div>
						<div class="author-detail">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<div class="author-name-label"><?php echo esc_html__( 'Posted By', 'tokoo' ); ?></div>
								<div class="author-name"><?php echo get_the_author(); ?></div>
							</a>
							<?php if ( ! empty( $description ) ) : ?>
								<div class="author-desc"><?php echo wp_kses_post( $description ); ?></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php if ( ! empty( $jetpack_share_html ) ) : ?>
					<div class="single-post-sharing"><?php echo wp_kses_post( $jetpack_share_html ); ?></div>
				<?php endif; ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'tokoo_related_posts' ) ) {
	/**
	 * Display Posts
	 */
	function tokoo_related_posts( $args = array() ) {

		$defaults = apply_filters(
			'tokoo_related_posts_args',
			array(
				'section_class' => '',
				'section_title' => esc_html__( 'Related Articles', 'tokoo' ),
				'limit'         => 3,
				'columns'       => 3,
				'post_choice'   => 'recent',
				'post_ids'      => '',
			)
		);

		$args = wp_parse_args( $args, $defaults );

		$query_args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'orderby'             => 'date',
			'order'               => 'desc',
			'posts_per_page'      => 3,
		);

		extract( $args );

		if ( ! empty( $limit ) ) {
			$query_args['posts_per_page'] = $limit;
		}

		if ( ! empty( $post_choice ) ) {
			if ( $post_choice == 'specific' && ! empty( $post_ids ) ) {
				$query_args['post__in'] = explode( ',', $post_ids );
			} elseif ( $post_choice == 'random' ) {
				$query_args['orderby'] = 'rand';
			}
		}

		$args['query_args'] = apply_filters( 'tokoo_related_posts_query_args', $query_args );

		tokoo_get_template( 'sections/related-posts.php', $args );
	}
}

