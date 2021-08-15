<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package tokoo
 */

global $post;
$clean_page_meta_values = get_post_meta( $post->ID, '_tokoo_page_metabox', true );
$page_meta_values = maybe_unserialize( $clean_page_meta_values );

$header_style = '';
if ( isset( $page_meta_values['site_header_style'] ) && ! empty( $page_meta_values['site_header_style'] ) ) {
	$header_style = $page_meta_values['site_header_style'];
}

get_header( $header_style ); 


	do_action( 'tokoo_before_main_content' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();

				do_action( 'tokoo_page_before' );

				get_template_part( 'templates/contents/content', 'page' );

				/**
				 * Functions hooked in to tokoo_page_after action
				 *
				 * @hooked tokoo_display_comments - 10
				 */
				do_action( 'tokoo_page_after' );

			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php do_action( 'tokoo_after_main_content' );

get_footer();