<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); 

    do_action( 'tokoo_before_main_content' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post();

			do_action( 'tokoo_single_post_before' );

			get_template_part( 'templates/contents/content', 'single' );

			do_action( 'tokoo_single_post_after' );

		endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
    do_action( 'tokoo_after_main_content' );

    $layout = tokoo_get_single_post_layout();
    if ( $layout == 'left-sidebar' || $layout == 'right-sidebar' ) {
        do_action( 'tokoo_sidebar', 'blog' );
    }

get_footer();